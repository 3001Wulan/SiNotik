<?php

namespace App\Controllers;

use App\Models\DashboardAdminModel;

class DashboardAdminController extends BaseController
{
    public function dashboardAdmin()
    {
        $dashboardAdminModel = new DashboardAdminModel();

        $totalPegawai = $dashboardAdminModel->getTotalPegawai();

        $pegawai = $dashboardAdminModel->getPegawai();

        $jumlahPegawaiPerBidang = $dashboardAdminModel->getJumlahPegawaiPerBidang();

        $totalNotulensi = $dashboardAdminModel->getTotalNotulensi();

        $jumlahNotulensiPerBidang = $dashboardAdminModel->getJumlahNotulensiPerBidang();

        return view('admin/dashboard_admin', [
            'total_pegawai' => $totalPegawai,
            'pegawai' => $pegawai,
            'jumlah_pegawai_per_bidang' => $jumlahPegawaiPerBidang,
            'total_notulensi' => $totalNotulensi,
            'jumlah_notulensi_per_bidang' => $jumlahNotulensiPerBidang
        ]);
    }
}
