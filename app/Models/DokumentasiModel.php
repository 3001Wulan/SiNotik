<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumentasiModel extends Model
{
    protected $table = 'dokumentasi';
    protected $primaryKey = 'dokumentasi_id';
    protected $allowedFields = ['notulensi_id', 'foto_dokumentasi'];

    protected $validationRules = [
        'notulensi_id' => 'required|integer',
        'foto_dokumentasi' => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'notulensi_id' => [
            'required' => 'Notulensi ID wajib diisi.',
            'integer' => 'Notulensi ID harus berupa angka.',
        ],
        'foto_dokumentasi' => [
            'required' => 'Foto dokumentasi wajib diisi.',
            'max_length' => 'Nama file foto dokumentasi tidak boleh lebih dari 255 karakter.',
        ],
    ];
}
