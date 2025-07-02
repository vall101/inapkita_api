<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ResepsionisModel;

class AuthController extends ResourceController
{
     protected $format = 'json';

    /* ------------------------------------------------------------------
       REGISTER – hanya CUSTOMER
    ------------------------------------------------------------------*/
    public function register()
    {
        // Terima JSON atau x-www
        $data = $this->request->getPost() ?: $this->request->getJSON(true);

        // Default role = customer
        $data['role'] = 'customer';
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $userModel = new UserModel();
        if (! $userModel->insert($data)) {
            return $this->failValidationErrors($userModel->errors());
        }

        return $this->respondCreated(['message' => 'Registrasi berhasil']);
    }

    /* ==================== LOGIN ENDPOINTS ==================== */

    /** Login khusus customer  */
    public function loginCustomer()
    {
        return $this->doLogin('customer'); // harapannya role = customer
    }

    /** Login staff (pegawai & pemilik) */
    public function loginStaff()
    {
        return $this->doLogin(['pegawai','pemilik']); // hanya 2 role ini
    }

    /* ==================== SHARED HELPER ==================== */
    private function doLogin($roleAllowed)
    {
        // Ambil input
        $cred  = $this->request->getPost() ?: $this->request->getJSON(true);
        $email = $cred['email']    ?? '';
        $pass  = $cred['password'] ?? '';

        $user = model(UserModel::class)
                ->where('email', $email)
                ->first();

        if (! $user || ! password_verify($pass, $user['password'])) {
            return $this->failUnauthorized('Email / password salah');
        }

        /* ------ Role check ------ */
        // $roleAllowed bisa berupa string tunggal ATAU array
        $allowed = is_array($roleAllowed)
                   ? in_array($user['role'], $roleAllowed, true)
                   : $user['role'] === $roleAllowed;

        if (! $allowed) {
            return $this->failForbidden(
                'Akun '.$user['role'].' tidak boleh login di endpoint ini'
            );
        }

        /* ------ Berhasil ------ */
        $token = base64_encode(random_bytes(40));   // ganti JWT jika perlu

        return $this->respond([
            'token' => $token,
            'role'  => $user['role'],
            'data'  => $user,
        ]);
    }
}