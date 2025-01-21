<?php

namespace App\Controllers;

use App\Models\DashboardAdminModel;

class DashboardAdminController extends BaseController
{
    public function dashboardAdmin()
    {
      
        $dashboardAdminModel = new DashboardAdminModel();
        $totalPegawai = $dashboardAdminModel->getTotalPegawai();
        $pegawai = $dashboardAdminModel->getPegawai();
        $jumlahPegawaiPerBidang = $dashboardAdminModel->getJumlahPegawaiPerBidang();
        $totalNotulensi = $dashboardAdminModel->getTotalNotulensi();
        $jumlahNotulensiPerBidang = $dashboardAdminModel->getJumlahNotulensiPerBidang();

        // Mengambil gambar profil pengguna berdasarkan user_id (misalnya user_id disimpan di session)
        $user_id = session()->get('user_id');  // Sesuaikan dengan session yang digunakan

        // Menambahkan log untuk mengecek nilai user_id
        log_message('debug', 'User ID: ' . $user_id);

        // Mengambil profil gambar berdasarkan user_id
        $profile_picture = $dashboardAdminModel->getProfilePicture($user_id);

        // Jika gambar profil tidak ada, gunakan gambar default
        $profile_picture = $profile_picture['profil_foto'] ?? 'default.jpg';

        // Menambahkan log untuk mengecek gambar profil
        log_message('debug', 'Profile Picture: ' . $profile_picture);

        // Mengambil nama dan role pengguna
        $user = $dashboardAdminModel->getUserInfo($user_id);

        $user_name = isset($user['nama']) && !empty($user['nama']) ? $user['nama'] : 'Guest';
        $user_role = isset($user['role']) && !empty($user['role']) ? $user['role'] : 'Unknown';

        log_message('debug', 'User Name: ' . $user_name);
        log_message('debug', 'User Role: ' . $user_role);

        return view('admin/dashboard_admin', [
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
