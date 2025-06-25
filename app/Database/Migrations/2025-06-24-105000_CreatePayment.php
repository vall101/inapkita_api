<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayment extends Migration
{
 public function up()
    {
        $this->forge->addField([
            'payment_id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'metode_bayar' => ['type' => 'INT'],
            'jumlah_bayar' => ['type' => 'INT'],
            'tgl_bayar' => ['type' => 'INT'],
            'status_bayar' => ['type' => 'INT'],
            'reservasi_id' => ['type' => 'INT', 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('payment_id', true);
        $this->forge->addForeignKey('reservasi_id', 'reservasi', 'reservasi_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payment');
    }

    public function down()
    {
        $this->forge->dropTable('payment');
    }
}