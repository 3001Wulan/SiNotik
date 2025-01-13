<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'nip', 'email', 'password', 'role', 'profil_foto', 'alamat', 'jabatan', 'tanggal_lahir'];
    protected $useTimestamps = true;

    public function getUserById($user_id)
    {
        log_message('info', 'Attempting to retrieve user profile with ID ' . $user_id);
        
        $user = $this->find($user_id);

        if (!$user) {
            log_message('error', 'User with ID ' . $user_id . ' not found in database.');
        } else {
            log_message('info', 'User with ID ' . $user_id . ' found in database.');
        }

        return $user;
    }
}
