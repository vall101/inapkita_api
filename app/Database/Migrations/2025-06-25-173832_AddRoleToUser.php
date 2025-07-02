<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUser extends Migration
{
   public function up()
    {
        $this->forge->addColumn('user', [
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['customer', 'pegawai', 'pemilik'],
                'default'    => 'customer',
                'after'      => 'password',   // letakkan setelah kolom password
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('user', 'role');
    }
}