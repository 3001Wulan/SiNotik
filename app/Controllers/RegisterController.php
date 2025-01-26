<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function register()
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[50]',
            'nip'      => 'required|numeric|exact_length[18]|is_unique[user.nip]', 
            'email'    => 'required|valid_email|is_unique[user.email]',
            'bidang'   => 'required', 
            'password' => 'required|min_length[6]',
            'confirm-password' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Validation errors: ' . json_encode($validation->getErrors()));
            return redirect()->back()->with('errors', $validation->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'nip'      => $this->request->getPost('nip'),
            'email'    => $this->request->getPost('email'),
            'bidang'   => $this->request->getPost('bidang'), 
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => 'pegawai',
        ];
        $userModel = new UserModel();
        try {
            $userModel->insert($data);
            log_message('info', 'User registered successfully: ' . json_encode($data));
            return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            log_message('error', 'Registration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }
}
