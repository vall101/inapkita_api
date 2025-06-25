<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromosiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'diskon' => 10,
                'harga_sebelum_diskon' => 200000,
                'harga_sesudah_diskon' => 180000,
                'ketentuan' => 'Diskon hanya berlaku weekdays',
                'property_id' => 1,
                'user_id' => 1
            ]
        ];

        $this->db->table('promosi')->insertBatch($data);
    }
}