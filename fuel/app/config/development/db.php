<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			/* かわしぃ：自宅 windows vista の設定 */
			// 'dsn'        => 'mysql:host=localhost;dbname=public_sound',
			// 'username'   => 'kawashi',
			// 'password'   => 'yakisobameron',


			/* かわしぃ：会社 MacBook Pro の設定 */
			'dsn'        => 'mysql:host=localhost;dbname=public_sound;unix_socket=/tmp/mysql.sock',
			'username'   => 'kawashi',
			'password'   => 'kawashi',

			/* かわしぃ：Xサーバの設定 */
            // 'dsn'        => 'mysql:host=mysql1406.xserver.jp;dbname=yakimeron_publicsound;unix_socket=/var/lib/mysql/mysql.sock',
			// 'username'   => 'yakimeron_meron',
			// 'password'   => 'yakisobameron',
		),
	),
);
