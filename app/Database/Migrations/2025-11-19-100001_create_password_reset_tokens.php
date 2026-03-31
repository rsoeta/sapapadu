<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasswordResetTokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'auto_increment' => true],
            'email'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'token'             => ['type' => 'VARCHAR', 'constraint' => 64],
            'expires_at'        => ['type' => 'DATETIME'],
            'used'              => ['type' => 'TINYINT', 'default' => 0],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('email');

        $this->forge->createTable('password_reset_tokens');
    }

    public function down()
    {
        $this->forge->dropTable('password_reset_tokens');
    }
}
