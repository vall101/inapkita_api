<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePromosi extends Migration
{
 public function up()
    {
        $this->forge->addField([
            'promosi_id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'diskon' => ['type' => 'INT'],
            'harga_sebelum_diskon' => ['type' => 'INT'],
            'harga_sesudah_diskon' => ['type' => 'INT'],
            'ketentuan' => ['type' => 'TEXT'],
            'property_id' => ['type' => 'INT', 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('promosi_id', true);
        $this->forge->addForeignKey('property_id', 'property', 'property_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('promosi');
    }

    public function down()
    {
        $this->forge->dropTable('promosi');
    }
}