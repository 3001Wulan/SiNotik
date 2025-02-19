<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class PanduanNotulenController extends BaseController
{
    public function index()
    {

        $data['current_page'] = 'panduan_admin';
        
        return view('notulen/panduannotulen');
    }
}
