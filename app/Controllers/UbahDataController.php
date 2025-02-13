<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class UbahDataController extends BaseController
{
    public function ubahDataPengguna($id = null)
    {
        if ($id === null) {
            return redirect()->to('admin/ubahdatapengguna');
        }

        $model = new PenggunaModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengguna tidak ditemukan');
        }

        return view('admin/ubahdatapengguna', $data);
    }

    public function updatePengguna($id)
{
    $model = new PenggunaModel();
    $input = $this->request->getPost();

    log_message('debug', 'Data input: ' . print_r($input, true));

    if (!empty($input['password']) && isset($input['confirm-password'])) {
        if ($input['password'] !== $input['confirm-password']) {
            return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('error', 'Password dan konfirmasi tidak cocok');
        }
    }

    $rules = [
        'username' => 'required|min_length[3]',
        'nama' => 'required|min_length[3]',
        'email' => 'required|valid_email',
        'nip' => 'required|min_length[3]',
        'status' => 'required',
        'bidang' => 'required',
        'jabatan' => 'required',
    ];

    if (!$this->validate($rules)) {
        return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
        'username' => $input['username'],
        'nama' => $input['nama'],
        'nip' => $input['nip'],
        'email' => $input['email'],
        'status' => $input['status'],
        'bidang' => $input['bidang'],
        'jabatan' => $input['jabatan'],
    ];

    if (!empty($input['password'])) {
        $data['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
    }

    log_message('debug', 'Data yang akan diperbarui: ' . print_r($data, true));
    $model->update($id, $data);

    $photo = $this->request->getFile('photo');
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
    
        $maxSize = 5 * 1024 * 1024; 
        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $fileExtension = $photo->getExtension();

        if ($photo->getSize() > $maxSize) {
            return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('error', 'Ukuran file maksimal 5MB');
        }

        if (!in_array($fileExtension, $allowedExtensions)) {
            return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('error', 'Format file tidak valid! Hanya diperbolehkan JPEG, JPG, atau PNG');
        }

        $newName = $photo->getRandomName();
        $photo->move('assets/images/profiles', $newName);

        log_message('debug', "Foto berhasil diupload dengan nama: $newName");

        if ($model->updateProfilePhoto($id, $newName)) {
            log_message('debug', "Foto profil berhasil diperbarui di database untuk user_id: $id");
        } else {
            log_message('error', "Gagal memperbarui foto profil di database untuk user_id: $id");
        }
    }

    return redirect()->to('admin/data_pengguna')->with('message', 'Data pengguna berhasil diperbarui');
}

    
}
