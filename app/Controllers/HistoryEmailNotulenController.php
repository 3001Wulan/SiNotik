<?php

namespace App\Controllers;

class HistoryEmailNotulenController extends BaseController
{
    public function index(): string
    {
        return view('notulen/historynotulen');
    }
}
