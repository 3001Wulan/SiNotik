<?php

namespace App\Controllers;

use App\Models\DashboardAdminModel;

class DashboardAdminController extends BaseController
{
    public function dashboardAdmin()
    {
        // Membuat instance model DashboardAdminModel
        $dashboardAdminModel = new DashboardAdminModel();

        // Mengambil jumlah total pegawai
        $totalPegawai = $dashboardAdminModel->getTotalPegawai();

        // Mengambil data pegawai untuk ditampilkan
        $pegawai = $dashboardAdminModel->getPegawai();

        // Mengambil data jumlah pegawai per bidang
        $jumlahPegawaiPerBidang = $dashboardAdminModel->getJumlahPegawaiPerBidang();

        // Mengirim data ke view
        return view('admin/dashboard_admin', [
            'total_pegawai' => $totalPegawai,
            'pegawai' => $pegawai,
            'jumlah_pegawai_per_bidang' => $jumlahPegawaiPerBidang
        ]);
    }
}
