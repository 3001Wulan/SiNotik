<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user'; 
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'email', 'password', 'nama', 'role'];

    public function checkLogin($username)
{
    // Mengubah pencarian dari nama ke username (sesuaikan dengan nama kolom di database)
    $user = $this->where('username', $username)->first(); 
    log_message('error', 'Checking login for username: ' . $username);
    log_message('error', 'User data: ' . print_r($user, true));
    return $user;
}
    
}
