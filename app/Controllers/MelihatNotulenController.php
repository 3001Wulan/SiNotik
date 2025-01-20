<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class MelihatNotulenController extends Controller
{
    public function lihat()
    {
        return view('notulen/melihatnotulen');
    }
}