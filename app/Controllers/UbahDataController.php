<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

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
    $input = $this->request->getPost();

    // Log data input yang diterima
    log_message('debug', 'Data input: ' . print_r($input, true));

    // Validasi password jika ada input password
    if (isset($input['password']) && isset($input['confirm-password'])) {
        if ($input['password'] !== $input['confirm-password']) {
            return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('error', 'Password dan konfirmasi password tidak cocok');
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

    // Hanya validasi field yang ada
    if (isset($input['username']) && !$this->validate(['username' => $rules['username']])) {
        return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('errors', $this->validator->getErrors());
    }
    if (isset($input['nama']) && !$this->validate(['nama' => $rules['nama']])) {
        return redirect()->to("admin/ubahdatapengguna/$id")->withInput()->with('errors', $this->validator->getErrors());
    }

    // Update data pengguna
    $model = new PenggunaModel();
    $data = [];

    if (isset($input['username'])) {
        $data['username'] = $input['username'];
    }
    if (isset($input['nama'])) {
        $data['nama'] = $input['nama'];
    }
    if (isset($input['nip'])) {
        $data['nip'] = $input['nip'];
    }
    if (isset($input['email'])) {
        $data['email'] = $input['email'];
    }
    if (isset($input['status'])) {
        $data['status'] = $input['status'];
    }
    if (isset($input['bidang'])) {
        $data['bidang'] = $input['bidang'];
    }
    if (isset($input['jabatan'])) {
        $data['jabatan'] = $input['jabatan'];
    }

    // Jika password diubah
    if (isset($input['password']) && !empty($input['password'])) {
        $data['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
    }

    // Update data pengguna di database
    if (!empty($data)) {
        log_message('debug', 'Data yang akan diperbarui: ' . print_r($data, true));
        $model->update($id, $data);
    }

    // Menghandle upload foto jika ada
    $photo = $this->request->getFile('photo');
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        // Log foto yang diterima
        log_message('debug', 'Foto yang diterima: ' . $photo->getName() . ' dengan ukuran: ' . $photo->getSize());

        if ($photo->getSize() <= 5 * 1024 * 1024) { // Maksimal 5MB
            // Pindahkan foto ke folder 'uploads'
            $photo->move('assets/images/profiles', $photo->getName());

            // Update path foto di database
            $model->update($id, ['photo' => $photo->getName()]);
        } else {
            return redirect()->to("admin/ubahdatapengguna/$id")->with('error', 'Ukuran foto terlalu besar');
        }
    }

    // Log jika proses berhasil
    log_message('debug', 'Data pengguna berhasil diperbarui untuk ID: ' . $id);

    return redirect()->to('admin/data_pengguna')->with('message', 'Data pengguna berhasil diperbarui');
}

}    