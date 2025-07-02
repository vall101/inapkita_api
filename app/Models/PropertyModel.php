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
    protected $allowedFields    = [
        'description','nama_kamar','harga','status','alamat','user_id','foto',
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
        'description' => 'required|string',
        'nama_kamar'  => 'required|string|max_length[100]',
        'harga'       => 'required|integer',
        'status'      => 'required|in_list[0,1]', // misal: 0=tidak tersedia, 1=tersedia
        'alamat'      => 'required|string',
        'user_id'     => 'required|integer|is_not_unique[user.user_id]',
        'foto'        => 'permit_empty',
    ];
        
    protected $validationMessages   = [
        'description' => [
        'required' => 'Deskripsi wajib diisi.',
        ],
        'nama_kamar' => [
        'required'   => 'Nama kamar wajib diisi.',
        'max_length' => 'Nama kamar maksimal 100 karakter.',
        ],
        'harga' => [
        'required' => 'Harga wajib diisi.',
        'integer'  => 'Harga harus berupa angka.',
        ],
        'status' => [
        'required' => 'Status wajib diisi.',
        'in_list'  => 'Status harus 0 (tidak tersedia) atau 1 (tersedia).',
        ],
        'alamat' => [
        'required' => 'Alamat wajib diisi.',
        ],
        'user_id' => [
        'required'     => 'User ID wajib diisi.',
        'is_not_unique'=> 'User ID tidak ditemukan di tabel user.',
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
