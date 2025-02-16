<?php

namespace App\Controllers;

use App\Models\JadwalRapatModel;
use CodeIgniter\Controller;

class NotulenjadwalrapatController extends BaseController
{
    public function index(): string
    {
        return view('admin/jadwalrapatadmin');
    }

    public function submitJadwal()
    {
        $jadwalModel = new JadwalRapatModel();
        $session = session();
        $user_id = $session->get('user_id');
        $validation = \Config\Services::validation();
        $validation->setRules([
            'topik'   => 'required',
            'agenda'  => 'required',
            'tanggal' => 'required|valid_date',
            'waktu'   => 'required',
            'lokasi'  => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        

        $jadwalModel->save([
            'user_id' => $user_id,
            'topik'   => $this->request->getPost('topik'),
            'agenda'  => $this->request->getPost('agenda'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu'   => $this->request->getPost('waktu'),
            'lokasi'  => $this->request->getPost('lokasi'),
            'status'  => 'disetujui',
        ]);

        return redirect()->to('/admin/jadwalrapatadmin')->with('success', 'Jadwal rapat berhasil disimpan.');
    }
}
