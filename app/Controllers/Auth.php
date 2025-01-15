<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function login()
{
    $session = session(); 

    if ($this->request->getMethod() === 'POST') {
        $email = $this->request->getPost('username'); 
        $password = $this->request->getPost('password'); 

        log_message('error', 'Login attempt with username: ' . $email);

        $authModel = new AuthModel(); 
        $user = $authModel->checkLogin($email); 

        if ($user) {
            // Log the password verification result
            log_message('error', 'Password verify result for username ' . $email . ': ' . (password_verify($password, $user['password']) ? 'Success' : 'Failure'));

            if (password_verify($password, $user['password'])) {
                log_message('error', 'Login success for username: ' . $email);

                $session->set([
                    'logged_in' => true,
                    'user_id' => $user['user_id'],
                    'nama' => $user['nama'],
                    'role' => $user['role']
                ]);

                // Redirect berdasarkan role pengguna
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard_admin');
                } elseif ($user['role'] === 'pegawai') {
                    return redirect()->to('/pegawai/dashboard_pegawai');
                } elseif ($user['role'] === 'notulen') {
                    return redirect()->to('/notulen/dashboard');
                } else {
                    // Arahkan ke halaman default jika role tidak dikenali
                    return redirect()->to('/default/dashboard');
                }
            } else {
                log_message('error', 'Login failed for username: ' . $email);
                $session->setFlashdata('error', 'Invalid username or password');
                return redirect()->back()->withInput(); 
            }
        } else {
            log_message('error', 'User not found for username: ' . $email);
            return redirect()->back()->withInput();
        }
    }

    return view('login'); 
}
}