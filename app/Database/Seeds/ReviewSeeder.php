<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'coment' => 'Sangat nyaman dan bersih!',
                'rating' => 5,
                'property_id' => 1,
                'reservasi_id' => 1,
                'user_id' => 1
            ]
        ];

        $this->db->table('review')->insertBatch($data);
    }
}
