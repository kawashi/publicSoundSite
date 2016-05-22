<?php

namespace Fuel\Migrations;

class Add_counter_to_sounds
{
	public function up()
	{
		\DBUtil::add_fields('publicsounds', array(
			'play_count' => array('constraint' => 11, 'type' => 'int'),
			'dl_count' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('publicsounds', array(
			'play_count'
,			'dl_count'

		));
	}
}