<?php

namespace App\Controllers;

use App\Models\RiwayatModel; 

class RiwayatAdminController extends BaseController
{
    protected $riwayatModel; 

    public function __construct()
    {
        $this->riwayatModel = new RiwayatModel();
    }

    public function index(): string
    {
        $data['notulensi'] = $this->riwayatModel->getNotulensWithIsi();

        if (empty($data['notulensi'])) {
            log_message('error', 'Data notulensi gagal ditampilkan.');
        } else {
            log_message('info', 'Data notulensi berhasil ditampilkan: ' . print_r($data['notulensi'], true));
        }

        return view('admin/riwayatadmin', $data);
    }
}
