<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PemilikSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'property_id' => 1,
                'resepsionis_id' => 1
            ]
        ];

        $this->db->table('pemilik')->insertBatch($data);
    }
}
