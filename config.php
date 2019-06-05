<?php
//PATHS
//Always provide a trailing slash (/) after a path
define('URL', 'http://localhost/mvc/');
define('LIBS', 'libs/');

//DATABASE CONFIG
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'mvc');
define('DB_USER', 'rootTest');
define('DB_PASS', '12345');

//HASHING KEYS

//this is for more general encryption
define('HASH_GENERAL_KEY', 'MixItUp2000');
//this is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');