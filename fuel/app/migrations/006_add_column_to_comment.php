<?php

namespace Fuel\Migrations;

class Add_column_to_comment
{
	public function up()
	{
		\DBUtil::add_fields('comments', array(
			'user_id' => array('constraint' => 255, 'type' => 'varchar'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('comments', array(
			'user_id'

		));
	}
}