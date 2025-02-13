<?php

namespace App\Models;

use CodeIgniter\Model;

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

    public function updateProfilePhoto($user_id, $photoName)
    {
        log_message('debug', "Memperbarui foto profil pengguna ID: $user_id dengan nama file: $photoName");

        return $this->update($user_id, ['profil_foto' => $photoName]);
    }

    public function verifyPassword($user_id, $password)
    {
        $user = $this->where('user_id', $user_id)->first();

        if ($user) {
            return password_verify($password, $user['password']);
        }

        return false;
    }

    public function updatePassword($user_id, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        return $this->update($user_id, ['password' => $hashedPassword]);
    }
}
