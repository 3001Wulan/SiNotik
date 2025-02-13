<?php

namespace App\Controllers;

use App\Models\NotulensiModel;
use App\Models\DokumentasiModel;
use App\Models\FeedbackModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class DetailnotulenController extends BaseController
{
    public function lihatnotulen($id = null)
    {
        if ($id === null) {
            throw new PageNotFoundException('ID notulensi tidak ditemukan.');
        }

        $notulensiModel = new NotulensiModel();
        $dokumentasiModel = new DokumentasiModel();
        $feedbackModel = new FeedbackModel();

        $notulensi = $notulensiModel->getNotulensiById($id);
        
        if (!$notulensi) {
            throw new PageNotFoundException("Notulensi dengan ID $id tidak ditemukan.");
        }

        $dokumentasi = $dokumentasiModel->getDokumentasiByNotulensiId($id);
        $agenda = preg_split('/(?=\d+\.)/', $notulensi['agenda']);
        $agenda = array_filter($agenda);  

   
        $agendaIsi = is_string($notulensi['isi']) ? explode(',', $notulensi['isi']) : (array) $notulensi['isi'];

        if (count($agenda) > 1 && count($agendaIsi) == 1) {
            $agendaIsi = array_fill(0, count($agenda), $agendaIsi[0]);
        }

        $agendaIsi = array_map(function ($item) {
            return $item ?: 'Tidak ada isi untuk agenda ini'; 
        }, $agendaIsi);

        $data = [
            'id' => $id,
            'notulensi' => $notulensi,
            'agenda' => $agenda,  
            'agendaIsi' => $agendaIsi,  
            'dokumentasi' => $dokumentasi,
            'current_page' => 'notulensi',
            'allNotulensi' => $notulensiModel->findAll(),
            'allDokumentasi' => $dokumentasiModel->findAll(),
            'feedbacks' => $feedbackModel->getFeedbackByNotulensiId($id) 
        ];

        log_message('info', 'Data yang dikirim ke view: ' . print_r($data, true));
        
        return view('pegawai/detailnotulen', $data);
    }

    public function saveFeedback()
    {
        $feedbackModel = new FeedbackModel();
        
        $notulensi_id = $this->request->getVar('notulensi_id');
        $isi = $this->request->getVar('isi');

        if (empty($notulensi_id) || empty($isi)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Feedback tidak boleh kosong.']);
        }

        $data = [
            'notulensi_id' => $notulensi_id,
            'isi' => $isi,
            'tanggal_feedback' => date('Y-m-d H:i:s'),
            'user_id' => session()->get('user_id')
        ];

        if ($feedbackModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan feedback.']);
        }
    }
}
