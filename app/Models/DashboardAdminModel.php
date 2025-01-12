<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardAdminModel extends Model
{
    protected $table      = 'user';  
    protected $primaryKey = 'user_id'; 

    protected $allowedFields = ['user_id', 'username', 'nama', 'nip', 'email', 'password', 'role', 'profil_foto', 'alamat', 'created_at', 'updated_at', 'Bidang'];

    public function getTotalPegawai()
    {
        return $this->where('role', 'pegawai')->countAllResults();  
    }

    public function getPegawai()
    {
        return $this->where('role', 'pegawai')->findAll();  
    }

    public function getJumlahPegawaiPerBidang()
    {
        return $this->select('Bidang, COUNT(user_id) AS jumlah')  
                    ->where('role', 'pegawai')  
                    ->groupBy('Bidang')  
                    ->findAll();  
    }

    public function getUserById($user_id)
    {
        return $this->find($user_id);
    }

    public function getTotalNotulensi()
    {
        return $this->db->table('notulensi')->countAllResults();  
    }

    public function getJumlahNotulensiPerBidang()
    {
        return $this->db->table('notulensi')
                        ->select('Bidang, COUNT(notulensi_id) AS jumlah')
                        ->groupBy('Bidang')  
                        ->get()
                        ->getResultArray();  
    }

    public function getProfilePicture($user_id)
    {
        return $this->select('profil_foto')
                    ->where('user_id', $user_id)
                    ->first(); 
    }

    public function getUserInfo($user_id)
    {
        return $this->select('nama, role')
                    ->where('user_id', $user_id)
                    ->first(); 
    }
}
