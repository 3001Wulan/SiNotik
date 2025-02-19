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
    $user = $this->where('username', $username)->first(); 
    return $user;
}
    
}
