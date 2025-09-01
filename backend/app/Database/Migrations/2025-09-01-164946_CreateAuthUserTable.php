<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthUserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'auto_increment' => true],
            'name'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'     => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'=> ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth_user');
    }

    public function down()
    {
        $this->forge->dropTable('auth_user');
    }
}
