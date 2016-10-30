<?php

namespace Fuel\Migrations;

class Create_publicsounds
{
	public function up()
	{
		\DBUtil::create_table('publicsounds', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 50, 'type' => 'varchar'),
			'data' => array('constraint' => 50, 'type' => 'varchar'),
			'genre' => array('constraint' => 50, 'type' => 'varchar'),
			'message' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('publicsounds');
	}
}