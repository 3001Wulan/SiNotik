<?php

namespace App\Controllers;

use App\Models\RiwayatModel;
use App\Models\PenggunaModel;

class RiwayatAdminController extends BaseController
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
        $pengguna = $this->penggunaModel->getUserById($user_id);

        if (!$pengguna) {
            log_message('error', 'Pengguna dengan user_id ' . $user_id . ' tidak ditemukan.');
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan. Silakan login kembali.');
        }

        $data['notulensi'] = $this->riwayatModel->getNotulensWithIsi($user_id);
        $data['pengguna'] = $pengguna; 
        $data['current_page'] = 'riwayat_notulensi';


        if (empty($data['notulensi'])) {
            log_message('error', 'Data notulensi gagal ditampilkan.');
        } else {
            log_message('info', 'Data notulensi berhasil ditampilkan: ' . print_r($data['notulensi'], true));
        }

        return view('admin/riwayatadmin', $data);
    }

    public function delete($id)
    {
        $user_id = session()->get('user_id');

        $pengguna = $this->penggunaModel->getUserById($user_id);

        if (!$pengguna) {
            log_message('error', 'Pengguna dengan user_id ' . $user_id . ' tidak ditemukan saat mencoba menghapus data.');
            return $this->response->setJSON(['success' => false, 'message' => 'Data pengguna tidak valid.']);
        }

        $deleted = $this->riwayatModel->deleteNotulensiById($id, $user_id);

        if ($deleted) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Data gagal dihapus.']);
        }
    }
}
