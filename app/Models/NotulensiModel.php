<?php

namespace App\Models;

use CodeIgniter\Model;

class NotulensiModel extends Model
{
    protected $table = 'notulensi';
    protected $primaryKey = 'notulensi_id';
    protected $allowedFields = ['notulensi_id', 'user_id', 'judul', 'partisipan', 'agenda', 'isi', 'bidang', 'tanggal_dibuat'];

    protected $validationRules = [
        'judul' => 'required|max_length[255]',
        'agenda' => 'required',
        'tanggal_dibuat' => 'required|valid_date',
        'partisipan' => 'required',
        'isi' => 'required',
        'bidang' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul wajib diisi.',
            'max_length' => 'Judul tidak boleh lebih dari 255 karakter.',
        ],
        'agenda' => [
            'required' => 'Agenda wajib diisi.',
        ],
        'tanggal_dibuat' => [
            'required' => 'Tanggal wajib diisi.',
            'valid_date' => 'Format tanggal tidak valid.',
        ],
        'isi' => [
            'required' => 'Isi wajib diisi.',
        ],
        'bidang' => [
            'max_length' => 'Bidang tidak boleh lebih dari 255 karakter.',
        ],
    ];

    // Fungsi untuk mendapatkan semua data notulensi
    public function getAllNotulensi()
    {
        return $this->findAll();  // Mengambil semua data dari tabel notulensi
    }

    // Fungsi untuk menyimpan data dengan validasi dan logging
    public function insertWithLog(array $data)
    {
        // Periksa apakah user_id valid
        $db = \Config\Database::connect();
        $userExists = $db->table('user')->where('user_id', $data['user_id'])->countAllResults();

        if (!$userExists) {
            log_message('error', 'Gagal memasukkan data: user_id tidak ditemukan.');
            return false;
        }

        // Periksa apakah data valid
        if (!$this->validate($data)) {
            log_message('error', 'Validasi gagal: ' . json_encode($this->validation->getErrors()));
            return false;
        }

        // Log data yang akan disimpan
        log_message('debug', 'Data yang akan disimpan: ' . json_encode($data));

        try {
            // Cek koneksi database
            $dbConnection = \Config\Database::connect();
            log_message('debug', 'Koneksi database berhasil.');

            if ($this->insert($data)) {
                log_message('info', 'Data berhasil dimasukkan ke dalam tabel notulensi. Data: ' . json_encode($data));
                return true;
            } else {
                log_message('error', 'Gagal memasukkan data ke dalam tabel notulensi. Error: ' . json_encode($this->errors()));
                return false;
            }
        } catch (\Exception $e) {
            log_message('critical', 'Exception saat memasukkan data: ' . $e->getMessage());
            return false;
        }
    }
}
