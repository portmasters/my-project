<?php
		//page will log user out
		session_start();
		ob_start();
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['student_id']);
		session_unset();
		session_destroy();
		
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
?>