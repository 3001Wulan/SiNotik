<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table = 'notulensi';  // Nama tabel yang digunakan
    protected $primaryKey = 'notulensi_id'; // Primary key dari tabel notulensi

    // Fungsi untuk mengambil data notulensi dengan informasi terkait
    public function getNotulensWithIsi()
    {
        // Menjalankan query dengan join ke tabel terkait
        return $this->db->table('notulensi')
                        ->select('
                            notulensi.*, 
                            riwayatnotulensi.notulensi_id as riwayat_id, 
                            dokumentasi.dokumentasi_id, 
                            dokumentasi.foto_dokumentasi, 
                            user.user_id, 
                            user.nama as user_name
                        ')
                        ->join('riwayatnotulensi', 'riwayatnotulensi.notulensi_id = notulensi.notulensi_id')
                        ->join('dokumentasi', 'dokumentasi.notulensi_id = notulensi.notulensi_id')
                        ->join('user', 'user.user_id = notulensi.user_id')
                        ->get()
                        ->getResultArray();  // Mengembalikan hasil query dalam bentuk array
    }

    // Fungsi untuk menghapus data berdasarkan ID
    public function deleteNotulensiById($id)
    {
        // Memulai transaksi untuk penghapusan data
        $this->db->transStart();

        // Menghapus data terkait di tabel 'dokumentasi'
        $this->db->table('dokumentasi')->delete(['notulensi_id' => $id]);

        // Menghapus data dari tabel 'riwayatnotulensi'
        $this->db->table('riwayatnotulensi')->delete(['notulensi_id' => $id]);

        // Menghapus data dari tabel 'notulensi'
        $this->db->table('notulensi')->delete(['notulensi_id' => $id]);

        // Menyelesaikan transaksi
        $this->db->transComplete();

        // Mengecek apakah transaksi berhasil
        if ($this->db->transStatus() === FALSE) {
            // Jika transaksi gagal, mengembalikan false
            return false;
        }

        // Jika penghapusan berhasil, mengembalikan true
        return true;
    }
}
