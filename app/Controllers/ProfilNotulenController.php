<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfilNotulenController extends BaseController
{
    public function profilNotulen()
    {
        $userModel = new UserModel();
    
        $user_id = session()->get('user_id');
        $user_profile = $userModel->find($user_id);

        if (!$user_profile) {
            log_message('error', 'User profile with ID ' . $user_id . ' not found.');
            $user_profile = [];
        } else {
            log_message('info', 'User profile for ID ' . $user_id . ' retrieved successfully.');
        }

        $data = [
            'user_profile' => $user_profile,
            'current_page' => 'profil_notulen'
        ];

        return view('notulen/profilnotulen', $data);
    }
}
