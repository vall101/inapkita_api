<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PemilikSeeder extends Seeder
{
  public function run()
    {
        /* USER pemilik (role = pemilik) */
        $ownerId = $this->db->table('user')->insert([
            'nama'     => 'Pemilik Demo',
            'no_hp'    => '081234567890',
            'email'    => 'owner@gmail.com',
            'password' => password_hash('owner123', PASSWORD_DEFAULT),
            'role'     => 'pemilik',
        ], true); // true => return insertID

        /* PROPERTY milik pemilik tsb */
        $propertyId = $this->db->table('property')->insert([
            'nama_kamar'  => 'Kamar Contoh 101',
            'description' => 'Kamar demo milik pemilik',
            'harga'       => 300000,
            'status'      => 1,
            'alamat'      => 'Jl. Contoh No.1',
            'user_id'     => $ownerId,      // FK ke user pemilik
        ], true);

        // Belum isi tabel pemilik di sini (resepsionis belum ada)
        echo "✓ Pemilik & property dibuat (user_id=$ownerId, property_id=$propertyId)\n";
    }
}