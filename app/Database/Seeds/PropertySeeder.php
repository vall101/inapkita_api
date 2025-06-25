<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'description' => 'Kamar nyaman dan bersih',
                'nama_kamar' => 'Kamar A1',
                'harga' => 200000,
                'status' => 1,
                'alamat' => 'Jl. Mawar No. 1',
                'user_id' => 1
            ],
            [
                'description' => 'Kamar mewah dengan AC',
                'nama_kamar' => 'Kamar B2',
                'harga' => 350000,
                'status' => 1,
                'alamat' => 'Jl. Melati No. 5',
                'user_id' => 2
            ]
        ];

        $this->db->table('property')->insertBatch($data);
    }
}