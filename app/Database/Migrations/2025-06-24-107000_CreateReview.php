<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReview extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'review_id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'coment' => ['type' => 'TEXT'],
            'rating' => ['type' => 'INT'],
            'property_id' => ['type' => 'INT', 'unsigned' => true],
            'reservasi_id' => ['type' => 'INT', 'unsigned' => true],
            'user_id' => ['type' => 'INT', 'unsigned' => true]
        ]);
        $this->forge->addKey('review_id', true);
        $this->forge->addForeignKey('property_id', 'property', 'property_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('reservasi_id', 'reservasi', 'reservasi_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('review');
    }

    public function down()
    {
        $this->forge->dropTable('review');
    }
}
