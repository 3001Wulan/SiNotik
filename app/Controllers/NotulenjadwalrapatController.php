<?php

namespace App\Controllers;

class NotulenjadwalrapatController extends BaseController
{
    public function index(): string
    {
        return view('admin/jadwalrapatadmin');
    }
}
