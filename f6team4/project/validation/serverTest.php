<?php	
	//server test
	$host = 'hosting.com';
	$database = 'student_data';
	$db_username = 'admin';
	$db_password = 'password';
	$conn = new mysqli($host, $db_username, $db_password, $database);

	if($conn -> connect_error)

	{
		die("Connection failed: ".$conn -> connect_error);
	}
?>