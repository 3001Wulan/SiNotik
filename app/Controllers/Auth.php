<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function login()
    {
        $session = session(); 

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('username'); 
            $password = $this->request->getPost('password'); 

            log_message('error', 'Login attempt with username: ' . $email);

            $authModel = new AuthModel(); 
            $user = $authModel->checkLogin($email); 

            if ($user && password_verify($password, $user['password'])) {
                log_message('error', 'Login success for username: ' . $email);

                $session->set([
                    'logged_in' => true,
                    'user_id' => $user['user_id'],
                    'nama' => $user['nama'],
                    'role' => $user['role']
                ]);

                return redirect()->to('/dashboard');
            } else {
                
                log_message('error', 'Login failed for username: ' . $email);
                
                $session->setFlashdata('error', 'Invalid username or password');
            
                return redirect()->back()->withInput(); 
            }
        }

        return view('login'); 
    }
}
