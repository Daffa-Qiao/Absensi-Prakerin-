<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Member extends Migration
{
    public function up()
    {
        //
	$this->forge->addColumn('absensi',[
	'member_id' => [
		'type' => 'INT',
		'constraint' => 5, 
		'null' => false,
		'after' => 'id',
	    ],
	]);
    }

    public function down()
    {
        //
	$this->forge->dropColumn('absensi', 'member_id');
    }
}
