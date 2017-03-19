<?php
	ob_start();
	session_start();
	include "serverTest.php";
	$studentID=$_SESSION["student_id"];
	
	//if uploading file
	if(isset($_POST['btn-upload']))
	{
		$file = rand(1000,100000)."-".$_FILES["file"]["name"];
		$file_loc = $_FILES["file"]["tmp_name"];
		$file_size=$_FILES['file']['size'];
		$file_type = $_FILES["file"]["type"];
		$folder="../uploads/";
		
		$newSize = $file_size/1024;
		
		$newName = strtolower($file);
		$finalVersion =str_replace(' ','-',$newName);
		
		//upload the file
	 if(move_uploaded_file($file_loc,$folder.$finalVersion))
		 {
		  $sql="INSERT INTO uploads(id,file,type,size) VALUES(?,?,?,?)";
		  $stmt = $conn->prepare($sql);
		  $stmt->bind_param("issi",$studentID,$finalVersion,$file_type,$newSize);
		  $stmt->execute();
		  ?>
		  <script>
		  alert('successfully uploaded');
			window.location.href='../website_pages/UploadDownload.php';
				</script>
		  <?php
		 }
		 else
		 {
		  ?>
		  <script>
		  alert('error while uploading file');
			window.location.href='../website_pages/UploadDownload.php';
				</script>
		  <?php
		 }
	}
		?>