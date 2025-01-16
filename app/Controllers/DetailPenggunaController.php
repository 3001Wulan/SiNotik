<?php

namespace App\Controllers;

use App\Models\DataPenggunaModel;
use App\Models\UserModel;

class DetailPenggunaController extends BaseController
{
    public function index()
    {
        $dataPenggunaModel = new DataPenggunaModel();

        // Mengambil pengguna dengan role "notulensi" dan "pegawai"
        $data['users'] = $dataPenggunaModel->getUsersByRoles('notulensi', 'pegawai');

        $userModel = new UserModel();

        // Mengambil profil pengguna berdasarkan sesi user_id
        $user_id = session()->get('user_id');
        $user_profile = $userModel->find($user_id);

        if (!$user_profile) {
            log_message('error', 'User profile with ID ' . $user_id . ' not found.');
            $user_profile = [];
        } else {
            log_message('info', 'User profile for ID ' . $user_id . ' retrieved successfully.');
        }

        $data['user_profile'] = $user_profile;

        return view('admin/data_pengguna', $data);
    }

    public function hapusData()
    {
        $request = \Config\Services::request();
        $data = $request->getJSON(); 

        if (isset($data->user_id)) {
            $user_id = $data->user_id;

            $dataPenggunaModel = new DataPenggunaModel();
            $result = $dataPenggunaModel->delete($user_id);

            if ($result) {
                return $this->response->setJSON(['success' => true]);
            } else {
                return $this->response->setJSON(['success' => false]);
            }
        }

        return $this->response->setJSON(['success' => false]);
    }
}
