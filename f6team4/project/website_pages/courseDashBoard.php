<?php 
		ob_start();
		session_start();
		include "../validation/serverTest.php";	
		$selectedID = $_SESSION["student_id"];
		
		//Check if user is logged in and set timestamp
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		$sql = "UPDATE student_account
				SET logged=now() where id=?";
				
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$selectedID);
		$stmt->execute();
		$stmt->close();
				
		//Collects the user created course
		$array = [];
		$array2=[];
		
		$sql = "select course_id,name from courselist where id=? and archive=false order by name ASC";
		
		if($stmt = $conn->prepare($sql))
		{
			$stmt->bind_param("s",$selectedID);
			$stmt->execute();
			$stmt->bind_result($nameOC,$courseid);
			$ia=0;
			while ($stmt->fetch()) 
			{
				$array[$ia]=$courseid;
				$array2[$ia]=$nameOC;
				$ia++;
			}
		}
		
		$_SESSION["storedCoursesID"] = $array2;
		$_SESSION["storedCoursesName"] = $array;
		//
		
		
		//Button that will allow you to add a course and name it.
		if(isset($_POST["addCourse"]))
		{
			$checkIfEmpty = trim($_POST['inputCourseName']);
			
			if(!$checkIfEmpty=="")
			{				
			
			
				$sql = "insert into courselist(id,name,course_id)
						values(?,?,null)";
						
				$addACourse = $conn->prepare($sql);
				$addACourse ->bind_param("is",$selectedID,$courseName);
				$courseName=$_POST['inputCourseName'];
				$addACourse->execute();
				
				header("Location:courseDashBoard.php");		
			}
			else	
				echo "<script>alert('ERROR:Course Name cannot be empty!'); </script>";
		}
		//
		
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
	<link href="../stylesheet/courseDashBoard.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	
	<?php
		if($_SESSION["admin"])
			echo "<a href='adminPage.php'>Admin Control</a>";
		
		include "../template/template.php";
		include "../template/templateNav.php";
	?>
	
	<div class="wrapper">
		<div class="content">
			<div class="courseListBx">
				<div class="courseHead">
					<h1>My Courses</h1>
				</div>
				<!-- CourseList will be placed here-->
				<div class="courseTable">
					<?php
						
						echo "<ul>";
						for($i=0;$i<count($array);$i++)
						{
							echo "<li><a  href='../validation/courseValidation.php?".$i."'>".$array[$i]."</a></li>";
						}
						echo "</ul>";
					?>
				</div>
				<!-- addACourse button will be placed here-->
				<div id="addACoursebx">
					<form method="post">
					<div id="bx"><h3>Enter any course name!</h3></div>
					<input name="inputCourseName" maxlength="18" type="text" />
					<input id="addCourse" name="addCourse" value="Add a course" type="submit"/>
					
					</form>
				</div>
			</div>
			<div class="courseRightBx">
				<h1>Welcome to Student Go</h1>
				<p>Download <a href="../validation/download.php?path=../images/guide/guide.rar" target="_blank">here</a> for a brief tutorial.</p>
				<p>Thank you for signing up with us. There is a brief tutorials if you want to know how our grade calculation work. Please email us at example@abc.com if you have any questions.
					Please note that any supicious uploaded files may be checked, do not upload any illegal content</p> 
			</div>
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>
	<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>
</body>
</html>
