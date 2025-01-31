<?php

namespace App\Controllers;

use App\Models\NotulensiModel;
use App\Models\DokumentasiModel;

class LihatNotulenController extends BaseController
{
    public function lihatnotulen($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID notulensi tidak ditemukan.');
        }

        $notulensiModel = new NotulensiModel();
        $dokumentasiModel = new DokumentasiModel();

        $notulensi = $notulensiModel->getNotulensiById($id); 
        
        if ($notulensi) {
            $dokumentasi = $dokumentasiModel->getDokumentasiByNotulensiId($id);
            $agenda = is_string($notulensi['agenda']) ? explode(',', $notulensi['agenda']) : (array) $notulensi['agenda'];
            $agendaIsi = is_string($notulensi['isi']) ? explode(',', $notulensi['isi']) : (array) $notulensi['isi'];
            $data = [
                'id' => $id,  
                'notulensi' => $notulensi,
                'agenda' => $agenda,  
                'agendaIsi' => $agendaIsi,  
                'dokumentasi' => $dokumentasi,
                'current_page' => 'notulensi'
            ];
    
            $allNotulensi = $notulensiModel->findAll(); 
            $allDokumentasi = $dokumentasiModel->findAll(); 
        
            $data['allNotulensi'] = $allNotulensi;
            $data['allDokumentasi'] = $allDokumentasi;
    
            log_message('info', 'Data yang dikirim ke view: ' . print_r($data, true));
        
            return view('notulen/detailnotulen', $data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Notulensi dengan ID $id tidak ditemukan.");
        }
    }
}
