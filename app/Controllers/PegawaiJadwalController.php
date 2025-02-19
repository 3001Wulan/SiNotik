<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PegawaiJadwalModel;
use CodeIgniter\Controller;

class PegawaiJadwalController extends Controller
{
    public function index()
{
    $userModel = new UserModel();
    $jadwalModel = new PegawaiJadwalModel();
    $user_id = session()->get('user_id');

    if (!$user_id) {
        return redirect()->to('/login'); 
    }

    $userData = $userModel->getUserById($user_id);

    if (!$userData) {
        return redirect()->to('/error'); 
    }

    // Pastikan $user_id dikirim ke getJadwalByBidang()
    $jadwal = $jadwalModel->getJadwalByBidang($user_id);

    $data['user'] = $userData;
    $data['jadwal'] = $jadwal; // Simpan hasil query ke array $data

    return view('pegawai/jadwalrapat', $data);
}

public function getJadwalByBidang()
{
    $model = new PegawaiJadwalModel();
    $user_id = session()->get('user_id'); // Ambil user_id dari sesi

    if (!$user_id) {
        return $this->response->setJSON(['success' => false, 'message' => 'User tidak terautentikasi.']);
    }

    $data['jadwal'] = $model->getJadwalByBidang($user_id);
    return $this->response->setJSON($data);
}

    public function save()
    {
        $model = new PegawaiJadwalModel();
        $topik = $this->request->getPost('topik');
        $agenda = $this->request->getPost('agenda');
        $tanggal = $this->request->getPost('tanggal');
        $waktu = $this->request->getPost('waktu');
        $lokasi = $this->request->getPost('lokasi');
        $user_id = session()->get('user_id');
        if (!$agenda || !$tanggal || !$waktu || !$lokasi) {
            return $this->response->setJSON(['success' => false, 'message' => 'Semua field harus diisi.']);
        }

        if (!$user_id) {
            return $this->response->setJSON(['success' => false, 'message' => 'User tidak terautentikasi.']);
        }

        $data = [
            'topik' => $topik,
            'agenda' => $agenda,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'lokasi' => $lokasi,
            'user_id' => $user_id,  
        ];

        log_message('info', 'Data yang akan disimpan: ' . json_encode($data));

        if ($model->save($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil disimpan']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan data']);
        }
    }
}
