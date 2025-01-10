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
        
        // Aturan validasi
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[50]',
            'nip'      => 'required|numeric|exact_length[18]|is_unique[user.nip]', // Memastikan nama tabel dan kolom sesuai
            'email'    => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[6]',
            'confirm-password' => 'required|matches[password]',
        ]);

        // Mengecek apakah validasi gagal
        if (!$validation->withRequest($this->request)->run()) {
            // Log kesalahan validasi
            log_message('error', 'Validation errors: ' . json_encode($validation->getErrors()));
            return redirect()->back()->with('errors', $validation->getErrors());
        }

        // Menyiapkan data input
        $data = [
            'username' => $this->request->getPost('username'),
            'nip'      => $this->request->getPost('nip'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => 'pegawai', 
        ];

        // Inisialisasi model
        $userModel = new UserModel();

        // Cek jika pengguna berhasil disimpan
        try {
            $userModel->insert($data);
            // Log bahwa data berhasil dimasukkan
            log_message('info', 'User registered successfully: ' . json_encode($data));
            return redirect()->to('/login')->with('success', 'Registration successful. Please login.');
        } catch (\Exception $e) {
            // Tangkap kesalahan dan log
            log_message('error', 'Registration failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }
}
