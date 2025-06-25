<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemilik extends Migration
{
  public function up()
    {
       $this->forge->addField([
        'pemilik_id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
        'property_id' => ['type' => 'INT', 'unsigned' => true],
        'resepsionis_id' => ['type' => 'INT', 'unsigned' => true],
    ]);
    $this->forge->addKey('pemilik_id', true);
    $this->forge->addForeignKey('property_id', 'property', 'property_id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('resepsionis_id', 'resepsionis', 'resepsionis_id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('pemilik');
    }

    public function down()
    {
        $this->forge->dropTable('pemilik');
    }
}