<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class NotulenController extends Controller
{
    public function create()
    {
        // Ambil user_id dari session
        $user_id = session()->get('user_id');

        // Query untuk mengambil nama, role, dan profil foto berdasarkan user_id
        $db = \Config\Database::connect();
        $builder = $db->table('user');
        $userData = $builder->select('nama, role, profil_foto')
                            ->where('user_id', $user_id)
                            ->get()
                            ->getRowArray();

        // Pastikan data user ada
        if ($userData) {
            // Menyusun data user yang akan dikirim ke view
            $data['nama'] = $userData['nama'];
            $data['role'] = $userData['role'];
            $data['profil_foto'] = $userData['profil_foto'];
        } else {
            // Jika data tidak ada, beri nilai default
            $data['nama'] = 'Nama Tidak Ditemukan';
            $data['role'] = 'Role Tidak Ditemukan';
            $data['profil_foto'] = 'default.jpg'; // Foto default jika tidak ada
        }

        // Menampilkan view dengan data user
        return view('notulen/buatnotulen', $data);
    }

    public function simpan()
{
    // Ambil data dari form
    $judul = $this->request->getPost('judul');
    $agenda = $this->request->getPost('agenda');
    $tanggal = $this->request->getPost('tanggal');
    $partisipan = $this->request->getPost('partisipan');
    $pembahasan = $this->request->getPost('pembahasan');
    $isi = $this->request->getPost('isi');
    $tanggal_dibuat = date('Y-m-d'); // Tanggal saat ini

    // Ambil user_id dari session
    $user_id = session()->get('user_id');

    // Query untuk mengambil bidang berdasarkan user_id
    $db = \Config\Database::connect();
    $builder = $db->table('user');
    $bidang = $builder->select('bidang')
                      ->where('user_id', $user_id)
                      ->get()
                      ->getRowArray();

    // Pastikan bidang tidak kosong
    if ($bidang) {
        $bidang = $bidang['bidang'];
    } else {
        $bidang = 'default_bidang';
    }

    // Handle upload file
    $fileName = null;
    if ($file = $this->request->getFile('upload')) {
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('./uploads', $fileName);
        } else {
            return redirect()->back()->with('error', $file->getErrorString());
        }
    }

    // Menyusun data untuk notulensi
    $notulensiData = [
        'judul' => $judul,
        'agenda' => $agenda,
        'tanggal_dibuat' => $tanggal_dibuat, 
        'tanggal' => $tanggal,
        'partisipan' => $partisipan,
        'upload' => $fileName,
        'user_id' => $user_id, 
        'isi' => $pembahasan, 
        'bidang' => $bidang, 
    ];

    // Simpan data notulensi
    $notulensiModel = new \App\Models\NotulensiModel();
    $notulensiModel->insertWithLog($notulensiData);

    // Ambil notulensi_id yang baru saja disimpan
    $notulensi_id = $notulensiModel->getInsertID();

    // Simpan file yang diupload ke tabel dokumentasi
    if ($fileName) {
        $dokumentasiData = [
            'notulensi_id' => $notulensi_id, // Menghubungkan dengan notulensi_id
            'foto_dokumentasi' => $fileName, // Nama file foto dokumentasi
        ];

        // Simpan ke tabel dokumentasi
        $dokumentasiModel = new \App\Models\DokumentasiModel();
        $dokumentasiModel->save($dokumentasiData);
    }

    return redirect()->to('/notulen/melihatnotulen')->with('message', 'Notulensi dan dokumentasi berhasil disimpan');
}
}