<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardAdminModel extends Model
{
    protected $table      = 'user';  // Nama tabel yang berisi data pengguna
    protected $primaryKey = 'user_id'; // Kolom primary key

    // Daftar kolom yang ada di tabel users
    protected $allowedFields = ['user_id', 'username', 'nama', 'nip', 'email', 'password', 'role', 'profil_foto', 'alamat', 'created_at', 'updated_at', 'Bidang'];

    // Fungsi untuk menghitung jumlah pengguna dengan role "pegawai"
    public function getTotalPegawai()
    {
        return $this->where('role', 'pegawai')->countAllResults();  // Hanya menghitung pengguna dengan role "pegawai"
    }

    // Fungsi untuk mengambil semua pengguna dengan role "pegawai"
    public function getPegawai()
    {
        return $this->where('role', 'pegawai')->findAll();  // Menampilkan semua pengguna dengan role "pegawai"
    }

    // Fungsi untuk mengambil jumlah pegawai per bidang
    public function getJumlahPegawaiPerBidang()
    {
        return $this->select('Bidang, COUNT(user_id) AS jumlah')  // Mengambil kolom Bidang dan menghitung jumlah user_id
                    ->where('role', 'pegawai')  // Filter berdasarkan role pegawai
                    ->groupBy('Bidang')  // Kelompokkan berdasarkan Bidang
                    ->findAll();  // Ambil hasilnya
    }

    // Fungsi untuk mengambil pengguna berdasarkan user_id
    public function getUserById($user_id)
    {
        return $this->find($user_id);
    }

    // Fungsi untuk menghitung total notulensi
    public function getTotalNotulensi()
    {
        return $this->db->table('notulensi')->countAllResults();  // Menghitung semua notulensi
    }

    // Fungsi untuk mengambil jumlah notulensi per bidang
    public function getJumlahNotulensiPerBidang()
    {
        return $this->db->table('notulensi')
                        ->select('Bidang, COUNT(notulensi_id) AS jumlah')
                        ->groupBy('Bidang')  // Kelompokkan berdasarkan Bidang
                        ->get()
                        ->getResultArray();  // Ambil hasilnya sebagai array
    }
}
