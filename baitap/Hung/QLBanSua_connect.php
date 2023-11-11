<?php
define("LOCALHOST", 'localhost');
define("USERNAME", 'root');
define("PASSWORD", '');
define("DATABASENAME", 'qlbansua');

$conn = @mysqli_connect (LOCALHOST, USERNAME, PASSWORD, DATABASENAME) 
		OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
mysqli_set_charset($conn, 'UTF8');
?>