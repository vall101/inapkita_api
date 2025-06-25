<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Admin One',
                'no_hp' => '081234567890',
                'email' => 'admin1@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT)
            ],
            [
                'nama' => 'User Two',
                'no_hp' => '089876543210',
                'email' => 'user2@example.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT)
            ]
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
