<?php

namespace App\Controllers;

use App\Models\HistoryEmailModel;

class HistoryEmailNotulenController extends BaseController
{
    public function index(): string
    {
        $historyEmailModel = new HistoryEmailModel();
        $data['history_emails'] = $historyEmailModel->getAllHistoryEmails();
        $data['current_page'] = 'history_notulen';
        return view('notulen/historynotulen', $data);
    }
}
