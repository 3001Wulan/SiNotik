<?php

namespace App\Controllers;

use App\Models\DashboardAdminModel;

class DashboardNotulenController extends BaseController
{
    public function dashboardNotulensi()  
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
        $user = $dashboardAdminModel->getUserInfo($user_id);

        $user_name = isset($user['nama']) && !empty($user['nama']) ? $user['nama'] : 'Guest';
        $user_role = isset($user['role']) && !empty($user['role']) ? $user['role'] : 'Unknown';


        return view('notulen/dashboard_notulen', [
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
