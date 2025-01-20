<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class NotulenController extends Controller
{
    public function create()
    {
        return view('notulen/buatnotulen');
    }
    public function simpan()
{
    $judul = $this->request->getPost('judul');
    $agenda = $this->request->getPost('agenda');
    $tanggal = $this->request->getPost('tanggal');
    $partisipan = $this->request->getPost('partisipan');
    $pembahasan = $this->request->getPost('pembahasan');

    $fileName = null;
    if ($file = $this->request->getFile('upload')) {
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName(); 
            $file->move('./uploads', $fileName); 
        } else {
            return redirect()->back()->with('error', $file->getErrorString());
        }
    }

    $data = [
        'judul' => $judul,
        'agenda' => $agenda,
        'tanggal' => $tanggal,
        'partisipan' => $partisipan,
        'pembahasan' => $pembahasan,
        'upload' => $fileName, 
    ];

    $notulensiModel = new \App\Models\NotulensiModel();
    $notulensiModel->insert($data);

    return redirect()->to('/notulen/success')->with('message', 'Notulensi berhasil disimpan');
}

    
}
