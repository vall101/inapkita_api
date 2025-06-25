<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Review extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at'];
    protected $casts   = [
        'review_id'     => 'integer',
        'coment'        => 'string',
        'rating'        => 'integer',
        'property_id'   => 'integer',
        'reservasi_id'  => 'integer',
        'user_id'       => 'integer'
    ];
}
