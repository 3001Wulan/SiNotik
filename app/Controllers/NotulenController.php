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
            // 'email' => $email, 
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
        $emailService->setFrom('sinotik3@gmail.com', 'Notulensi');
        $emailService->setSubject('Notulensi Rapat: ' . $judul);
        $message = "Notulensi Rapat\n\n";
        $message .= "Judul: $judul\n";
        $message .= "Agenda: $agenda\n";
        $message .= "Pembahasan:\n$pembahasan\n\n";
        $message .= "Untuk pertanyaan lebih lanjut, silakan hubungi kami di admin@example.com\n\n";
        $message .= "Terima kasih,\nNotulensi - Notulensi Diskominfo Solok Selatan ";

        // **Menggunakan BCC agar lebih efisien**
        $emails = preg_split('/[\s,]+/', $email);
        $validEmails = [];
        foreach ($emails as $emailAddress) {
            $emailAddress = trim($emailAddress); // Menghapus spasi di sekitar email
            if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $emailAddress;
            } else {
                log_message('error', 'Email tidak valid: ' . $emailAddress);
            }
        }

        if (!empty($validEmails)) {
            $emailService->setTo('admin@example.com'); // Bisa diubah ke email utama pengirim
            $emailService->setBCC($validEmails);
            $emailService->setMessage($message);

            // **Coba kirim email dan tangkap error**
            try {
                if (!$emailService->send()) {
                    log_message('error', 'Email gagal dikirim. Debugging info: ' . $emailService->printDebugger(['headers']));
                } else {
                    log_message('info', 'Email berhasil dikirim ke: ' . implode(', ', $validEmails));
                }
            } catch (\Exception $e) {
                log_message('error', 'Error pengiriman email: ' . $e->getMessage());
            }
        } else {
            log_message('error', 'Tidak ada email valid untuk dikirim.');
        }

        return redirect()->to('/notulen/melihatnotulen')->with('message', 'Notulensi berhasil disimpan dan email terkirim');
    }
}