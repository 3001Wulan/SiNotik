<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table = 'notulensi'; 

    public function getNotulensWithIsi()
    {
        return $this->db->table('notulensi')
                        ->select('notulensi.*, riwayatnotulensi.notulensi_id')
                        ->join('riwayatnotulensi', 'riwayatnotulensi.notulensi_id = notulensi.notulensi_id') // Pastikan menggunakan kolom yang sesuai
                        ->get() 
                        ->getResultArray(); 
    }
}
