<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Reservasi extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'status'        => 'int',
        'check_in'      => 'int',
        'check_out'     => 'int',
        'total_harga'   => 'int',
        'user_id'       => 'int',
        'property_id'   => 'int'
    ];
}
