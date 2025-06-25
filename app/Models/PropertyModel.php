<?php

namespace App\Models;

use CodeIgniter\Model;

class PropertyModel extends Model
{
    protected $table            = 'property';
    protected $primaryKey       = 'property_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Property::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['description', 'nama_kamar', 'harga',
        'status', 'alamat', 'user_id'];

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
        'description' => 'required|string',
        'nama_kamar'  => 'required|string|max_length[100]',
        'harga'       => 'required|integer',
        'status'      => 'required|in_list[0,1]', // misal: 0=tidak tersedia, 1=tersedia
        'alamat'      => 'required|string',
        'user_id'     => 'required|integer|is_not_unique[user.user_id]',
    ];
        
    protected $validationMessages   = [
        'nama' => [
            'required'    => 'Nama property wajib diisi',
            'min_length'  => 'Nama minimal 3 karakter',
            'max_length'  => 'Nama maksimal 100 karakter',
        ],
        'alamat' => [
            'required'    => 'Alamat wajib diisi',
            'min_length'  => 'Alamat terlalu pendek',
        ],
        'harga' => [
            'required'        => 'Harga wajib diisi',
            'integer'         => 'Harga harus berupa angka',
            'greater_than'    => 'Harga harus lebih dari 0',
        ],
        'tipe' => [
            'required'    => 'Tipe property wajib diisi',
            'in_list'     => 'Tipe hanya boleh: Kost, Hotel, Villa, Apartment',
        ],
        'user_id' => [
            'required'           => 'User ID wajib diisi',
            'is_natural_no_zero' => 'User ID harus bilangan bulat positif',
        ]
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
