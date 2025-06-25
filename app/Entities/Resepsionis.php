<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Resepsionis extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'resepsionis_id' => 'integer',
        'reservasi_id'   => 'integer',
        'property_id'    => 'integer',
        'user_id'        => 'integer'
    ];
}
