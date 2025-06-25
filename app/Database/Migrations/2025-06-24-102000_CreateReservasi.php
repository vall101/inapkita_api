<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservasi extends Migration
{
 public function up()
    {
        $this->forge->addField([
            'reservasi_id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'status' => ['type' => 'INT'],
            'check_in' => ['type' => 'INT'],
            'check_out' => ['type' => 'INT'],
            'total_harga' => ['type' => 'INT'],
            'user_id' => ['type' => 'INT', 'unsigned' => true],
            'property_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('reservasi_id', true);
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('property_id', 'property', 'property_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservasi');
    }

    public function down()
    {
        $this->forge->dropTable('reservasi');
    }
}