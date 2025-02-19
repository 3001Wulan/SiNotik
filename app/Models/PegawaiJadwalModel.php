<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiJadwalModel extends Model
{
    protected $table      = 'jadwal_rapat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['topik','agenda', 'tanggal', 'waktu', 'lokasi', 'keterangan', 'user_id', 'status', 'alasan']; // Tambahkan 'alasan'

    public function getJadwalByBidang($user_id)
{
    // Ambil bidang dari user yang sedang login
    $builder = $this->db->table('user');
    $builder->select('Bidang');
    $builder->where('user_id', $user_id);
    $user = $builder->get()->getRowArray();

    if (!$user) {
        return []; // Jika user tidak ditemukan, kembalikan array kosong
    }

    $bidang = $user['Bidang'];

    // Ambil jadwal rapat berdasarkan bidang yang sama
    $builder = $this->db->table($this->table);
    $builder->select('jadwal_rapat.*, user.Bidang');
    $builder->join('user', 'user.user_id = jadwal_rapat.user_id', 'left');
    $builder->where('user.Bidang', $bidang);
    $query = $builder->get();

    return $query->getResultArray();
}
public function getAllJadwal()
    {
        $builder = $this->db->table($this->table);
        $builder->select('jadwal_rapat.*, user.Bidang');  
        $builder->join('user', 'user.user_id = jadwal_rapat.user_id', 'left'); 
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function getPendingJadwal()
    {
        return $this->select('jadwal_rapat.*, user.Bidang')
                    ->join('user', 'user.user_id = jadwal_rapat.user_id', 'left')
                    ->where('jadwal_rapat.status', 'Belum Disetujui')  
                    ->findAll();
    }

    public function updateMeetingStatus($meetingId, $status, $alasan = null)
    {
        $data = ['status' => $status];
        if ($alasan !== null) {
            $data['alasan'] = $alasan; 
        }
        
        return $this->update($meetingId, $data); 
    }
}