<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthRedirect extends Controller
{
    public function blockAccess()
    {
        return redirect()->to('login');
    }
}
