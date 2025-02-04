<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NotulensiModel;
use App\Models\DokumentasiModel;

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
        $data = [
            'nama' => $userData['nama'] ?? 'Nama Tidak Ditemukan',
            'role' => $userData['role'] ?? 'Role Tidak Ditemukan',
            'profil_foto' => $userData['profil_foto'] ?? 'default.jpg',
            'current_page' => 'buat_notulen', // Menandai halaman aktif di sidebar
        ];

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
        $bidang = $bidang['bidang'] ?? 'default_bidang';

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

        // Simpan data notulensi
        $notulensiModel = new NotulensiModel();
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
        $notulensiModel->insertWithLog($notulensiData);

        // Ambil notulensi_id yang baru saja disimpan
        $notulensi_id = $notulensiModel->getInsertID();

        // Simpan file dokumentasi
        if ($fileName) {
            $dokumentasiModel = new DokumentasiModel();
            $dokumentasiData = [
                'notulensi_id' => $notulensi_id,
                'foto_dokumentasi' => $fileName,
            ];
            $dokumentasiModel->save($dokumentasiData);
        }

        return redirect()->to('/notulen/melihatnotulen')->with('message', 'Notulensi berhasil disimpan');
    }

    public function melihatnotulen()
{
    // Ambil semua notulensi dari database
    $notulensiModel = new NotulensiModel();
    $notulensi = $notulensiModel->findAll();

    // Pastikan $current_page dikirim ke view
    $data = [
        'notulensi' => $notulensi,
        'current_page' => 'notulensi', // Tambahkan variabel ini untuk sidebar
    ];

    return view('notulen/melihatnotulen', $data);
}

}
