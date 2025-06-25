<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'metode_bayar' => 1,
                'jumlah_bayar' => 400000,
                'tgl_bayar' => 20250624,
                'status_bayar' => 1,
                'reservasi_id' => 1,
                'user_id' => 1
            ]
        ];

        $this->db->table('payment')->insertBatch($data);
    }
}