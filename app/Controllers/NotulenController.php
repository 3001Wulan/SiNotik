<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotulensiModel;
use App\Models\RiwayatModel;
use App\Models\DokumentasiModel;
use CodeIgniter\Email\Email;

class NotulenController extends Controller
{
    public function create()
    {
        $user_id = session()->get('user_id');
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $userData = $builder->select('nama, role, profil_foto')
                            ->where('user_id', $user_id)
                            ->get()
                            ->getRowArray();

        $data = [
            'nama' => $userData['nama'] ?? 'Nama Tidak Ditemukan',
            'role' => $userData['role'] ?? 'Role Tidak Ditemukan',
            'profil_foto' => $userData['profil_foto'] ?? 'default.jpg',
            'current_page' => 'buat_notulen', 
        ];

        return view('notulen/buatnotulen', $data);
    }

    public function simpan()
    {
        $judul = $this->request->getPost('judul');
        $agenda = $this->request->getPost('agenda');
        $tanggal = $this->request->getPost('tanggal');
        $partisipan = $this->request->getPost('partisipan');
        $partisipan_non_pegawai = $this->request->getPost('partisipan_non_pegawai');
        $email = $this->request->getPost('email');
        $pembahasan = $this->request->getPost('pembahasan');
        $tanggal_dibuat = date('Y-m-d');
        $user_id = session()->get('user_id');
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $bidang = $builder->select('bidang')
                          ->where('user_id', $user_id)
                          ->get()
                          ->getRowArray();
        $bidang = $bidang['bidang'] ?? 'default_bidang';
        
        $fileName = null;
        if ($file = $this->request->getFile('upload')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $fileName = $file->getRandomName();
                $file->move('./uploads', $fileName);
            } else {
                return redirect()->back()->with('error', $file->getErrorString());
            }
        }

        $notulensiModel = new NotulensiModel();
        $notulensiData = [
            'judul' => $judul,
            'agenda' => $agenda,
            'tanggal_dibuat' => $tanggal_dibuat,
            'tanggal' => $tanggal,
            'partisipan' => $partisipan,
            'partisipan_non_pegawai' => $partisipan_non_pegawai,
            'upload' => $fileName,
            'user_id' => $user_id,
            'isi' => $pembahasan,
            'bidang' => $bidang,
        ];

        $riwayatModel = new RiwayatModel();
        $notulensi_id = $notulensiModel->insert($notulensiData);
        $riwayatModel->insert([
            'notulensi_id' => $notulensi_id
        ]);

        if ($fileName) {
            $dokumentasiModel = new DokumentasiModel();
            $dokumentasiData = [
                'notulensi_id' => $notulensi_id,
                'foto_dokumentasi' => $fileName,
            ];
            $dokumentasiModel->save($dokumentasiData);
        }

        $emailService = \Config\Services::email();
        $emailService->setFrom('sinotik3@gmail.com', 'Notulensi Diskominfo Solok Selatan');
        $emailService->setSubject('Notulensi Rapat: ' . $judul);
        
        $message = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .highlight { font-weight: bold; }
            </style>
        </head>
        <body>
            <p><strong>Yth. Bapak/Ibu,</strong></p>
            <p>Berikut adalah notulensi rapat yang telah diselenggarakan:</p>
            <p><strong>Judul Rapat:</strong> $judul</p>
            <p><strong>Agenda:</strong><br> " . nl2br(implode("\n", (array) $agenda)) . "</p>
            <p><strong>Partisipan Pegawai:</strong><br> " . nl2br(implode("\n", (array) $partisipan)) . "</p>
            <p><strong>Partisipan Non-Pegawai:</strong><br> " . nl2br(implode("\n", (array) $partisipan_non_pegawai)) . "</p>
            <p><strong>Pembahasan:</strong><br> $pembahasan </p>
            <p>📧 Untuk pertanyaan lebih lanjut, silakan hubungi kami di <strong>sinotik3@gmail.com</strong></p>
            <p>Salam,<br>  <strong>Diskominfo Solok Selatan</strong></p>
        </body>
        </html>";

        $emailService->setMessage($message);
        $emailService->setMailType('html'); 
        $emailService->send();

        $emails = preg_split('/[\s,]+/', $email);
        $validEmails = array_filter(array_map('trim', $emails), fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL));

        if (!empty($validEmails)) {
            $emailService->setTo('admin@example.com');
            $emailService->setBCC($validEmails);
            $emailService->setMessage($message);
            $status_kirim = $emailService->send() ? 'berhasil' : 'gagal';
        } else {
            $status_kirim = 'gagal';
        }

        $historyEmailModel = new \App\Models\HistoryEmailModel();
        $historyEmailModel->save([
            'notulensi_id' => $notulensi_id,
            'email' => json_encode($validEmails),  
            'status_kirim' => $status_kirim,
            'timestamp_kirim' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/notulen/melihatnotulen')->with('message', 'Notulensi berhasil disimpan dan email terkirim');
    }
}
