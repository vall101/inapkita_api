<?php

namespace App\Models;

use CodeIgniter\Model;

class ResepsionisModel extends Model
{
    protected $table            = 'resepsionis';
    protected $primaryKey       = 'resepsionis_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Resepsionis::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'email',
        'no_hp',
        'password',
        'reservasi_id',
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
        'nama'         => 'required|min_length[3]',
        'email'        => 'required|valid_email|is_unique[resepsionis.email]',
        'no_hp'        => 'required|numeric',
        'password'     => 'required|min_length[6]',
        'property_id'  => 'required|is_natural_no_zero',
        'user_id'      => 'required|is_natural_no_zero',
    ];
    protected $validationMessages   = [
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
        ],
        'property_id' => [
            'is_natural_no_zero' => 'Property wajib dipilih.',
        ],
        'user_id' => [
            'is_natural_no_zero' => 'User wajib dipilih.',
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
