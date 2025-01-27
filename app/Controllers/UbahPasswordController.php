<?php

namespace App\Controllers;

class UbahPasswordController extends BaseController
{
    public function ubah(): string
    {
        return view('admin/ubahpassword');
    }
}
