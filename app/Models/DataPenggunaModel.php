<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPenggunaModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'nama', 'nip', 'email', 'password', 'role', 'profil_foto', 'alamat', 'jabatan', 'tanggallahir'];
    protected $useTimestamps = true;

    public function getUsersByRole($role)
    {

        $users = $this->where('role', $role)->findAll();

        if (!$users) {
            log_message('error', 'Tidak ada pengguna ditemukan dengan role ' . $role);
        } else {
            log_message('info', 'Pengguna dengan role ' . $role . ' ditemukan: ' . print_r($users, true));
        }

        return $users;
    }

    public function getUsersByRoles($role1, $role2)
    {
        $users = $this->where('role', $role1)
                      ->orWhere('role', $role2)
                      ->findAll();

        if (!$users) {
            log_message('error', 'Tidak ada pengguna ditemukan dengan role ' . $role1 . ' atau ' . $role2);
        } else {
            log_message('info', 'Pengguna dengan role ' . $role1 . ' atau ' . $role2 . ' ditemukan: ' . print_r($users, true));
        }

        return $users;
    }

    public function getUserById($user_id)
    {

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
            if (isset($user[$key]) && $user[$key] !== $value && !empty($value)) {
                $changes[$key] = $value;
            }
        }

        if (empty($changes)) {
            log_message('info', 'Tidak ada perubahan valid untuk pengguna ID ' . $user_id . '. Pembaruan tidak diperlukan.');
            return false;
        }

        log_message('info', 'Data yang akan diperbarui: ' . print_r($changes, true));

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

    public function addUser($data)
    {
        try {
            $this->insert($data);
            log_message('info', 'Berhasil menambahkan pengguna baru: ' . print_r($data, true));
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Gagal menambahkan pengguna baru: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteUser($user_id)
    {
        $user = $this->find($user_id);

        if (!$user) {
            log_message('error', 'Pengguna dengan ID ' . $user_id . ' tidak ditemukan.');
            return false;
        }

        try {
            $this->delete($user_id);
            log_message('info', 'Pengguna dengan ID ' . $user_id . ' berhasil dihapus.');
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Gagal menghapus pengguna dengan ID ' . $user_id . ': ' . $e->getMessage());
            return false;
        }
    }
}
