<?php

namespace Fuel\Migrations;

class Create_histories
{
	public function up()
	{
		\DBUtil::create_table('histories', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'date' => array('type' => 'DATE'),
			'message' => array('type' => 'TEXT'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('histories');
	}
}