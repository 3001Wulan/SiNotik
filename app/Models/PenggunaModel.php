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
}
