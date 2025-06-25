<?php

namespace App\Models;

use CodeIgniter\Model;

class PromosiModel extends Model
{
    protected $table            = 'promosi';
    protected $primaryKey       = 'promosi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Promosi::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'diskon',
        'harga_sebelum_diskon',
        'harga_sesudah_diskon',
        'ketentuan',
        'property_id',
        'user_id'
        ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'diskon'                => 'required|integer',
        'harga_sebelum_diskon' => 'required|integer',
        'harga_sesudah_diskon' => 'required|integer',
        'ketentuan'             => 'required|string',
        'property_id'           => 'required|integer|is_not_unique[property.property_id]',
        'user_id'               => 'required|integer|is_not_unique[user.user_id]',
    ];
    protected $validationMessages   = [
          'diskon' => [
        'required' => 'Diskon wajib diisi.',
        'integer'  => 'Diskon harus berupa angka.'
    ],
    'harga_sebelum_diskon' => [
        'required' => 'Harga sebelum diskon wajib diisi.',
        'integer'  => 'Harga sebelum diskon harus berupa angka.'
    ],
    'harga_sesudah_diskon' => [
        'required' => 'Harga sesudah diskon wajib diisi.',
        'integer'  => 'Harga sesudah diskon harus berupa angka.'
    ],
    'ketentuan' => [
        'required' => 'Ketentuan promosi wajib diisi.',
    ],
    'property_id' => [
        'required'        => 'Property wajib diisi.',
        'is_not_unique'   => 'Property tidak ditemukan di database.'
    ],
    'user_id' => [
        'required'        => 'User wajib diisi.',
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
