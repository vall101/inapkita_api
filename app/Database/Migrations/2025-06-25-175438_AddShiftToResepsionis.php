<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShiftToResepsionis extends Migration
{
    public function up()
    {
        $this->forge->addColumn('resepsionis', [
            'shift' => [
                'type'       => 'ENUM',
                'constraint' => ['siang', 'malam'],
                'default'    => 'siang',
                'after'      => 'no_hp',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('resepsionis', 'shift');
    }
}