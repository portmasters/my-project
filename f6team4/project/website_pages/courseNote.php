<?php 
		ob_start();
		session_start();
		include"../validation/courseOption.php";
		
		//Check if user is logged in
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		//Find out which course was selected
		$courseid=$_SESSION['cCID'];
		
		
		//Collect saved notes and display it
		$sql = "select notes from GradeTrivials where course_id=?";
		if($result = $conn->prepare($sql))
		{
			$result ->bind_param("i",$courseid);
			$result ->execute();
			$result ->bind_result($temp);
			while($result->fetch())
			{
				$notesOutput=$temp;
			}
			
		}
		
		//Button will save note info
		if (isset($_POST["submit"]))
		{
			$sql = "UPDATE GradeTrivials 
					SET notes=?
					WHERE course_id=?";
					
			$result = $conn->prepare($sql);
			$result->bind_param("si",htmlspecialchars($_POST["txtbxNote"]),$courseid);
			
			if($result->execute())
			{
				echo "success!";
				header("Location:courseNote.php");
			}
			else
				echo mysqli_error($conn);
		}
		
			
	
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Notes</title>
	<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
	<link href="../stylesheet/courseOption.css" type="text/css" rel="stylesheet"/>
	<link href="../stylesheet/courseNote.css" rel="stylesheet" type="text/css"/>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
	<?php
		include "../template/template.php";
		include "../template/templateNav.php";
	?>
	<div class="wrapper">
		<div class="content">
			<div class="courseListBx">
				<div class="courseHead"><h1><?php echo $_SESSION["cCName"];?></h1>
				</div> 	
				<div class="CourseTable">
					<ul>
						<li><a href="courseGrade.php">Grade</a></li>
						<li><a href="courseTeacher.php">Teacher Rating</a></li>
						<li><a href="">Notes</a></li>
					</ul>
				</div>
				<div class="Options">
					<form method="post">
						<input class="deleteCourse" name="deleteCourse" type="submit" value="Delete Course"/><br>
						<input class="archiveCourse" name="archiveCourse" type="submit" value="Archive Course"/>
					</form>
				</div>
			</div>
			<div class="courseRightBx">
				<h1>Notes</h1>
				<br>
				<form method="post">
				
				<textarea name="txtbxNote" style="height:200px;" ><?php echo $notesOutput;?></textarea>
				 <input class="btnES" name="submit" type="submit" value="save"/>
				</form>
			</div>
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>
</body>
</html>
