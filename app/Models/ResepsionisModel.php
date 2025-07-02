<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepsionisModel extends Model
{
 /* ---------- Konfigurasi dasar ---------- */
    protected $table      = 'resepsionis';
    protected $primaryKey = 'resepsionis_id';
    protected $returnType = \App\Entities\Resepsionis::class;

    /* kolom yang boleh di–isi */
    protected $allowedFields = [
        'nama', 'email', 'no_hp', 'shift',
        'password',               // di-hash otomatis lewat callback
        'reservasi_id', 'property_id', 'user_id',
    ];

    protected $useTimestamps = true;        // created_at & updated_at

    /* ---------- VALIDASI ---------- */
    protected $validationRules = [
        'nama'        => 'required|min_length[3]',
        'email'       => 'required|valid_email|is_unique[resepsionis.email]',
        'no_hp'       => 'required|numeric',
        'shift'       => 'required|in_list[siang,malam]',   // huruf kecil
        'password'    => 'required|min_length[6]',
        'property_id' => 'required|is_natural_no_zero',
        'user_id'     => 'required|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'email' => ['is_unique' => 'Email sudah terdaftar.'],
        'shift' => ['in_list'   => 'Shift harus “siang” atau “malam”.'],
    ];

    /* ---------- CALLBACK: hash password & normalisasi shift ---------- */
    protected $beforeInsert = ['prep'];
    protected $beforeUpdate = ['prep'];

    protected function prep(array $data)
    {
        // hash password jika ada
        if (isset($data['data']['password'])) {
            $data['data']['password'] =
                password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        // shift → huruf kecil agar konsisten
        if (isset($data['data']['shift'])) {
            $data['data']['shift'] = strtolower($data['data']['shift']);
        }
        return $data;
    }
}