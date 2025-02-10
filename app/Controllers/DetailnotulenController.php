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

        // Pemisahan agenda tanpa mencocokkan dengan agendaIsi
        $agenda = preg_split('/(?=\d+\.)/', $notulensi['agenda']);
        $agenda = array_filter($agenda);  // Menghapus elemen kosong jika ada

        // Mengambil isi yang tidak terkait dengan agenda
        $agendaIsi = is_string($notulensi['isi']) ? explode(',', $notulensi['isi']) : (array) $notulensi['isi'];

        // Mengatasi jika hanya ada satu isi namun ada lebih dari satu agenda
        if (count($agenda) > 1 && count($agendaIsi) == 1) {
            // Jika hanya ada satu isi, maka bagi untuk setiap agenda
            $agendaIsi = array_fill(0, count($agenda), $agendaIsi[0]);
        }

        // Jika tidak ada agendaIsi, ganti dengan default 'Tidak ada isi'
        $agendaIsi = array_map(function ($item) {
            return $item ?: 'Tidak ada isi untuk agenda ini'; // Jika kosong, ganti dengan default
        }, $agendaIsi);

        $data = [
            'id' => $id,
            'notulensi' => $notulensi,
            'agenda' => $agenda,  // Mengirimkan agenda tanpa mengaitkan dengan isi
            'agendaIsi' => $agendaIsi,  // Hanya mengirimkan isi agenda
            'dokumentasi' => $dokumentasi,
            'current_page' => 'notulensi',
            'allNotulensi' => $notulensiModel->findAll(),
            'allDokumentasi' => $dokumentasiModel->findAll(),
            'feedbacks' => $feedbackModel->getFeedbackByNotulensiId($id) // Mengambil feedback terkait notulensi ini
        ];

        log_message('info', 'Data yang dikirim ke view: ' . print_r($data, true));
        
        return view('pegawai/detailnotulen', $data);
    }

    public function saveFeedback()
    {
        $feedbackModel = new FeedbackModel();
        
        $notulensi_id = $this->request->getVar('notulensi_id');
        $isi = $this->request->getVar('isi');

        // Validasi input
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
