<?php

namespace App\Controllers;

use App\Models\PegawaiJadwalModel;

class PersetujuanAdminController extends BaseController
{
    public function index()
{
    $pegawaiJadwalModel = new PegawaiJadwalModel();
    $data['jadwal_rapat'] = $pegawaiJadwalModel->getPendingJadwal();
    $data['current_page'] = 'persetujuan_admin'; // Tambahkan ini
    return view('admin/persetujuanadmin', $data);
}

    public function approvemeeting()
    {
        $input = $this->request->getJSON();
        $meetingId = $input->id;
        $pegawaiJadwalModel = new PegawaiJadwalModel();
        $result = $pegawaiJadwalModel->updateMeetingStatus($meetingId, 'Disetujui');
        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function rejectMeeting($meetingId)
    {
        $input = $this->request->getJSON();
        if (!isset($input->reason)) {
            return $this->response->setJSON(['success' => false, 'error' => 'Alasan tidak ditemukan.']);
        }
        
        $alasan = $input->reason; 
        $pegawaiJadwalModel = new PegawaiJadwalModel();
        $result = $pegawaiJadwalModel->updateMeetingStatus($meetingId, 'Ditolak', $alasan);
        
        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}