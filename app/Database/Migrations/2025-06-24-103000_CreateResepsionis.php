<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResepsionis extends Migration
{
 public function up()
    {
        $this->forge->addField([
            'resepsionis_id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'no_hp' => ['type' => 'VARCHAR', 'constraint' => 20],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'reservasi_id' => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'property_id' => ['type' => 'INT', 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('resepsionis_id', true);
        $this->forge->addForeignKey('property_id', 'property', 'property_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('reservasi_id', 'reservasi', 'reservasi_id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('resepsionis');
    }

    public function down()
    {
        $this->forge->dropTable('resepsionis');
    }
}