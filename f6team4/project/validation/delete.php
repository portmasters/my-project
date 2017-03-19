<?php
include "../validation/serverTest.php";

//delete uploaded files
if(isset($_GET['deletefID']))
{
	$fID=$_GET['deletefID'];
	$sql="SELECT file FROM uploads WHERE file_id=".$fID;
	$sql2="DELETE FROM uploads WHERE file_id=".$fID;
	
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($file);
	$stmt->fetch();
	unlink("../uploads/".$file);
	$stmt->close();
	$stmt=$conn->prepare($sql2);
	$stmt->execute();
	$stmt->close();

	header("Location:../website_pages/UploadDownload.php");
}
//

//delete everything on the selected account from admin page
if(isset($_GET['deleteAccID']))
{
	$accID=$_GET['deleteAccID'];
	$courseids=[];
	$sql="SELECT course_id FROM courselist WHERE id=".$accID;
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($courseid);
	$i=0;
	while($stmt->fetch())
	{
		$courseids[$i]=$courseid;
		$i++;
	}
	$stmt->close();
	if(count($courseids)>0)
	{
		foreach($courseids as $deleteid)
		{
			$sql="DELETE FROM GradeMaterials WHERE course_id=".$deleteid;
			$sql2="DELETE FROM GradeFinal WHERE course_id=".$deleteid;
			$sql3="DELETE FROM GradeGoals WHERE course_id=".$deleteid;
			$sql4="DELETE FROM GradeTrivials WHERE course_id=".$deleteid;
			$sql5="DELETE FROM courselist WHERE course_id=".$deleteid;
			
			$stmt=$conn->prepare($sql);
			$stmt2=$conn->prepare($sql2);
			$stmt3=$conn->prepare($sql3);
			$stmt4=$conn->prepare($sql4);
			$stmt5=$conn->prepare($sql5);
			$stmt->execute();
			$stmt2->execute();
			$stmt3->execute();
			$stmt4->execute();
			$stmt5->execute();
			$stmt->close();
			$stmt2->close();
			$stmt3->close();
			$stmt4->close();
			$stmt5->close();
		}
	}
	$sql="SELECT file FROM uploads WHERE id=".$accID;
	$sql2="DELETE FROM uploads WHERE id=".$accID;
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($fList);
	while($stmt->fetch())
	{
		unlink("../uploads/".$fList);
	}
	$stmt->close();
	$stmt=$conn->prepare($sql2);
	$stmt->execute();
	$stmt->close();
	
	$sql="DELETE FROM student_account WHERE id=".$accID;
	$sql2="DELETE FROM student_infomation WHERE id=".$accID;
	$stmt=$conn->prepare($sql);
	$stmt2=$conn->prepare($sql2);
	$stmt->execute();
	$stmt2->execute();
	$stmt->close();
	$stmt2->close();
	
header("Location:../website_pages/adminPage.php");
}
?>