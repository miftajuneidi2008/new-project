<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgramMigration extends Migration
{
   public function up()
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
              'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
             'category_id' => [
               'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
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
        $this->forge->addForeignKey('category_id', 'program_categories', 'id', 'CASCADE', 'CASCADE');


        // Create the table
        $this->forge->createTable('program');
    }

    public function down()
    {
        $this->forge->dropTable('news');
    }
}
