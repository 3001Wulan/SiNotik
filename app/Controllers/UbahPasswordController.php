<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class UbahPasswordController extends BaseController
{
    public function ubah()
    {
        if ($this->request->getMethod() === 'post') {
            // Mengambil data dari form
            $password = $this->request->getPost('password');
            $newPassword = $this->request->getPost('new-password');
            $confirmPassword = $this->request->getPost('confirm-password');

            // Log data yang diterima
            log_message('debug', 'Data yang diterima: Password Lama: ' . $password . ', Password Baru: ' . $newPassword . ', Konfirmasi Password: ' . $confirmPassword);

            // Validasi jika password baru dan konfirmasi tidak cocok
            if ($newPassword !== $confirmPassword) {
                session()->setFlashdata('errors', ['Password baru dan konfirmasi password tidak cocok.']);
                log_message('error', 'Password baru dan konfirmasi password tidak cocok.');
                return redirect()->back()->withInput();
            }

            // Ambil user_id dari session atau inputan yang sesuai
            $userId = 1; // Ganti sesuai dengan ID pengguna yang sedang login
            log_message('info', 'Mencoba memverifikasi password untuk user_id: ' . $userId);

            $penggunaModel = new PenggunaModel();

            // Verifikasi password lama
            if (!$penggunaModel->verifyPassword($userId, $password)) {
                session()->setFlashdata('errors', ['Password lama salah.']);
                log_message('error', 'Password lama salah untuk user_id: ' . $userId);
                return redirect()->back()->withInput();
            }

            // Log keberhasilan verifikasi password lama
            log_message('info', 'Password lama terverifikasi dengan benar untuk user_id: ' . $userId);

            // Perbarui password
            if ($penggunaModel->updatePassword($userId, $newPassword)) {
                session()->setFlashdata('success', 'Password berhasil diperbarui!');
                log_message('info', 'Password berhasil diperbarui untuk user_id: ' . $userId);
            } else {
                session()->setFlashdata('errors', ['Gagal memperbarui password.']);
                log_message('error', 'Gagal memperbarui password untuk user_id: ' . $userId);
            }

            return redirect()->to('admin/editprofil');
        }

        return view('admin/ubahpassword');
    }
}
