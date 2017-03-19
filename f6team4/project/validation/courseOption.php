<?php
//all php that inherit this will have the course archieve and delete btn feature
	include "serverTest.php";
	//delete the course
	if (isset($_POST["deleteCourse"]))
	{
		$sql = "DELETE FROM courselist where course_id =".$_SESSION['cCID'].";
				DELETE FROM GradeMaterials where course_id=".$_SESSION['cCID'].";
				DELETE FROM GradeGoals where course_id=".$_SESSION['cCID'].";
				DELETE FROM GradeFinal where course_id=".$_SESSION['cCID'].";
				DELETE FROM GradeTrivials where course_id=".$_SESSION['cCID'];
				
		$result = $conn->multi_query($sql);
		
		if($result===true)
			header("Location:../website_pages/courseDashBoard.php");
		else
			echo"failed";	
	}
	
	//archive the course
	if(isset($_POST["archiveCourse"]))
	{
		$sql = "UPDATE courselist
				SET archive=? where course_id=?";
		$sqmt=$conn->prepare($sql);
		$sqmt->bind_param("ii",$value1,$value2);
		$value1=1;
		$value2=$_SESSION['cCID'];
		if($sqmt->execute())
		{
			header("Location:../website_pages/courseDashBoard.php");
			$sqtmt->close();
			exit();
		}
		else
			echo"failed";
	}
	//restore the course
	if(isset($_POST["unarchiveCourse"]))
	{
		$sql = "UPDATE courselist
				SET archive=? where course_id=?";
		$sqmt=$conn->prepare($sql);
		$sqmt->bind_param("ii",$value1,$value2);
		$value1=0;
		$value2=$_SESSION['aCID'];
		if($sqmt->execute())
		{
		
			header("Location:../website_pages/archiveDashBoard.php");
		
		}
		else
			echo"failed";
				
	}
	//delete the course from archive
	if (isset($_POST["adeleteCourse"]))
	{
		$sql = "DELETE FROM courselist where course_id =".$_SESSION['aCID'].";
				DELETE FROM GradeMaterials where course_id=".$_SESSION['aCID'].";
				DELETE FROM GradeGoals where course_id=".$_SESSION['aCID'].";
				DELETE FROM GradeFinal where course_id=".$_SESSION['aCID'].";
				DELETE FROM GradeTrivials where course_id=".$_SESSION['aCID'];
				
		$result = $conn->multi_query($sql);
		
		if($result===true)
			header("Location:../website_pages/courseDashBoard.php");
		else
			echo"failed";	
	}
?>