<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotulensiModel;
use App\Models\PenggunaModel;  // Menambahkan model Pengguna

class MelihatNotulenPegawaiController extends Controller
{
    public function lihat()
    {
        // Memuat session
        $session = \Config\Services::session();
        
        // Mendapatkan user_id dari session
        $user_id = $session->get('user_id');
        
        // Mengecek apakah user_id ada dalam session
        if (!$user_id) {
            // Jika tidak ada, bisa diarahkan ke halaman login
            return redirect()->to('/login');
        }

        // Memuat model PenggunaModel
        $penggunaModel = new PenggunaModel();
        
        // Mengambil data pengguna berdasarkan user_id
        $userData = $penggunaModel->getUserById($user_id);
        
        if (!$userData) {
            // Jika tidak ditemukan, bisa menampilkan pesan error atau redirect
            return redirect()->to('/login')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Memuat model NotulensiModel
        $model = new NotulensiModel();

        // Mengambil data notulensi
        $data['notulensi'] = $model->getAllNotulensi();
        
        // Menyertakan data pengguna dalam tampilan (misalnya untuk menampilkan informasi pengguna di halaman)
        $data['user'] = $userData;

        return view('pegawai/melihatpegawai', $data);  // Mengirimkan data ke tampilan
    }
}
