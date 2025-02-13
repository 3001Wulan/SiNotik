<?php

namespace App\Models;

use CodeIgniter\Model;

class NotulensiModel extends Model
{
    protected $table = 'notulensi';
    protected $primaryKey = 'notulensi_id';
    protected $allowedFields = [
        'user_id', 'judul', 'partisipan', 'agenda', 'isi', 'bidang', 'tanggal_dibuat',
        'partisipan_non_pegawai'
    ];

    protected $validationRules = [
        'judul' => 'required|max_length[255]',
        'agenda' => 'required',
        'tanggal_dibuat' => 'required|valid_date',
        'partisipan' => 'required',
        'partisipan_non_pegawai' => 'permit_empty', 
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
        'partisipan' => [
            'required' => 'Partisipan wajib diisi.',
        ],
        'partisipan_non_pegawai' => [
            'permit_empty' => 'Partisipan non-pegawai boleh kosong.',
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid.',
        ],
        'isi' => [
            'required' => 'Isi wajib diisi.',
        ],
        'bidang' => [
            'max_length' => 'Bidang tidak boleh lebih dari 255 karakter.',
        ],
    ];

    public function getAllNotulensi()
    {
        return $this->findAll();
    }

    public function getNotulensiById($notulensi_id)
    {
        return $this->where('notulensi_id', $notulensi_id)->first();
    }

    public function getNotulensiByUserId($userId)
    {
        return $this->where('user_id', $userId)->first(); 
    }

    public function updateNotulensi($notulensi_id, array $data)
    {
        if (!$this->validate($data)) {
            log_message('error', 'Validasi gagal: ' . json_encode($this->validation->getErrors()));
            return false;
        }

        $notulensi = $this->find($notulensi_id);
        if (!$notulensi) {
            log_message('error', 'Notulensi dengan ID ' . $notulensi_id . ' tidak ditemukan.');
            return false;
        }
        return $this->update($notulensi_id, $data);
    }

    public function deleteNotulensi($notulensi_id)
    {
        $notulensi = $this->find($notulensi_id);
        if (!$notulensi) {
            log_message('error', 'Notulensi dengan ID ' . $notulensi_id . ' tidak ditemukan.');
            return false;
        }
        return $this->delete($notulensi_id);
    }

    public function getNotulensiWithDokumentasi($notulensi_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('notulensi');
        $builder->select('notulensi.*, dokumentasi.*');
        $builder->join('dokumentasi', 'dokumentasi.notulensi_id = notulensi.notulensi_id', 'left');
        $builder->where('notulensi.notulensi_id', $notulensi_id);
        return $builder->get()->getRowArray(); 
    }
    public function insertWithLog(array $data)
    {
        log_message('debug', 'Data yang akan disimpan: ' . json_encode($data));

        try {
            $dbConnection = \Config\Database::connect();
            log_message('debug', 'Koneksi database berhasil.');
            
            if ($this->insert($data)) {
                $notulensiId = $this->getInsertID(); 
                log_message('info', 'Data berhasil dimasukkan ke dalam tabel notulensi. Data: ' . json_encode($data));
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
            throw $e;
            return false;
        }
    }
}
