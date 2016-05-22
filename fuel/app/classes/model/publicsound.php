<?php

class Model_Publicsound extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'data',
		'genre',
		'message',
		'created_at',
		'updated_at',
        'play_count',
        'dl_count'
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name  = 'publicsounds';
}
