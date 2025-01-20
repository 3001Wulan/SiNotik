<?php

namespace App\Models;

use CodeIgniter\Model;

class NotulensiModel extends Model
{
    protected $table = 'notulensi';
    protected $primaryKey = 'notulensi_id';
    protected $allowedFields = ['judul', 'agenda', 'tanggal_dibuat', 'partisipan', 'isi', 'profil_foto'];

    protected $validationRules = [
        'judul' => 'required|max_length[255]',
        'agenda' => 'required',
        'tanggal' => 'required|valid_date',
        'partisipan' => 'required',
        'pembahasan' => 'required',
        'upload' => 'permit_empty|mime_in[upload,image/jpg,image/jpeg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[upload,5120]',
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul wajib diisi.',
            'max_length' => 'Judul tidak boleh lebih dari 255 karakter.',
        ],
        'agenda' => [
            'required' => 'Agenda wajib diisi.',
        ],
        'tanggal' => [
            'required' => 'Tanggal wajib diisi.',
            'valid_date' => 'Format tanggal tidak valid.',
        ],
        'upload' => [
            'mime_in' => 'File harus berupa JPG, JPEG, PNG, PDF, atau DOC.',
            'max_size' => 'Ukuran file tidak boleh lebih dari 5MB.',
        ],
    ];

    // Fungsi kustom untuk mengambil notulensi berdasarkan user ID
    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
