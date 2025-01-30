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

    // Fungsi untuk mendapatkan data notulensi berdasarkan notulensi_id
    public function getNotulensiById($notulensi_id)
    {
        return $this->where('notulensi_id', $notulensi_id)->first();  // Mengambil data berdasarkan notulensi_id
    }
    
    public function getNotulensiByUserId($userId)
    {
        return $this->where('user_id', $userId)->first(); // Get the first matching row
    }

    // Fungsi untuk memperbarui data notulensi berdasarkan notulensi_id
    public function updateNotulensi($notulensi_id, array $data)
    {
        if (!$this->validate($data)) {
            log_message('error', 'Validasi gagal: ' . json_encode($this->validation->getErrors()));
            return false;
        }

        // Cek apakah notulensi_id ada
        $notulensi = $this->find($notulensi_id);
        if (!$notulensi) {
            log_message('error', 'Notulensi dengan ID ' . $notulensi_id . ' tidak ditemukan.');
            return false;
        }

        // Melakukan update
        return $this->update($notulensi_id, $data);
    }

    // Fungsi untuk menghapus data notulensi berdasarkan notulensi_id
    public function deleteNotulensi($notulensi_id)
    {
        // Cek apakah notulensi_id ada
        $notulensi = $this->find($notulensi_id);
        if (!$notulensi) {
            log_message('error', 'Notulensi dengan ID ' . $notulensi_id . ' tidak ditemukan.');
            return false;
        }

        // Menghapus data
        return $this->delete($notulensi_id);
    }

    // Fungsi untuk mengambil notulensi dengan dokumentasi terkait (relasi antar tabel)
    public function getNotulensiWithDokumentasi($notulensi_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('notulensi');
        
        // Bergabung dengan tabel dokumentasi
        $builder->select('notulensi.*, dokumentasi.*');
        $builder->join('dokumentasi', 'dokumentasi.notulensi_id = notulensi.notulensi_id', 'left');
        $builder->where('notulensi.notulensi_id', $notulensi_id);

        // Menjalankan query dan mengembalikan hasilnya
        return $builder->get()->getRowArray(); // Mengambil data satu baris sebagai array
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

            // Insert data ke tabel notulensi
            if ($this->insert($data)) {
                $notulensiId = $this->getInsertID(); // Mendapatkan ID terakhir yang dimasukkan
                log_message('info', 'Data berhasil dimasukkan ke dalam tabel notulensi. Data: ' . json_encode($data));

                // Masukkan notulensi_id ke tabel riwayatnotulensi
                $riwayatNotulensiData = [
                    'notulensi_id' => $notulensiId
                ];

                $riwayatNotulensiTable = $db->table('riwayatnotulensi');

                if ($riwayatNotulensiTable->insert($riwayatNotulensiData)) {
                    log_message('info', 'Data berhasil dimasukkan ke tabel riwayatnotulensi. Data: ' . json_encode($riwayatNotulensiData));
                    return true;
                } else {
                    log_message('error', 'Gagal memasukkan data ke tabel riwayatnotulensi.');
                    return false;
                }
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
