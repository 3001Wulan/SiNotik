<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table = 'notulensi'; 

    public function getNotulensWithIsi()
{
    return $this->db->table('notulensi')
                    ->select('
                        notulensi.*, 
                        riwayatnotulensi.notulensi_id as riwayat_id, 
                        dokumentasi.dokumentasi_id, 
                        dokumentasi.foto_dokumentasi, 
                        user.user_id, 
                        user.nama as user_name
                    ')
                    ->join('riwayatnotulensi', 'riwayatnotulensi.notulensi_id = notulensi.notulensi_id') // Join ke tabel riwayatnotulensi
                    ->join('dokumentasi', 'dokumentasi.notulensi_id = notulensi.notulensi_id') // Join ke tabel dokumentasi
                    ->join('user', 'user.user_id = notulensi.user_id') // Join ke tabel users
                    ->get()
                    ->getResultArray();
}

}
