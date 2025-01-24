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
        $this->riwayatModel = new RiwayatModel();  // Memanggil Model RiwayatModel
        $this->penggunaModel = new PenggunaModel(); // Memanggil Model PenggunaModel
    }

    // Fungsi untuk menampilkan data notulensi
    public function index()
    {
        // Mendapatkan user_id dari sesi
        $user_id = session()->get('user_id'); // Pastikan user_id disimpan di sesi saat login

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
        return view('admin/riwayatadmin', $data);
    }

    // Fungsi untuk menghapus data notulensi berdasarkan ID
    public function delete($id)
    {
        // Mendapatkan user_id dari sesi
        $user_id = session()->get('user_id');

        // Validasi user_id dari tabel user
        $pengguna = $this->penggunaModel->getUserById($user_id);

        if (!$pengguna) {
            // Jika data pengguna tidak ditemukan, kirimkan response gagal
            log_message('error', 'Pengguna dengan user_id ' . $user_id . ' tidak ditemukan saat mencoba menghapus data.');
            return $this->response->setJSON(['success' => false, 'message' => 'Data pengguna tidak valid.']);
        }

        // Memanggil model untuk menghapus data berdasarkan ID dan user_id
        $deleted = $this->riwayatModel->deleteNotulensiById($id, $user_id);

        if ($deleted) {
            // Jika berhasil menghapus, mengirimkan response success
            return $this->response->setJSON(['success' => true]);
        } else {
            // Jika gagal menghapus, mengirimkan response gagal
            return $this->response->setJSON(['success' => false, 'message' => 'Data gagal dihapus.']);
        }
    }
}
