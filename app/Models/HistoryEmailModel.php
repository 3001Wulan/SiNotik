<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryEmailModel extends Model
{
    protected $table = 'history_email';
    protected $primaryKey = 'id';
    protected $allowedFields = ['notulensi_id', 'email', 'status_kirim', 'timestamp_kirim'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'notulensi_id' => 'required|integer',
        'email' => 'required',
        'status_kirim' => 'required|in_list[berhasil,gagal]',
        'timestamp_kirim' => 'required|valid_date[Y-m-d H:i:s]',
    ];
    
    // Custom validation messages
    protected $validationMessages = [
        'notulensi_id' => [
            'required' => 'ID Notulensi harus diisi.',
            'integer' => 'ID Notulensi harus berupa angka.'
        ],
        'email' => [
            'required' => 'Email harus diisi.',
        ],
        'status_kirim' => [
            'required' => 'Status kirim harus diisi.',
            'in_list' => 'Status kirim hanya bisa bernilai "berhasil" atau "gagal".'
        ],
        'timestamp_kirim' => [
            'required' => 'Timestamp kirim harus diisi.',
            'valid_date' => 'Format waktu tidak valid.'
        ]
    ];

    // Method to get all data from the table
    public function getAllHistoryEmails()
    {
        return $this->select('history_email.*, notulensi.judul, notulensi.partisipan, notulensi.agenda, notulensi.isi, notulensi.Bidang, notulensi.tanggal_dibuat, notulensi.email AS notulensi_email, notulensi.partisipan_non_pegawai')
        ->join('notulensi', 'notulensi.notulensi_id = history_email.notulensi_id', 'left') // Left join untuk mengambil semua data history_email, meskipun tidak ada data yang cocok di tabel notulensi
        ->orderBy('history_email.id', 'ASC') // Mengurutkan berdasarkan id history_email
        ->findAll();
    }
}
