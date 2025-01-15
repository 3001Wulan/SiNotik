<?php

namespace App\Controllers;

use App\Models\DataPenggunaModel;
use App\Models\UserModel;

class DetailPenggunaController extends BaseController
{
    public function index()
    {

        $dataPenggunaModel = new DataPenggunaModel();
        
        $data['users'] = $dataPenggunaModel->getUsersByRole('notulensi');

        $userModel = new UserModel();
    
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

