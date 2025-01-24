<?php

namespace App\Controllers;

use App\Models\RiwayatModel;
use App\Models\PenggunaModel;

class RiwayatPegawaiController extends BaseController
{
    protected $riwayatModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();  
        $this->penggunaModel = new PenggunaModel(); 
    }

    public function index()
    {
        $user_id = session()->get('user_id'); 

        // Validasi user_id dari tabel user
        $pengguna = $this->penggunaModel->getUserById($user_id);

        if (!$pengguna) {
            // Jika data pengguna tidak ditemukan, arahkan ke halaman login
            log_message('error', 'Pengguna dengan user_id ' . $user_id . ' tidak ditemukan.');
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan. Silakan login kembali.');
        }

        // Mendapatkan data notulensi dengan informasi terkait
        $data['notulensi'] = $this->riwayatModel->getNotulensWithIsi($user_id);
        $data['pengguna'] = $pengguna; // Menyertakan data pengguna untuk view

        // Mengecek jika data kosong
        if (empty($data['notulensi'])) {
            log_message('error', 'Data notulensi gagal ditampilkan.');
        } else {
            log_message('info', 'Data notulensi berhasil ditampilkan: ' . print_r($data['notulensi'], true));
        }

        // Menampilkan view 'admin/riwayatadmin' dengan data
        return view('pegawai/riwayatpegawai', $data);
    }

}
