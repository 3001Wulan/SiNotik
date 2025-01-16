<?php

namespace App\Controllers;

class RiwayatAdminController extends BaseController
{
    public function index(): string
    {
        return view('admin/riwayatadmin');
    }
}
