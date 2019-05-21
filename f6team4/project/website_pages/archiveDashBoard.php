<?php 
		ob_start();
		session_start();
		include "../validation/serverTest.php";	
		
		
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		//Retrieve Courselist
		$array = [];
		$array2=[];
		$selectedID = $_SESSION["student_id"];
		$sql = "select course_id,name from courselist where id=? and archive=true order by name ASC";
		
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
		
		//Store all collected courses into array
		$_SESSION["storedArchivesID"] = $array2;
		$_SESSION["storedArchivesName"] = $array;		
		
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
		include "../template/template.php";
		include "../template/templateNav.php";
	?>
	
	<div class="wrapper">
		<div class="content">
			<div class="courseListBx" style="height:714px;">
				<div class="courseHead">
					<h1>My Archives</h1>
				</div>
				<!-- CourseList will be placed here-->
				<div class="courseTable">
					<?php
						echo "<ul>";
						for($i=0;$i<count($array);$i++)
						{
							echo "<li><a  href='../validation/archiveValidation.php?".$i."'>".$array[$i]."</a></li>";
						}
						echo "</ul>";
					?>
				</div>
			</div>
			<div class="courseRightBx">
			</div>
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>
</body>
</html>