
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVerifiedStudentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'original_trial_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'mobile' => [
                'type'       => 'VARCHAR',
                'constraint' => 15,
            ],
            'age' => [
                'type'       => 'INT',
                'constraint' => 3,
            ],
            'city' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'cricket_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'payment_status' => [
                'type'       => 'ENUM',
                'constraint' => ['partial', 'full'],
                'default'    => 'partial',
            ],
            'balance_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00,
            ],
            'verified_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            't_shirt_given' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'moved_at' => [
                'type' => 'DATETIME',
                'null' => false,
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

        $this->forge->addKey('id', true);
        $this->forge->addKey('original_trial_id');
        $this->forge->addKey('mobile');
        $this->forge->addKey('payment_status');
        $this->forge->createTable('verified_students');
    }

    public function down()
    {
        $this->forge->dropTable('verified_students');
    }
}
