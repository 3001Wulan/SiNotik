<?php

namespace App\Controllers;
use App\Models\HistoryEmailModel;

class HistoryEmailAdminController extends BaseController

{
    public function index(): string
    {
        $historyEmailModel = new HistoryEmailModel();
        $data['history_emails'] = $historyEmailModel->getAllHistoryEmails();
        $data['current_page'] = 'history_admin';
        return view('admin/historyadmin', $data);
    }
}
