<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $args = null)
    {
        /* ========== 1. Ambil token Bearer ========== */
        $auth = $request->getHeaderLine('Authorization');
        if (! str_starts_with($auth, 'Bearer ')) {
            return Services::response()
                   ->setJSON(['message'=>'Token missing'])
                   ->setStatusCode(401);
        }
        $jwt = trim(substr($auth, 7));

        /* ========== 2. Decode ========== */
        try {
            $secret = env('jwt.secret');
            $user = JWT::decode($jwt, new Key($secret,'HS256'));
            // atau: Services::auth()->parse($jwt);
        } catch (\Throwable $e) {
            return Services::response()
                   ->setJSON(['message'=>'Token invalid'])
                   ->setStatusCode(401);
        }

        /* ========== 3. Cek role ========== */
        $allowed = $args ?? [];              // contoh di routes: role:pemilik
        if ($allowed && ! in_array($user->role, $allowed, true)) {
            return Services::response()
                   ->setJSON(['message'=>'Forbidden'])
                   ->setStatusCode(403);
        }

        // kalau lolos → lanjut ke controller
    }

    public function after(RequestInterface $r, ResponseInterface $resp, $args=null) {}
}