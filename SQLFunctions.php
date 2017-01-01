<?php
include('config.php');

/*Opens connection to database with credentials*/
function connectDB() {
    $link = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	/*echo "<br>Connected successfully"; */
	return $link;
}

?>