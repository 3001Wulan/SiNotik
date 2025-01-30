<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class UbahPasswordController extends BaseController
{
    public function ubah()
    {
        if ($this->request->getMethod() === 'POST') {
            // Mengambil data dari form
            $password = $this->request->getPost('password');
            $newPassword = $this->request->getPost('new-password');
            $confirmPassword = $this->request->getPost('confirm-password');

            // Log data yang diterima (hanya untuk debugging)
            log_message('debug', 'Data form diterima untuk ubah password.');

            // Validasi input
            if (empty($password) || empty($newPassword) || empty($confirmPassword)) {
                session()->setFlashdata('errors', ['Semua field harus diisi.']);
                log_message('error', 'Field tidak lengkap dalam permintaan ubah password.');
                return redirect()->back()->withInput();
            }

            if ($newPassword !== $confirmPassword) {
                session()->setFlashdata('errors', ['Password baru dan konfirmasi password tidak cocok.']);
                log_message('error', 'Password baru dan konfirmasi password tidak cocok.');
                return redirect()->back()->withInput();
            }

            // Ambil user_id dari session (pastikan sudah login)
            $userId = session()->get('user_id'); // Asumsi user_id disimpan di session
            if (!$userId) {
                session()->setFlashdata('errors', ['Anda belum login.']);
                log_message('error', 'User tidak ditemukan di session.');
                return redirect()->to('/login');
            }

            $penggunaModel = new PenggunaModel();

            // Verifikasi password lama
            if (!$penggunaModel->verifyPassword($userId, $password)) {
                session()->setFlashdata('errors', ['Password lama salah.']);
                log_message('error', 'Password lama salah untuk user_id: ' . $userId);
                return redirect()->back()->withInput();
            }

            // Perbarui password
            try {
                if ($penggunaModel->updatePassword($userId, $newPassword)) {
                    session()->setFlashdata('success', 'Password berhasil diperbarui!');
                    log_message('info', 'Password berhasil diperbarui untuk user_id: ' . $userId);
                    return redirect()->to('/admin/editprofil');
                } else {
                    session()->setFlashdata('errors', ['Gagal memperbarui password.']);
                    log_message('error', 'Gagal memperbarui password untuk user_id: ' . $userId);
                }
            } catch (\Exception $e) {
                session()->setFlashdata('errors', ['Terjadi kesalahan sistem.']);
                log_message('critical', 'Kesalahan saat memperbarui password untuk user_id: ' . $userId . '. Error: ' . $e->getMessage());
            }

            return redirect()->back()->withInput();
        }

        // Tampilkan halaman ubah password
        return view('admin/ubahpassword');
    }
}
