<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payment';
    protected $primaryKey       = 'payment_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Payment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'metode_bayar',
        'jumlah_bayar',
        'tgl_bayar',
        'status_bayar',
        'reservasi_id',
        'user_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'metode_bayar'   => 'required|integer',
        'jumlah_bayar'   => 'required|integer',
        'tgl_bayar'      => 'required|integer',
        'status_bayar'   => 'required|integer',
        'reservasi_id'   => 'required|integer|is_not_unique[reservasi.reservasi_id]',
        'user_id'        => 'required|integer|is_not_unique[user.user_id]',
    ];
    protected $validationMessages   = [
         'metode_bayar' => [
            'required' => 'Metode pembayaran wajib diisi.',
            'integer'  => 'Metode pembayaran harus berupa angka.'
        ],
        'jumlah_bayar' => [
            'required' => 'Jumlah pembayaran wajib diisi.',
            'integer'  => 'Jumlah pembayaran harus berupa angka.'
        ],
        'tgl_bayar' => [
            'required' => 'Tanggal pembayaran wajib diisi.',
            'integer'  => 'Tanggal pembayaran harus berupa angka (format Ymd).'
        ],
        'status_bayar' => [
            'required' => 'Status pembayaran wajib diisi.',
            'integer'  => 'Status pembayaran harus berupa angka.'
        ],
        'reservasi_id' => [
            'required'        => 'ID reservasi wajib diisi.',
            'integer'         => 'ID reservasi harus berupa angka.',
            'is_not_unique'   => 'Reservasi tidak ditemukan di database.'
        ],
        'user_id' => [
            'required'        => 'ID user wajib diisi.',
            'integer'         => 'ID user harus berupa angka.',
            'is_not_unique'   => 'User tidak ditemukan di database.'
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
