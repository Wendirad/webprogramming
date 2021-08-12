<?php
	define("DB_SERVER", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "webprogramming");

	$link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($links -> connection_error) {
		echo "COnnection failed".$link->connection_error;
		exit();
	}

?>