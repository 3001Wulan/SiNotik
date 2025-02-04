<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PenggunaModel;
use App\Models\NotulensiModel;

class MelihatNotulenController extends Controller
{
    public function lihat()
    {
        $session = \Config\Services::session();
        $user_id = $session->get('user_id');
    
        if (!$user_id) {
            return redirect()->to('/login');
        }
    
        $penggunaModel = new PenggunaModel();
        $userData = $penggunaModel->getUserById($user_id);
    
        if (!$userData) {
            return redirect()->to('/login')->with('error', 'Pengguna tidak ditemukan.');
        }
    
        $model = new NotulensiModel();
        $data['notulensi'] = $model->getAllNotulensi();
        $data['user'] = $userData;
    
        // Tambahkan variabel current_page
        $data['current_page'] = 'melihatnotulen';
    
        return view('notulen/melihatnotulen', $data);
        }
}
