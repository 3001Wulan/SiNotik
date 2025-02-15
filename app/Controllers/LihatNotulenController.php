<?php

namespace App\Controllers;

use App\Models\NotulensiModel;
use App\Models\DokumentasiModel;
use App\Models\FeedbackModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class LihatNotulenController extends BaseController
{
    private function parseStringToArray($string)
    {
        return isset($string) && is_string($string) ? array_map('trim', explode("\r\n", $string)) : [];
    }

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

        $data = [
            'id' => $id,
            'notulensi' => $notulensi,
            'agenda' => $this->parseStringToArray($notulensi['agenda'] ?? ''),
            'agendaIsi' => $notulensi['isi'] ?? '',
            'dokumentasi' => $dokumentasiModel->getDokumentasiByNotulensiId($id),
            'current_page' => 'notulensi',
            'allNotulensi' => $notulensiModel->findAll() ?: [],
            'allDokumentasi' => $dokumentasiModel->findAll() ?: [],
            'feedbacks' => $feedbackModel->getFeedbackByNotulensiId($id) ?: [],
            'partisipan' => $this->parseStringToArray($notulensi['partisipan'] ?? ''),
            'partisipan_non_pegawai' => $this->parseStringToArray($notulensi['partisipan_non_pegawai'] ?? '')
        ];

        log_message('debug', 'Data dikirim ke view: ' . json_encode($data));

        return view('notulen/detailnotulen', $data);
    }

    public function saveFeedback()
    {
        $feedbackModel = new FeedbackModel();
        
        $notulensi_id = $this->request->getVar('notulensi_id');
        $isi = trim($this->request->getVar('isi'));
        $user_id = session()->get('user_id');

        if (empty($notulensi_id) || empty($isi)) {
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => 'Feedback tidak boleh kosong.'
            ]);
        }

        if (!$user_id) {
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => 'Anda harus login untuk memberikan feedback.'
            ]);
        }

        // Validasi apakah notulensi_id ada di database
        $notulensiModel = new NotulensiModel();
        if (!$notulensiModel->find($notulensi_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Notulensi tidak ditemukan.'
            ]);
        }

        $data = [
            'notulensi_id' => $notulensi_id,
            'isi' => esc($isi), // Hindari XSS
            'tanggal_feedback' => date('Y-m-d H:i:s'),
            'user_id' => $user_id
        ];

        log_message('debug', 'Data feedback disimpan: ' . json_encode($data));

        if ($feedbackModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => 'Gagal menyimpan feedback.'
            ]);
        }
    }
}