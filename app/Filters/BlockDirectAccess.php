<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class BlockDirectAccess implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah URL mengarah ke assets/images/profiles
        if (strpos($request->getUri()->getPath(), 'assets/images/profiles') === 0) {
            return redirect()->to('/login'); // Arahkan ke halaman login
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah request
    }
}
