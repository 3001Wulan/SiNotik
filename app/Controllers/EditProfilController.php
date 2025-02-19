<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class EditProfilController extends Controller
{
    public function editProfil()
    {
        $session = \Config\Services::session();
        $userId = $session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $nama = $this->request->getPost('nama') ?? $user['nama'];
        $nip = $this->request->getPost('nip') ?? $user['nip'];
        $email = $this->request->getPost('email') ?? $user['email'];
        $password = $this->request->getPost('password') ?? '';
        $role = $this->request->getPost('role') ?? $user['role'];
        $bidang = $this->request->getPost('Bidang') ?? $user['Bidang'];
        $alamat = $this->request->getPost('alamat') ?? $user['alamat'];
        $jabatan = $this->request->getPost('jabatan') ?? $user['jabatan'];
        $tanggal_lahir = $this->request->getPost('tanggal_lahir') ?? $user['tanggal_lahir'];
        $file = $this->request->getFile('profil_foto');
        $profil_foto = $user['profil_foto']; 

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024;
        if ($file && $file->isValid()) {
            log_message('info', 'File ditemukan. Nama file: ' . $file->getName());
            $profil_foto = $file->getName(); 
            $targetDir = FCPATH . 'Assets/images/profiles/';

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $file->move($targetDir);
        }

        $data = [];
        $logChanges = []; 

        if ($nama != $user['nama']) {
            $data['nama'] = $nama;
            $logChanges[] = 'Nama: ' . $user['nama'] . ' -> ' . $nama;
        }

        if ($nip != $user['nip']) {
            $data['nip'] = $nip;
            $logChanges[] = 'NIP: ' . $user['nip'] . ' -> ' . $nip;
        }

        if ($email != $user['email']) {
            $data['email'] = $email;
            $logChanges[] = 'Email: ' . $user['email'] . ' -> ' . $email;
        }

        if ($role != $user['role']) {
            $data['role'] = $role;
            $logChanges[] = 'Role: ' . $user['role'] . ' -> ' . $role;
        }

        if ($bidang != $user['Bidang']) {
            $data['Bidang'] = $bidang;
            $logChanges[] = 'Bidang: ' . $user['Bidang'] . ' -> ' . $bidang;
        }

        if ($alamat != $user['alamat']) {
            $data['alamat'] = $alamat;
            $logChanges[] = 'Alamat: ' . $user['alamat'] . ' -> ' . $alamat;
        }

        if ($jabatan != $user['jabatan']) {
            $data['jabatan'] = $jabatan;
            $logChanges[] = 'Jabatan: ' . $user['jabatan'] . ' -> ' . $jabatan;
        }

        if ($tanggal_lahir != $user['tanggal_lahir'] && !empty($tanggal_lahir)) {
            $data['tanggal_lahir'] = $tanggal_lahir;
            $logChanges[] = 'Tanggal Lahir: ' . $user['tanggal_lahir'] . ' -> ' . $tanggal_lahir;
        }

        if ($profil_foto != $user['profil_foto']) {
            $data['profil_foto'] = $profil_foto;
            $logChanges[] = 'Foto Profil diperbarui';
        }

        log_message('info', 'Data yang akan diperbarui: ' . print_r($data, true));
        log_message('info', 'Data sebelum pembaruan: ' . print_r($user, true));
        log_message('info', 'Data yang akan dikirim: ' . print_r($data, true));

        if (!empty($data)) {
            try {
                $userModel->updateUser($userId, $data);
                log_message('info', 'Data profil pengguna dengan ID ' . $userId . ' diperbarui. Perubahan: ' . implode(', ', $logChanges));
            } catch (\Exception $e) {
                log_message('error', 'Gagal memperbarui data profil: ' . $e->getMessage());
            }
        } else {
        
            log_message('info', 'Tidak ada perubahan data untuk profil pengguna dengan ID ' . $userId);
        }

        return view('admin/editprofil', [
            'nama' => $nama,
            'nip' => $nip,
            'email' => $email,
            'role' => $role,
            'bidang' => $bidang,
            'alamat' => $alamat,
            'jabatan' => $jabatan,
            'tanggal_lahir' => $tanggal_lahir,
            'profil_foto' => $profil_foto,
        ]);
    }
}
