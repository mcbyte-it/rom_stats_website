<?php

require_once('meekrodb.2.1.class.php');

DB::$host = 'localhost'; 			// Database host name 
DB::$dbName = 'romstat_db';			// Database name
DB::$user = 'username';				// Database username
DB::$password = 'password';			// Database password

DB::$error_handler = 'custom_db_error_handler';

function custom_db_error_handler($params) {
	if (isset($params['query'])) $out[] = "QUERY: " . $params['query'];
	if (isset($params['error'])) $out[] = "ERROR: " . $params['error'];
	$out[] = "";

	echo implode("<br>\n", $out);

	die;
}
