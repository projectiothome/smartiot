<?php 
	define('HOSTNAME', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', 'dilmangemore');// your db password
	define('DB_SELECT', 'db_crud');//your db name
	$conn = new mysqli(HOSTNAME,USERNAME,PASSWORD,DB_SELECT) or die (mysqli_errno());
	
	
	
	
 ?>