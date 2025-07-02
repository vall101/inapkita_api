<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReservasiSeeder extends Seeder
{
    public function run()
    {
         $data = [
            // [
            //     'status'       => 'booked',
            //     'check_in'     => '2025-07-02',
            //     'check_out'    => '2025-07-04',
            //     'total_harga'  => 600000,
            //     'user_id'      => 33, // Customer 1
            //     'property_id'  => 7, // sesuaikan dengan tabel property
            // ],
            [
                'status'       => 'checkin',
                'check_in'     => '2025-07-01',
                'check_out'    => '2025-07-03',
                'total_harga'  => 500000,
                'user_id'      => 33, // Customer 2
                'property_id'  => 7, // sesuaikan dengan tabel property 
            ],
            // [
            //     'status'       => 'checkout',
            //     'check_in'     => '2025-06-28',
            //     'check_out'    => '2025-06-30',
            //     'total_harga'  => 450000,
            //     'user_id'      => 10, // Customer 3
            //     'property_id'  => 5, // sesuaikan dengan tabel property
            // ]
        ];

        $this->db->table('reservasi')->insertBatch($data);
    }
}