<?php

namespace App\Models;

use CodeIgniter\Model;

class PemilikModel extends Model
{
    protected $table            = 'pemilik';
    protected $primaryKey       = 'pemilik_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Pemilik::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'property_id',
        'resepsionis_id'
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
        'property_id'      => 'required|integer|is_not_unique[property.property_id]',
        'resepsionis_id'   => 'required|integer|is_not_unique[resepsionis.resepsionis_id]',
    ];
    protected $validationMessages   = [
            'property_id' => [
            'required'        => 'Property wajib diisi.',
            'integer'         => 'Property harus berupa angka.',
            'is_not_unique'   => 'Property tidak ditemukan.'
        ],
        'resepsionis_id' => [
            'required'        => 'Resepsionis wajib diisi.',
            'integer'         => 'Resepsionis harus berupa angka.',
            'is_not_unique'   => 'Resepsionis tidak ditemukan.'
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
