<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class PanduanAdmin extends BaseController
{
    public function index()
    {
        $panduanAdminModel = new PanduanAdminModel();
        // Mengambil gambar profil pengguna berdasarkan user_id (misalnya user_id disimpan di session)
        $user_id = session()->get('user_id');  // Sesuaikan dengan session yang digunakan

        // Menambahkan log untuk mengecek nilai user_id
        log_message('debug', 'User ID: ' . $user_id);

        // Mengambil profil gambar berdasarkan user_id
        $profile_picture = $panduanAdminModel->getProfilePicture($user_id);

        // Jika gambar profil tidak ada, gunakan gambar default
        $profile_picture = $profile_picture['profil_foto'] ?? 'default.jpg';

        // Menambahkan log untuk mengecek gambar profil
        log_message('debug', 'Profile Picture: ' . $profile_picture);

        // Mengambil nama dan role pengguna
        $user = $panduanAdminModel->getUserInfo($user_id);

        $user_name = isset($user['nama']) && !empty($user['nama']) ? $user['nama'] : 'Guest';
        $user_role = isset($user['role']) && !empty($user['role']) ? $user['role'] : 'Unknown';

        log_message('debug', 'User Name: ' . $user_name);
        log_message('debug', 'User Role: ' . $user_role);

        $data['current_page'] = 'panduan_admin';
        
        return view('admin/panduanadmin');
    }
}
