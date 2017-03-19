<?php
	ob_start();
	session_start();
	include "serverTest.php";
	
	//finds out which course was selected and save their info in session
	for($i=0;$i<count($_SESSION["storedCoursesID"]);$i++)
		if ($_SERVER['QUERY_STRING']==$i)
			{
				$course_id=$_SESSION["storedCoursesID"][$i];
				$course_name=$_SESSION["storedCoursesName"][$i];
				$_SESSION["cCID"]=$course_id;
				$_SESSION["cCName"]=$course_name;
				$_SESSION["cCPage"]=$i;
			}
			
			//Check if table exist, if not table will be inserted.
			$sql = "SELECT course_id FROM GradeMaterials where course_id='$course_id'";
			$result = $conn->query($sql);
			$count = $result->num_rows;
			if(!empty($count))
				header("Location:../website_pages/courseGrade.php");
			else
			{
				$sql = "insert into GradeMaterials(course_id) values('$course_id')";
				$result = $conn->query($sql);
				$sql2 = "insert into GradeTrivials(course_id) values('$course_id')";
				$result2 = $conn->query($sql2);
				$sql3 = "insert into GradeGoals(course_id) values('$course_id')";
				$result3 = $conn->query($sql3);
				$sql4 = "insert into GradeFinal(course_id) values('$course_id')";
				$result4 = $conn->query($sql4);
				
				if($result===true&&$result2===true&&$result3===true&&$result4===true)
					header("Location:../website_pages/courseGrade.php");
					else
						echo "error";
			}				
?>