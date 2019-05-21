<?php
		ob_start();
		session_start();
		include "../validation/serverTest.php";
		
		//Check is user is logged in
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		$studentID = $_SESSION["student_id"];
		
		
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Manage Upload Files</title>
		<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
		<link href="../stylesheet/UploadDownload.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php
			include "../template/template.php";
			include "../template/templateNav.php";
		?>
	
		<div class="wrapper">
			<div class="content">
				<div class="head">
				<h1> File management</h1>
					<form action="../validation/uploads.php" method="post" enctype="multipart/form-data">
					<input type="file" name="file" />
					<button type="submit" name="btn-upload">upload</button>
					</form>	
				</div>
				<table>
					<tr>
						<td>File Name</td>
						<td>File Type</td>
						<td>File Size(kb)</td>
						<td>Download</td>
						<td>Delete</td>
					</tr>
				<?php
					$sql="SELECT * FROM uploads where id=?";
					$stmt=$conn->prepare($sql);
					$stmt->bind_param("i",$studentID);
					$stmt->execute();
					$stmt->bind_result($fSID,$fFID,$fName,$fType,$fSize);
					while ($stmt->fetch()) 
					{
						?>					 
						<tr>
						<td><?php echo $fName ?></td>
						<td><?php echo $fType ?></td>
						<td><?php echo $fSize ?></td>
						<td><a href="../validation/download.php?path=../uploads/<?php echo $fName ?>">Download</a></td>
						<td><a href="../validation/delete.php?deletefID=<?php echo $fFID ?>">Delete file</a></td>
						</tr>
						<?php
					}
						?>
				</table>
			
			
			</div>
			<?php include "../template/templateFoot.php"; ?>
		</div>
	</body>
	</html>