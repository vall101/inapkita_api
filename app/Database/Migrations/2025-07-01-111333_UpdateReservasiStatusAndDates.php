<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateReservasiStatusAndDates extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE reservasi 
        MODIFY status ENUM('booked', 'checkin', 'checkout') DEFAULT 'booked',
        MODIFY check_in DATE NULL,
        MODIFY check_out DATE NULL,
        MODIFY total_harga INT UNSIGNED");
}

public function down()
{
    $this->db->query("ALTER TABLE reservasi 
        MODIFY status INT,
        MODIFY check_in INT,
        MODIFY check_out INT,
        MODIFY total_harga INT");
}
}
