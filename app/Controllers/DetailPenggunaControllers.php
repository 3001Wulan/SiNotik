<?php

namespace App\Controllers;

use App\Models\UserModel;

class DetailPenggunaControllers extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();  
        $this->session = \Config\Services::session();  
    }

    public function index($user_id = null)
    {
        if ($user_id === null) {
            // Mengambil user_id dari session
            $user_id = $this->session->get('user_id');
            if (!$user_id) {
                log_message('error', 'User not logged in or session expired.');
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengguna tidak ditemukan atau sesi telah kedaluwarsa.");
            }
        }

        log_message('info', 'Attempting to retrieve user profile for user with ID: ' . $user_id);

        // Mencari data pengguna berdasarkan user_id
        $user_profile = $this->userModel->find($user_id);

        // Mengecek apakah pengguna ditemukan
        if ($user_profile) {
            log_message('info', 'User profile for ID ' . $user_id . ' retrieved successfully.');

            // Menambahkan log untuk memeriksa data yang akan dikirim ke view
            log_message('info', 'User profile data: ' . print_r($user_profile, true));

            // Menghapus suffix '__' dari nama file profil foto jika ada
            $profil_foto = str_replace('__', '', $user_profile['profil_foto']);

            // Menambahkan data yang sudah diperbaiki ke array $data
            $data['user_profile'] = $user_profile;
            $data['user_profile']['profil_foto'] = $profil_foto;  // Menggantikan nama file yang ada dengan nama yang telah dibersihkan
            
            // Mengirim data pengguna ke view
            return view('admin/detailpengguna', $data);
        } else {
            log_message('error', 'User profile with ID ' . $user_id . ' not found.');
            // Jika pengguna tidak ditemukan, menampilkan halaman error
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengguna dengan ID $user_id tidak ditemukan.");
        }
    }

    // Method untuk menghapus data pengguna
    public function hapusData()
    {
        log_message('info', 'Attempting to delete user data.');

        // Mengambil data request JSON
        $request = \Config\Services::request();
        $data = $request->getJSON(); 

        // Mengecek apakah user_id ada di data request
        if (isset($data->user_id)) {
            $user_id = $data->user_id;
            log_message('info', 'Attempting to delete user with ID: ' . $user_id);

            // Menghapus data pengguna berdasarkan user_id
            $result = $this->userModel->delete($user_id);

            // Mengirimkan respon JSON apakah penghapusan berhasil atau gagal
            if ($result) {
                log_message('info', 'User with ID ' . $user_id . ' successfully deleted.');
                return $this->response->setJSON(['success' => true]);
            } else {
                log_message('error', 'Failed to delete user with ID ' . $user_id);
                return $this->response->setJSON(['success' => false]);
            }
        }

        // Jika tidak ada user_id pada request, mengirimkan respon gagal
        log_message('error', 'No user_id provided in the delete request.');
        return $this->response->setJSON(['success' => false]);
    }
}
