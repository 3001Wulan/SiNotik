<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotulensiModel;

class MelihatNotulenController extends Controller
{
    public function lihat()
    {
        // Memuat model NotulensiModel
        $model = new NotulensiModel();

        // Mengambil data notulensi
        $data['notulensi'] = $model->getAllNotulensi();

        return view('notulen/melihatnotulen', $data);
    }
}
