<?php	
	//server test
	$host = 'HostWebsite.com';
	$database = 'f6team4_student_data';
	$db_username = 'user';
	$db_password = 'password';
	$conn = new mysqli($host, $db_username, $db_password, $database);

	if($conn -> connect_error)

	{
		die("Connection failed: ".$conn -> connect_error);
	}
?>