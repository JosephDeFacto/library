<?php 

session_start();

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mylibrary');

function getConn() {

	$host = DB_SERVER;
	$user = DB_USER;
	$pass = DB_PASS;
	$dbname = DB_NAME;

	try {
		$connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $connection;
	} catch (PDOException $exception) {
		echo "Connection failed: " . $exception->getMessage();
	}
}

?>