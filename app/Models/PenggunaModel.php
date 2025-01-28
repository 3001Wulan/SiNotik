<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Log\Logger;

class PenggunaModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'nama', 'nip', 'email', 'role', 'bidang', 'jabatan', 'profil_foto', 'password'];
    protected $useTimestamps = true;

    // Fungsi untuk mengambil pengguna berdasarkan user_id
    public function getUserById($user_id)
    {
        $user = $this->where('user_id', $user_id)->first();

        if ($user) {
            log_message('info', 'Data pengguna ditemukan: user_id = ' . $user_id);
        } else {
            log_message('warning', 'Pengguna tidak ditemukan: user_id = ' . $user_id);
        }

        return $user;
    }

    // Fungsi untuk memverifikasi password
    public function verifyPassword($user_id, $password)
    {
        // Ambil data pengguna berdasarkan user_id
        $user = $this->where('user_id', $user_id)->first();

        if ($user) {
            // Verifikasi password menggunakan password_verify (memeriksa hash)
            return password_verify($password, $user['password']);
        }

        return false;
    }

    // Fungsi untuk memperbarui password
    public function updatePassword($user_id, $newPassword)
    {
        // Hash password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password di database
        return $this->update($user_id, ['password' => $hashedPassword]);
    }
}
