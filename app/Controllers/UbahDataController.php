<?php

namespace App\Controllers;

class UbahDataController extends BaseController
{
    public function ubahDataPengguna(): string
    {
        return view('admin/ubahdatapengguna');
    }
}
