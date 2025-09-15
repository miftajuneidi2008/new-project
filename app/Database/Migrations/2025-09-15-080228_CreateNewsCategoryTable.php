<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNewsCategoryTable extends Migration
{public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Add Primary Key
        $this->forge->addKey('id', true);

        // Add Foreign Key from 'user_id' to 'id' on the 'users' table
        $this->forge->addForeignKey('user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('news_categories');
    }

    public function down()
    {
        $this->forge->dropTable('news_categories');
    }
}
