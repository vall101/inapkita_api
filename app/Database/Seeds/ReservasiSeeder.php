<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReservasiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'status' => 1,
                'check_in' => 20250624,
                'check_out' => 20250626,
                'total_harga' => 400000,
                'user_id' => 1,
                'property_id' => 1
            ]
        ];

        $this->db->table('reservasi')->insertBatch($data);
    }
}