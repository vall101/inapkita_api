<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Property extends Entity
{
    protected $datamap = [];

    // Otomatis parsing ke DateTimeInterface untuk kolom waktu
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Casting data ke tipe yang tepat
    protected $casts = [ 
        'harga'   => 'int',
        'status'  => 'int',
        'user_id' => 'int',
    ];
}
