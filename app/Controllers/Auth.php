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
                log_message('error', 'Password verify result for username ' . $email . ': ' . (password_verify($password, $user['password']) ? 'Success' : 'Failure'));

                if (password_verify($password, $user['password'])) {
                    log_message('error', 'Login success for username: ' . $email);

                    $session->set([
                        'logged_in' => true,
                        'user_id' => $user['user_id'],
                        'nama' => $user['nama'],
                        'role' => $user['role'],
                        'email' => $user['email'],
                        'profil_foto' => $user['profil_foto']
                    ]);

                    if ($user['role'] === 'admin') {
                        return redirect()->to('/admin/dashboard_admin');
                    } elseif ($user['role'] === 'pegawai') {
                        return redirect()->to('/pegawai/dashboard_pegawai');
                    } elseif ($user['role'] === 'notulensi') {
                        return redirect()->to('/notulen/dashboard_notulen');
                    } else {
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

    public function detailpengguna()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $profil_foto = $session->get('profil_foto') ? $session->get('profil_foto') : 'delvaut.png';

        $userData = [
            'user_id' => $session->get('user_id'),
            'nama' => $session->get('nama'),
            'email' => $session->get('email'),
            'role' => $session->get('role'),
            'profil_foto' => $session->get('profil_foto')
        ];

        log_message('info', 'User Data: ' . print_r($userData, true));
        return view('admin/detailpengguna', $userData);
    }

    public function ubahdatapengguna()
    {
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userData = [
            'user_id' => $session->get('user_id'),
            'nama' => $session->get('nama'),
            'email' => $session->get('email'),
            'role' => $session->get('role'),
            'profil_foto' => $session->get('profil_foto')
        ];

        log_message('info', 'User Data for Update: ' . print_r($userData, true));
        return view('admin/ubahdatapengguna', $userData);
    }
    public function detailnotulen()
{
    $session = session();

    if (!$session->get('logged_in')) {
        return redirect()->to('/login');
    }

    $profil_foto = $session->get('profil_foto') ? $session->get('profil_foto') : 'delvaut.png';

    $userData = [
        'user_id' => $session->get('user_id'),
        'nama' => $session->get('nama'),
        'email' => $session->get('email'),
        'role' => $session->get('role'),
        'profil_foto' => $profil_foto
    ];

    log_message('info', 'User Data for Notulensi: ' . print_r($userData, true));
    return view('notulen/detailnotulen', $userData);
}

}
