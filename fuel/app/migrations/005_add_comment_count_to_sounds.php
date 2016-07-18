<?php

namespace Fuel\Migrations;

class Add_comment_count_to_sounds
{
	public function up()
	{
		\DBUtil::add_fields('publicsounds', array(
			'comment_count' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('publicsounds', array(
			'comment_count'

		));
	}
}