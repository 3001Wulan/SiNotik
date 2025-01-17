<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'nama', 'nip', 'email', 'role', 'bidang', 'jabatan', 'profil_foto', 'password'];
    protected $useTimestamps = true;
}
