<?php

namespace App\Controllers;

use App\Models\DashboardAdminModel;

class DashboardPegawaiController extends BaseController
{
    public function dashboardPegawai()  
    {
        $dashboardAdminModel = new DashboardAdminModel();
        $totalPegawai = $dashboardAdminModel->getTotalPegawai();
        $pegawai = $dashboardAdminModel->getPegawai();
        $jumlahPegawaiPerBidang = $dashboardAdminModel->getJumlahPegawaiPerBidang();
        $totalNotulensi = $dashboardAdminModel->getTotalNotulensi();
        $jumlahNotulensiPerBidang = $dashboardAdminModel->getJumlahNotulensiPerBidang();

        $user_id = session()->get('user_id');  


        $profile_picture = $dashboardAdminModel->getProfilePicture($user_id);

        $profile_picture = $profile_picture['profil_foto'] ?? 'default.jpg';

        log_message('debug', 'Profile Picture: ' . $profile_picture);

        $user = $dashboardAdminModel->getUserInfo($user_id);

        $user_name = isset($user['nama']) && !empty($user['nama']) ? $user['nama'] : 'Guest';
        $user_role = isset($user['role']) && !empty($user['role']) ? $user['role'] : 'Unknown';

        log_message('debug', 'User Name: ' . $user_name);
        log_message('debug', 'User Role: ' . $user_role);

        return view('pegawai/dashboard_pegawai', [
            'total_pegawai' => $totalPegawai,
            'pegawai' => $pegawai,
            'jumlah_pegawai_per_bidang' => $jumlahPegawaiPerBidang,
            'total_notulensi' => $totalNotulensi,
            'jumlah_notulensi_per_bidang' => $jumlahNotulensiPerBidang,
            'profile_picture' => $profile_picture,  
            'user_name' => $user_name,              
            'user_role' => $user_role,
            'current_page' => 'dashboard'              
        ]);
    }
}
