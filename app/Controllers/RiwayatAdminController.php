<?php

namespace App\Controllers;

use App\Models\RiwayatModel;

class RiwayatAdminController extends BaseController
{
    protected $riwayatModel;

    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();  // Memanggil Model RiwayatModel
    }

    // Fungsi untuk menampilkan data notulensi
    public function index()
    {
        // Mendapatkan data notulensi dengan informasi terkait
        $data['notulensi'] = $this->riwayatModel->getNotulensWithIsi();

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
        // Memanggil model untuk menghapus data berdasarkan ID
        $deleted = $this->riwayatModel->deleteNotulensiById($id);

        if ($deleted) {
            // Jika berhasil menghapus, mengirimkan response success
            return $this->response->setJSON(['success' => true]);
        } else {
            // Jika gagal menghapus, mengirimkan response gagal
            return $this->response->setJSON(['success' => false, 'message' => 'Data gagal dihapus.']);
        }
    }
}
