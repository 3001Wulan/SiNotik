<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotulensiModel;
use App\Models\PenggunaModel;

class MelihatNotulenPegawaiController extends Controller
{
    public function lihat()
{
    $session = session();
    $user_id = $session->get('user_id');

    if (!$user_id) {
        return redirect()->to('/login');
    }

    $penggunaModel = new PenggunaModel();
    $userData = $penggunaModel->getUserById($user_id);

    if (!$userData) {
        return redirect()->to('/login')->with('error', 'Pengguna tidak ditemukan.');
    }

    $bidang = $userData['Bidang'] ?? null;
    
    if (!$bidang) {
        return redirect()->to('/login')->with('error', 'Bidang pengguna tidak ditemukan.');
    }

    $model = new NotulensiModel();
    $data['notulensi'] = $model->getNotulensiByUserIdAndBidang($bidang);
    $data['user'] = $userData;
    $data['current_page'] = 'melihat_pegawai';

    return view('pegawai/melihatpegawai', $data);
}
}