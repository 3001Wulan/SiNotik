<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'nip', 'email', 'password', 'role', 'profil_foto', 'alamat', 'jabatan', 'tanggallahir', 'bidang']; // Tambahkan 'bidang'
    protected $useTimestamps = true;

    public function getUserById($user_id)
    {
        log_message('info', 'Mencoba mengambil profil pengguna dengan ID ' . $user_id);

        $user = $this->find($user_id);

        if (!$user) {
            log_message('error', 'Pengguna dengan ID ' . $user_id . ' tidak ditemukan di database.');
        } else {
            log_message('info', 'Pengguna dengan ID ' . $user_id . ' ditemukan di database: ' . print_r($user, true));
        }

        return $user;
    }

    public function updateUser($user_id, $data)
    {
        $user = $this->find($user_id);

        if (!$user) {
            log_message('error', 'Pengguna dengan ID ' . $user_id . ' tidak ditemukan.');
            return false;
        }

        log_message('info', 'Data pengguna yang ada: ' . print_r($user, true));

        $changes = [];
        foreach ($data as $key => $value) {
            // Pastikan nilai baru tidak kosong dan berbeda dengan nilai yang ada
            if (isset($user[$key]) && $user[$key] !== $value && !empty($value)) {
                $changes[$key] = $value;
            }
        }

        if (empty($changes)) {
            log_message('info', 'Tidak ada perubahan valid untuk pengguna ID ' . $user_id . '. Pembaruan tidak diperlukan.');
            return false;
        }

        log_message('info', 'Data yang akan diperbarui: ' . print_r($changes, true));

        // Tambahkan validasi sebelum update
        $this->allowedFields = array_keys($user);

        try {
            $result = $this->update($user_id, $changes);

            if ($result) {
                log_message('info', 'Berhasil memperbarui profil pengguna dengan ID ' . $user_id . '. Perubahan: ' . print_r($changes, true));
            } else {
                log_message('error', 'Gagal memperbarui profil pengguna dengan ID ' . $user_id . '.');
            }

            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Terjadi kesalahan saat memperbarui profil pengguna dengan ID ' . $user_id . ': ' . $e->getMessage());
            return false;
        }
    }
}
