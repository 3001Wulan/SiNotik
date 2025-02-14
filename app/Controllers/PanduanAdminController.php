<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class PanduanAdminController extends BaseController
{
    public function index()
    {

        $data['current_page'] = 'panduan_admin';
        
        return view('admin/panduanadmin');
    }
}
