<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class TambahPenggunaController extends Controller
{
    public function index()
    {
        // Menampilkan view form tambah pengguna
        return view('admin/tambahpengguna');
    }

    public function simpan()
    {
        // Validasi input
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
            // Jika validasi gagal
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses upload file foto
        $file = $this->request->getFile('photo');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'assets/images/profiles/', $newName);
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengunggah foto.');
        }

        // Ambil data dari form
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('status'),
            'bidang' => $this->request->getPost('bidang'),
            'jabatan' => $this->request->getPost('jabatan'),
            'photo' => $newName, // Nama file yang diunggah
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Simpan data ke database
        $penggunaModel = new PenggunaModel();
        if ($penggunaModel->save($data)) {
            return redirect()->to('/admin/data_pengguna')->with('message', 'Pengguna berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
}
