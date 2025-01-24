<?php

namespace App\Controllers;

class FeedbackNotulenController extends BaseController
{
    public function feedbacknotulen($id)
    {
        // Lakukan logika berdasarkan $id
        $data = [
            'id' => $id,
            // Tambahkan data lain sesuai kebutuhan
        ];

        // Tampilkan view
        return view('notulen/feedbacknotulen', $data);
    }
}
