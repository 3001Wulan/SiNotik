<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class PanduanPegawaiController extends BaseController
{
    public function index()
    {

        $data['current_page'] = 'panduan_admin';
        
        return view('pegawai/panduanpegawai');
    }
}
