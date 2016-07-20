<?php

class Model_Comment extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'sound_id',
		'message',
		'date',
		'created_at',
		'updated_at',
        'user_id',
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

	protected static $_table_name = 'comments';

}
