
<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddVerificationFieldsToTrialPlayers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('trial_players', [
            'payment_type' => [
                'type' => 'ENUM',
                'constraint' => ['partial', 'full'],
                'default' => 'partial',
                'null' => false,
                'after' => 'cricket_type'
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'partial', 'full'],
                'default' => 'pending',
                'null' => false,
                'after' => 'payment_type'
            ],
            'balance_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
                'null' => false,
                'after' => 'payment_status'
            ],
            'is_verified' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
                'after' => 'balance_amount'
            ],
            'verified_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'after' => 'is_verified'
            ],
            't_shirt_given' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
                'after' => 'verified_at'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('trial_players', [
            'payment_type',
            'payment_status', 
            'balance_amount',
            'is_verified',
            'verified_at',
            't_shirt_given'
        ]);
    }
}
