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

    // Fungsi untuk mengambil data pengguna berdasarkan user_id
    public function getUserById($user_id)
    {
        // Mencari data pengguna berdasarkan user_id
        $user = $this->where('user_id', $user_id)->first();

        // Cek apakah data ditemukan
        if ($user) {
            // Log jika data ditemukan
            log_message('info', 'Data pengguna ditemukan: user_id = ' . $user_id);
        } else {
            // Log jika data tidak ditemukan
            log_message('warning', 'Pengguna tidak ditemukan: user_id = ' . $user_id);
        }

        return $user; // Mengembalikan data pengguna
    }
}
