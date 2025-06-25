<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Promosi extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'diskon'                => 'int',
        'harga_sebelum_diskon' => 'int',
        'harga_sesudah_diskon' => 'int',
        'property_id'           => 'int',
        'user_id'               => 'int',
    ];
}
