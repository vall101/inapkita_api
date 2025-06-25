<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Payment extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'payment_id'     => 'integer',
        'metode_bayar'   => 'integer',
        'jumlah_bayar'   => 'integer',
        'tgl_bayar'      => 'integer',
        'status_bayar'   => 'integer',
        'reservasi_id'   => 'integer',
        'user_id'        => 'integer',
    ];
}
