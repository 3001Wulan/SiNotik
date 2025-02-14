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
    log_message('info', "Memulai pengiriman email dengan subjek: $judul");
    
    $filePath = 'uploads/' . $fileName;
    if (!file_exists($filePath)) {
        log_message('error', "File gambar tidak ditemukan: $filePath");
    } else {
        log_message('info', "File gambar ditemukan: $filePath");
        
        // Pastikan gambar berhasil dibaca dan di-encode
        $imageData = base64_encode(file_get_contents($filePath));
        if (empty($imageData)) {
            log_message('error', "Gambar gagal dikodekan ke Base64");
        } else {
            log_message('info', "Gambar berhasil dikodekan ke Base64");
            // Tentukan tipe MIME sesuai dengan gambar yang digunakan (PNG/JPEG)
            $imageSrc = 'data:image/' . pathinfo($fileName, PATHINFO_EXTENSION) . ';base64,' . $imageData;
            log_message('info', "Dokumentasi gambar berhasil disisipkan ke email dengan Base64.");
        }
    }
    
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
        <p><strong>Agenda:</strong><br> $agenda </p>
    
        <p><strong>Pembahasan:</strong><br> $pembahasan </p>
    
        <p><strong>Partisipan Pegawai:</strong><br> " . nl2br(implode("\n", (array) $partisipan)) . "</p>
        <p><strong>Partisipan Non-Pegawai:</strong><br> " . nl2br(implode("\n", (array) $partisipan_non_pegawai)) . "</p>
    
        " . ($fileName ? "<p><strong>Dokumentasi:</strong><br> <img src='" . $imageSrc . "' alt='Dokumentasi Rapat' style='max-width: 100%; height: auto;'></p>" : "") . "
    
        <p>📧 Untuk pertanyaan lebih lanjut, silakan hubungi kami di <strong>admin@example.com</strong></p>
    
        <p>Salam,<br>  <strong>Diskominfo Solok Selatan</strong></p>
    </body>
    </html>";

$emailService->setMessage($message);
$emailService->setMailType('html'); 
$emailService->send();

    $emails = preg_split('/[\s,]+/', $email);
    $validEmails = [];
    foreach ($emails as $emailAddress) {
        $emailAddress = trim($emailAddress);
        if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            $validEmails[] = $emailAddress;
        } else {
            log_message('error', 'Email tidak valid: ' . $emailAddress);
        }
    }

    $emailsJson = json_encode($validEmails);  
    if (!empty($validEmails)) {
        $emailService->setTo('admin@example.com');
        $emailService->setBCC($validEmails);
        $emailService->setMessage($message);

        try {
            if (!$emailService->send()) {
                log_message('error', 'Email gagal dikirim. Debugging info: ' . $emailService->printDebugger(['headers']));
                $status_kirim = 'gagal';
            } else {
                log_message('info', 'Email berhasil dikirim ke: ' . implode(', ', $validEmails));
                $status_kirim = 'berhasil';
            }

            $historyEmailModel = new \App\Models\HistoryEmailModel();
            $historyEmailModel->save([
                'notulensi_id' => $notulensi_id,
                'email' => $emailsJson,  
                'status_kirim' => $status_kirim,
                'timestamp_kirim' => date('Y-m-d H:i:s'),
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error pengiriman email: ' . $e->getMessage());
            $status_kirim = 'gagal';
        }
    } else {
        log_message('error', 'Tidak ada email valid untuk dikirim.');
        $status_kirim = 'gagal';
    }

    return redirect()->to('/notulen/melihatnotulen')->with('message', 'Notulensi berhasil disimpan dan email terkirim');
}
}