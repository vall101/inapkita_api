<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ResepsionisSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Resepsionis A',
                'email' => 'resepsionis@example.com',
                'no_hp' => '0811111111',
                'password' => password_hash('resepsionis', PASSWORD_DEFAULT),
                'reservasi_id' => 1,
                'property_id' => 1,
                'user_id' => 1
            ]
        ];

        $this->db->table('resepsionis')->insertBatch($data);
    }
}