<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ResepsionisSeeder extends Seeder
{
   public function run()
    {
        /**
         * Ambil property pertama milik pemilik demo.
         * Jika kamu yakin property_id = 1, bisa langsung $propertyId = 1;
         */
        $property = $this->db->table('property')->getWhere(['nama_kamar'=>'Kamar Contoh 101'])->getRow();
        if (!$property) {
            echo "✗ Property demo belum ada. Jalankan PemilikSeeder dulu.\n";
            return;
        }
        $propertyId = $property->property_id;

        /* USER pegawai (role = pegawai) */
        $staffUserId = $this->db->table('user')->insert([
            'nama'     => 'Pegawai Demo',
            'no_hp'    => '081111111111',
            'email'    => 'pegawai@gmail.com',
            'password' => password_hash('pegawai123', PASSWORD_DEFAULT),
            'role'     => 'pegawai',
        ], true);

        /* Tabel resepsionis */
        $resepsionisId = $this->db->table('resepsionis')->insert([
            'nama'        => 'Resepsionis Demo',
            'email'       => 'resepsionis@gmail.com',
            'no_hp'       => '081111111111',
            'password'    => password_hash('pegawai123', PASSWORD_DEFAULT),
            'property_id' => $propertyId,
            'shift'       => 'siang',           // abaikan jika kolom shift belum ada
            'user_id'     => $staffUserId,
        ], true);

        /* Baris pemilik (wajib isi resepsionis_id yang valid) */
        $this->db->table('pemilik')->insert([
            'property_id'    => $propertyId,
            'resepsionis_id' => $resepsionisId,
        ]);

        echo "✓ Pegawai & relasi pemilik dibuat (resepsionis_id=$resepsionisId)\n";
    }
}