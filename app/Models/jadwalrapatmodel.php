<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalRapatModel extends Model
{
    protected $table            = 'jadwal_rapat';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['Topik','agenda', 'tanggal', 'waktu', 'lokasi', 'status', 'user_id'];

}
