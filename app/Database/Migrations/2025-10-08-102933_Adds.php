<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adds extends Migration
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
     
              'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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


        $this->forge->createTable('adds');
    }

    public function down()
    {
        $this->forge->dropTable('adds');
    }
}
