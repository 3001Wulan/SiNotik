<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'feedback'; 
    protected $primaryKey = 'feedback_id'; 
    protected $allowedFields = ['notulensi_id', 'isi', 'tanggal_feedback', 'user_id'];
    protected $useTimestamps = false; // Aktifkan timestamp jika ada kolom created_at dan updated_at

    /**
     * Ambil feedback berdasarkan notulensi_id dengan informasi pengguna.
     */
    public function getFeedbackByNotulensiId($notulensi_id)
{
    $feedbacks = $this->where('feedback.notulensi_id', $notulensi_id)
                  ->join('user', 'user.user_id = feedback.user_id', 'left')
                  ->select('feedback.*, user.nama as user_nama, user.profil_foto')
                  ->orderBy('feedback.tanggal_feedback', 'DESC')
                  ->findAll();


    // Tambahkan log untuk memeriksa hasil query
    log_message('info', 'Feedback data for notulensi_id ' . $notulensi_id . ': ' . print_r($feedbacks, true));

    return $feedbacks;
}

}
