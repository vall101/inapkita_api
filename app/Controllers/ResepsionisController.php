<?php

namespace App\Controllers;

use App\Models\ResepsionisModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class ResepsionisController extends ResourceController
{
    protected $modelName = ResepsionisModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data)
                     : $this->failNotFound('Data tidak ditemukan');
    }

    /** ========== CREATE: Tambah resepsionis (khusus pemilik) ========== */
    public function create()
    {
        // --- Validasi role lewat header X-ROLE ---
        if ($this->request->getHeaderLine('X-ROLE') !== 'pemilik') {
            return $this->failForbidden('Hanya pemilik yang boleh menambah resepsionis');
        }

        // --- Ambil data dari JSON atau x-www-form-urlencoded ---
        $contentType = $this->request->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            try {
                $p = $this->request->getJSON(true);
            } catch (\Exception $e) {
                return $this->failValidationErrors(['json' => 'Format JSON tidak valid']);
            }
        } else {
            $p = $this->request->getPost();
        }

        // --- Cek apakah payload kosong ---
        if (empty($p)) {
            return $this->failValidationErrors(['json' => 'Payload tidak valid']);
        }

        // --- Validasi minimal password ada ---
        if (empty($p['password'])) {
            return $this->failValidationErrors(['password' => 'Password wajib diisi']);
        }

        // --- Buat akun user (role = pegawai) ---
        $uModel = new UserModel();
        $userRow = [
            'nama'     => $p['nama']     ?? '',
            'email'    => $p['email']    ?? '',
            'no_hp'    => $p['no_hp']    ?? '',
            'password' => password_hash($p['password'], PASSWORD_DEFAULT),
            'role'     => 'pegawai',
        ];

        if (!$uModel->insert($userRow)) {
            return $this->failValidationErrors($uModel->errors());
        }

        $newUserId = $uModel->getInsertID();

        // --- Simpan ke tabel resepsionis ---
        $rModel = new ResepsionisModel();
        $resRow = [
            'nama'        => $p['nama'],
            'email'       => $p['email'],
            'no_hp'       => $p['no_hp'],
            'shift'       => strtolower($p['shift']),
            'password'    => $p['password'], // Akan di-hash lagi di callback model jika perlu
            'property_id' => $p['property_id'],
            'user_id'     => $newUserId,
        ];

        if (!$rModel->insert($resRow)) {
            // rollback jika gagal insert ke resepsionis
            $uModel->delete($newUserId, true);
            return $this->failValidationErrors($rModel->errors());
        }

        return $this->respondCreated(['message' => 'Resepsionis berhasil ditambahkan']);
    }


   /** ========== UPDATE ========== */
public function update($id = null)
{
    $contentType = $this->request->getHeaderLine('Content-Type');

    if (strpos($contentType, 'application/json') !== false) {
        $p = $this->request->getJSON(true);
    } else {
        $p = $this->request->getRawInput(); // fallback untuk form-urlencoded PUT
    }

    if (empty($p)) {
        return $this->failValidationErrors(['message' => 'Tidak ada data untuk diupdate']);
    }

    if (!$this->model->update($id, $p)) {
        return $this->failValidationErrors($this->model->errors());
    }

    return $this->respond($p);
}


/** ========== DELETE ========== */
public function delete($id = null)
{
    if (!$this->model->find($id)) {
        return $this->failNotFound('Data tidak ditemukan');
    }

    $this->model->delete($id);
    return $this->respondDeleted(['message' => 'Data berhasil dihapus']);
}
}