<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProperties extends Migration
{
      public function up()
    {
        $this->forge->addField([
            'property_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'description' => ['type' => 'TEXT'],
            'nama_kamar' => ['type' => 'VARCHAR', 'constraint' => 100],
            'harga' => ['type' => 'INT'],
            'status' => ['type' => 'INT'],
            'alamat' => ['type' => 'TEXT'],
            'user_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('property_id', true);
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('property');
    }

    public function down()
    {
        $this->forge->dropTable('property');
    }
}