<?php
	ob_start();
	session_start();
	include "../validation/serverTest.php";
	
	//checks if admin
	if(!$_SESSION["admin"] && !$_SESSION["username"])
		header("Location:../index.php");
	
	//checks how many users are logged in
	$countLogin=0;
	$sql="SELECT logged from student_account WHERE logged > DATE_SUB(NOW(), INTERVAL 30 MINUTE)";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($CountLogin);
	while($stmt->fetch())
		$countLogin++;
	$stmt->close();
	
	
	
	//checks how many users there are in database
	$user=[];
	$logged=[];
	$usersID=[];
	$sql="SELECT id,username,logged from student_account where admin<>1 order by id ASC";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($uID,$uUser,$uLog);
	$i=0;
	while ($stmt->fetch())
	{
		$user[$i] = $uUser;
		$logged[$i] = $uLog;
		$usersID[$i]=$uID;
		$i++;
	}
	$stmt->close();
	//
	
	//checks how many uploads from each user
	$uploadNumber=[];
	$i=0;
	foreach($usersID as $Tid)
	{
		$uploadNumber[$i]=0;
		
		$sql="SELECT file from uploads where id=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$Tid);
		$stmt->execute();
		
		while($stmt->fetch())
			$uploadNumber[$i]++;
		
		$i++;
		
	}
	$stmt->close();
	//
	
	//checks how many user achieved their mark goals
	$goalsAchived=[];
	$i=0;
	foreach($usersID as $Tid)
	{
		$goalsAchived[$i]=0;
		$sql="SELECT course_id from courselist where id=?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$Tid);
		$stmt->execute();
		$stmt->bind_result($CourseID);
		$courseID=[];
		$io=0;
		while($stmt->fetch())
		{
			if($CourseID!=null)
			$courseID[$io]=$CourseID;
			$io++;
		}
		$stmt->close();
		
		if(count($courseID)>0)
		{
		foreach($courseID as $TTID)
		{
			
			$sql="SELECT assignment1,assignment2,assignment3,quiz,midterm,exam from GradeGoals where course_id=?";
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("i",$TTID);
			$stmt->execute();
			$stmt->bind_result($gAss,$gAAss,$gAAAss,$gQu,$gMid,$gEx);
			$stmt->fetch();
			$stmt->close();
			
			$sql="SELECT assignment1,assignment2,assignment3,quiz,midterm,exam from GradeMaterials where course_id=?";
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("i",$TTID);
			$stmt->execute();
			$stmt->bind_result($gAss2,$gAAss2,$gAAAss2,$gQu2,$gMid2,$gEx2);
			while($stmt->fetch())
			{
				if($gAss2 !== null && $gAss!==null)
				{
					if($gAss2>=$gAss)
					{
						$goalsAchived[$i]++;
					}
				}
				if($gAAss2 !== null && $gAAss!==null)
				{
					if($gAAss2>=$gAAss)
					{
						$goalsAchived[$i]++;
					}
				}
				if($gAAAss2 !== null && $gAAAss!==null)
				{
					if($gAAAss2>=$gAAAss)
					{
						$goalsAchived[$i]++;
					}
				}
				if($gQu2 !== null && $gQu!==null)
				{
					if($gQu2>=$gQu)
					{
						$goalsAchived[$i]++;
					}
				}
				if($gMid !== null && $gMid!==null)
				{
					if($gMid2>=$gMid)
					{
						$goalsAchived[$i]++;
					}
				}
				if($gEx2 !== null && $gEx!==null)
				{
					if($gEx2>=$gEx)
					{
						$goalsAchived[$i]++;
					}
				}
			}
		}
			
			
		}
		$i++;
	}
	//
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Admin Control</title>
		<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
		<style>
			.content h1{
				margin:0px;
				padding-left:20px;
				padding: 10px 0px 10px 20px;
				background-color:#4682b4;
				
			}
			table{
				width:100%;
				margin-bottom:100px;
			}
			td{
				border:1px solid black;
			}
			.content{
				background-image:url(../images/adminBackground.jpg);
				background-size:cover;       
				background-repeat: no-repeat;
				background-position:center center;
				color:white;
				box-shadow:2px 2px 3px #888888;
			}
			.content a:link{
				color:white;
			}
			#adminHead{
				box-shadow:0px 1px 1px black;
			}
		</style>
	</head>
	<body>
		<?php
			include "../template/template.php";
			include "../template/templateNav.php";
		?>
	
		<div class="wrapper">
			<div class="content">
			
				<div id="adminHead">
					<h1>Admin Control</h1>
				</div>
				<?php echo "<p>Number of users login within the last 30 minutes: ".$countLogin."</p>";?>
				<table>
					<tr>
						<td>ID</td>
						<td>User</td>
						<td>#Achieved Goal</td>
						<td>#Uploads</td>
						<td>Last logged</td>
						<td>Delete</td>
					</tr>
				<?php
				//DISPLAY ALL USER INFO
					$i=0;
					foreach($user as $users) 
					{
				?>					 
						<tr>
						<td><?php echo $usersID[$i];?></td>
						<td><?php echo $users; ?></td>
						<td><?php echo $goalsAchived[$i];?></td>
						<td><?php echo $uploadNumber[$i]; ?></td>
						<td><?php echo $logged[$i];?></td>
						<td><a href="../validation/delete.php?deleteAccID=<?php echo $usersID[$i]?>">Delete Account</a></td>
						</tr>
				<?php
						$i++;
					}
					//
				?>
				</table>
			
			</div>
			<?php include "../template/templateFoot.php"; ?>
		</div>
	
	</body>
	</html>