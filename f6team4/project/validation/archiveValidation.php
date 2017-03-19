<?php
	ob_start();
	session_start();
	include "serverTest.php";
	
	//Set $i as querry string and select the saved session index.
	for($i=0;$i<count($_SESSION["storedArchivesID"]);$i++)
		if ($_SERVER['QUERY_STRING']==$i)
			{
				$course_id=$_SESSION["storedArchivesID"][$i];
				$course_name=$_SESSION["storedArchivesName"][$i];
				$_SESSION["aCID"]=$course_id;
				$_SESSION["aCName"]=$course_name;
				$_SESSION["aCPage"]=$i;
				header("Location:../website_pages/archiveGrade.php");
			}
			
	
						
?>