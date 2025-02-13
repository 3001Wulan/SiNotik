<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class TambahPenggunaController extends Controller
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');

        if ($user_id) {
            $PenggunaModel = new PenggunaModel();
            $user = $PenggunaModel->find($user_id);

            return view('admin/tambahpengguna', [
                'user' => $user,  
            ]);
        } else {
            return redirect()->to('/login');
        }
    }
    
    public function simpan()
{
    $validation = \Config\Services::validation();

    if (!$this->validate([
        'username' => 'required|min_length[3]|max_length[50]',
        'nama' => 'required|min_length[3]|max_length[100]',
        'nip' => 'required|min_length[8]|max_length[20]',
        'email' => 'required|valid_email',
        'status' => 'required|max_length[50]',
        'bidang' => 'required|max_length[50]',
        'jabatan' => 'required|max_length[50]',
        'photo' => 'uploaded[photo]|max_size[photo,5120]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
        'password' => 'required|min_length[6]|max_length[20]',
        'confirm-password' => 'required|matches[password]',
    ])) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $file = $this->request->getFile('photo');
    $logger = \Config\Services::logger(); // Inisialisasi logger

    if ($file->isValid() && !$file->hasMoved()) {
        $newName = $file->getRandomName();
        $file->move('assets/images/profiles', $newName);
        $logger->info('Foto berhasil diunggah dengan nama: ' . $newName); // Log sukses upload foto
    } else {
        $logger->error('Gagal mengunggah foto. Kesalahan: ' . $file->getErrorString()); // Log kesalahan upload foto
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengunggah foto.');
    }

    $data = [
        'username' => $this->request->getPost('username'),
        'nama' => $this->request->getPost('nama'),
        'nip' => $this->request->getPost('nip'),
        'email' => $this->request->getPost('email'),
        'role' => $this->request->getPost('status'),
        'bidang' => $this->request->getPost('bidang'),
        'jabatan' => $this->request->getPost('jabatan'),
        'profil_foto' => $newName, 
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ];

    $penggunaModel = new PenggunaModel();
    if ($penggunaModel->save($data)) {
        $logger->info('Data pengguna berhasil disimpan untuk username: ' . $data['username']); 
        return redirect()->to('/admin/data_pengguna')->with('message', 'Pengguna berhasil ditambahkan!');
    } else {
        $logger->error('Gagal menyimpan data pengguna untuk username: ' . $data['username']); 
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
    }
}

}
