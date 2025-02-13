<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table = 'riwayatnotulensi';  
    protected $primaryKey = 'notulensi_id'; 

    protected $allowedFields = [
        'notulensi_id'
    ];

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
                        ->join('riwayatnotulensi', 'riwayatnotulensi.notulensi_id = notulensi.notulensi_id')
                        ->join('dokumentasi', 'dokumentasi.notulensi_id = notulensi.notulensi_id')
                        ->join('user', 'user.user_id = notulensi.user_id')
                        ->get()
                        ->getResultArray();  
    }

    public function deleteNotulensiById($id)
    {
        $this->db->transStart();
        $this->db->table('dokumentasi')->delete(['notulensi_id' => $id]);
        $this->db->table('riwayatnotulensi')->delete(['notulensi_id' => $id]);
        $this->db->table('notulensi')->delete(['notulensi_id' => $id]);
        $this->db->transComplete();
        if ($this->db->transStatus() === FALSE) {
            return false;
        }
        return true;
    }
}
