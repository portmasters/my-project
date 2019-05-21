<?php 
		ob_start();
		session_start();
		include"../validation/courseOption.php";
		
		//Check if user is logged in
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		//Find out which course was selected
		$courseid=$_SESSION['aCID'];
		
		
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
				<div class="courseHead"><h1><?php echo $_SESSION["aCName"];?></h1>
				</div> 	
				<div class="CourseTable">
					<ul>
						<li><a href="archiveGrade.php">Grade</a></li>
						<li><a href="archiveTeacher.php">Teacher Rating</a></li>
						<li><a href="">Notes</a></li>
					</ul>
				</div>
				<div class="Options">
					<form method="post">
						<input class="deleteCourse" name="adeleteCourse" type="submit" value="Delete Course"/><br>
						<input class="archiveCourse" name="unarchiveCourse" type="submit" value="Restore Course"/>
					</form>
				</div>
			</div>
			<div class="courseRightBx">
				<h1>Archive Notes</h1>
				<br>
				<form method="post">
				
				<textarea name="txtbxNote" style="height:200px;" readonly ><?php echo $notesOutput;?></textarea>
				 
				</form>
			</div>
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>
</body>
</html>
