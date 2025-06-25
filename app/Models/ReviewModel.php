<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'review';
    protected $primaryKey       = 'review_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Review::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'coment',
        'rating',
        'property_id',
        'reservasi_id',
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
        'coment'        => 'required|string',
        'rating'        => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
        'property_id'   => 'required|is_not_unique[property.property_id]',
        'reservasi_id'  => 'required|is_not_unique[reservasi.reservasi_id]',
        'user_id'       => 'required|is_not_unique[user.user_id]'
    ];
    protected $validationMessages   = [
        'coment' => [
            'required' => 'Komentar harus diisi.'
        ],
        'rating' => [
            'required' => 'Rating harus diisi.',
            'integer'  => 'Rating harus berupa angka.',
            'greater_than_equal_to' => 'Rating minimal 1.',
            'less_than_equal_to'    => 'Rating maksimal 5.'
        ],
        'property_id' => [
            'required' => 'Property wajib dipilih.',
            'is_not_unique' => 'Property tidak ditemukan.'
        ],
        'reservasi_id' => [
            'required' => 'Reservasi wajib dipilih.',
            'is_not_unique' => 'Reservasi tidak ditemukan.'
        ],
        'user_id' => [
            'required' => 'User wajib dipilih.',
            'is_not_unique' => 'User tidak ditemukan.'
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
