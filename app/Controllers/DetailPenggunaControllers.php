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
            $user_id = $this->session->get('user_id');
            if (!$user_id) {
                log_message('error', 'User not logged in or session expired.');
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengguna tidak ditemukan atau sesi telah kedaluwarsa.");
            }
        }

        log_message('info', 'Attempting to retrieve user profile for user with ID: ' . $user_id);

        $user_profile = $this->userModel->find($user_id);
        if ($user_profile) {
            log_message('info', 'User profile for ID ' . $user_id . ' retrieved successfully.');

            // Menambahkan log untuk memeriksa data yang akan dikirim ke view
            log_message('info', 'User profile data: ' . print_r($user_profile, true));

            $profil_foto = str_replace('__', '', $user_profile['profil_foto']);

            $data['user_profile'] = $user_profile;
            $data['user_profile']['profil_foto'] = $profil_foto;  
            
            return view('admin/detailpengguna', $data);
        } else {
            log_message('error', 'User profile with ID ' . $user_id . ' not found.');
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Pengguna dengan ID $user_id tidak ditemukan.");
        }
    }

    public function hapusData()
    {
        log_message('info', 'Attempting to delete user data.');

        $request = \Config\Services::request();
        $data = $request->getJSON(); 

        if (isset($data->user_id)) {
            $user_id = $data->user_id;
            log_message('info', 'Attempting to delete user with ID: ' . $user_id);

            $result = $this->userModel->delete($user_id);

            if ($result) {
                log_message('info', 'User with ID ' . $user_id . ' successfully deleted.');
                return $this->response->setJSON(['success' => true]);
            } else {
                log_message('error', 'Failed to delete user with ID ' . $user_id);
                return $this->response->setJSON(['success' => false]);
            }
        }
        log_message('error', 'No user_id provided in the delete request.');
        return $this->response->setJSON(['success' => false]);
    }
}
