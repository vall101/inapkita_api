<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasiModel extends Model
{
    protected $table            = 'reservasi';
    protected $primaryKey       = 'reservasi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status',
        'check_in',
        'check_out',
        'total_harga',
        'user_id',
        'property_id'
            ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
    // 'check_in' => 'datetime',
    // 'check_out' => 'datetime',
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false; // Tidak menggunakan timestamp otomatis
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'status'       => 'in_list[booked,checkin,checkout]',
        'check_in'     => 'permit_empty|valid_date[Y-m-d]',
        'check_out'    => 'permit_empty|valid_date[Y-m-d]',
        'total_harga'  => 'required|is_natural',
        'user_id'      => 'required|integer',
        'property_id'  => 'required|integer',
    ];
    protected $validationMessages   = [
       'status' => [
            'in_list' => 'Status harus antara: booked, checkin, checkout',
        ],
        'check_in' => [
            'valid_date' => 'Format tanggal check-in tidak valid (Y-m-d)',
        ],
        'check_out' => [
            'valid_date' => 'Format tanggal check-out tidak valid (Y-m-d)',
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
