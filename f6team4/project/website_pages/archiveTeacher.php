<?php 
		ob_start();
		session_start();
		include"../validation/courseOption.php";
		
		//Check if user logged in
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		$courseid = $_SESSION['aCID'];
		
		//Retrieve Teacher rating and display it
		$sql = "select * from GradeTrivials where course_id=?";
		if($result = $conn->prepare($sql))
		{
			$result->bind_param ("i",$courseid);
			$result->execute();
			$result->bind_result($bID,$bN,$bK,$bD,$bC,$bT,$bL);
			
			$ia=0;
			while($result->fetch())
			{
				
				$array[$ia]=$bN;
				$ia++;
				$array[$ia]=$bK;
				$ia++;
				$array[$ia]=$bD;
				$ia++;
				$array[$ia]=$bC;
				$ia++;
				$array[$ia]=$bT;
			}
		}
		//
	
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Teacher Rating</title>
	<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
	<link href="../stylesheet/courseOption.css" type="text/css" rel="stylesheet"/>
	<link href="../stylesheet/courseTeacher.css" rel="stylesheet" type="text/css"/>
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
						
						<li><a href="">Teacher Rating</a></li>
						<li><a href="archiveNote.php">Notes</a></li>
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
				<form method="post">
					
					<h1 style="width:210px;display:inline-block;">Teacher Name:</h1><input name="t_inputName" maxlength="20" id="teacherInput"  type="text" value="<?php echo $array[0]?>">
					<br><br><br>
					<p style="margin:0 0 0 150px;">1&nbsp;&nbsp;&nbsp; 2&nbsp;&nbsp;&nbsp; 3&nbsp;&nbsp;&nbsp;&nbsp; 4&nbsp;&nbsp;&nbsp;&nbsp; 5</p>
					<table id="ratingSystem">
						<tr>
							<th>Knowledge</th>
							<td><input class="star star-1"  <?php if($array[1]==1) echo 'checked'; ?> type="radio" value=1 name="group0"/>
								<input class="star star-2"  <?php if($array[1]==2) echo 'checked'; ?> type="radio" value=2 name="group0"/>
								<input class="star star-3"  <?php if($array[1]==3) echo 'checked'; ?> type="radio" value=3 name="group0"/>
								<input class="star star-4"  <?php if($array[1]==4) echo 'checked'; ?> type="radio" value=4 name="group0"/>
								<input class="star star-5"  <?php if($array[1]==5) echo 'checked'; ?> type="radio" value=5 name="group0"/>
							</td>
						</tr>						
						<tr>
							<th>Difficulty</th>
							<td><input class="star star-1" <?php if($array[2]==1) echo 'checked'; ?> type="radio" value=1 name="group1"/>
								<input class="star star-2" <?php if($array[2]==2) echo 'checked'; ?> type="radio" value=2 name="group1"/>
								<input class="star star-3" <?php if($array[2]==3) echo 'checked'; ?> type="radio" value=3 name="group1"/>
								<input class="star star-4" <?php if($array[2]==4) echo 'checked'; ?> type="radio" value=4 name="group1"/>
								<input class="star star-5" <?php if($array[2]==5) echo 'checked'; ?> type="radio" value=5 name="group1"/>
							</td>
						</tr>
						<tr>
							<th>Clarity</th>
							<td><input class="star star-1" <?php if($array[3]==1) echo 'checked'; ?> type="radio" value=1 name="group2"/>
								<input class="star star-2" <?php if($array[3]==2) echo 'checked'; ?> type="radio" value=2 name="group2"/>
								<input class="star star-3" <?php if($array[3]==3) echo 'checked'; ?> type="radio" value=3 name="group2"/>
								<input class="star star-4" <?php if($array[3]==4) echo 'checked'; ?> type="radio" value=4 name="group2"/>
								<input class="star star-5" <?php if($array[3]==5) echo 'checked'; ?> type="radio" value=5 name="group2"/>
							</td>
						</tr>
						
					</table>
					<h2>comment</h2>		
					<textarea name="commentBx" disabled id="commentBx" rows="8" cols="60" ><?php echo $array[4]?>
					</textarea>
				
				</form>
			</div>
			
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>
</body>
</html>