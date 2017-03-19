<?php	
	//server test
	$host = 'gblearn.com';
	$database = 'f6team4_student_data';
	$db_username = 'f6team4_admin';
	$db_password = 'K3[0twQk?.[J';
	$conn = new mysqli($host, $db_username, $db_password, $database);

	if($conn -> connect_error)

	{
		die("Connection failed: ".$conn -> connect_error);
	}
?>