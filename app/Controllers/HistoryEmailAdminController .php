<?php

namespace App\Controllers;

class HistoryEmailAdminController extends BaseController
{
    public function index(): string
    {
        return view('admin/historyadmin');
    }
}
