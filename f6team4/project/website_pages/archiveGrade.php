<?php 
		ob_start();
		session_start();
		include"../validation/courseOption.php";
		
		//Check if user is logged in
		if (!isset($_SESSION["username"]))
			header("Location:../index.php");
		
		//Find out which course was selected 
		$course_id = $_SESSION["aCID"];
		$course_name = $_SESSION["aCName"];

		//Retrieve saved Marks from database and display it onto table
		$array = [];
		$array2 = [];
		$array3 = [];
		$array4 = [];
		$array[0] = "Assignment1";
		$array[1] = "Assignment2";
		$array[2] = "Assignment3";
		$array[3] = "Quiz";
		$array[4] = "Midterm";
		$array[5] = "Exam";
		
		$sql = "select * from GradeMaterials where course_id=?";
		if($stmt = $conn->prepare($sql))
		{
			$stmt->bind_param("i",$course_id);
			$stmt->execute();
			$stmt->bind_result($bID,$bAS1,$bAS2,$bAS3,$bQ,$bM,$bE);
			$ia=0;
			while ($stmt->fetch()) 
			{
				$array2[$ia]=$bAS1;
				$ia++;
				$array2[$ia]=$bAS2;
				$ia++;
				$array2[$ia]=$bAS3;
				$ia++;
				$array2[$ia]=$bQ;
				$ia++;
				$array2[$ia]=$bM;
				$ia++;
				$array2[$ia]=$bE;
			}
		}
		$sql = "select * from GradeGoals where course_id=?";
		if($stmt = $conn->prepare($sql))
		{
			$stmt->bind_param("i",$course_id);
			$stmt->execute();
			$stmt->bind_result($bID,$bAS1,$bAS2,$bAS3,$bQ,$bM,$bE);
			$ia=0;
			while ($stmt->fetch()) 
			{
				$array3[$ia]=$bAS1;
				$ia++;
				$array3[$ia]=$bAS2;
				$ia++;
				$array3[$ia]=$bAS3;
				$ia++;
				$array3[$ia]=$bQ;
				$ia++;
				$array3[$ia]=$bM;
				$ia++;
				$array3[$ia]=$bE;
			}
		}
		$sql = "select * from GradeFinal where course_id=?";
		if($stmt = $conn->prepare($sql))
		{
			$stmt->bind_param("i",$course_id);
			$stmt->execute();
			$stmt->bind_result($bID,$bAS1,$bAS2,$bAS3,$bQ,$bM,$bE);
			$ia=0;
			while ($stmt->fetch()) 
			{
				$array4[$ia]=$bAS1;
				$ia++;
				$array4[$ia]=$bAS2;
				$ia++;
				$array4[$ia]=$bAS3;
				$ia++;
				$array4[$ia]=$bQ;
				$ia++;
				$array4[$ia]=$bM;
				$ia++;
				$array4[$ia]=$bE;
			}
		}
		//
		
			
		//calculate Grade and display it
		$isTotal=0;
		$clickCalc=false;
		if(isset($_POST['btnCalc']))
		{
			$clickCalc = true;			
			
		}
		function calculateGrade()
		{
			$isTotal =0;
			$finalWeight=0;
			$storedNullWeight=0;
			$willCalc = false;
			global $array2;
			global $array4;
			$avgNeed=[90,85,80,77,73,70,67,63,60,57,53,50];
			foreach ($array4 as $value)
				$isTotal += $value;
			
			if ($isTotal==100)
					{
						for($i=0;$i<count($array2);$i++)
						{
							if($array2[$i]!=null && $array4[$i]!=null)
							{
								$finalWeight += ($array2[$i]/100)*$array4[$i];
							}
							if($array2[$i]===null && $array4[$i]!=null)
							{
								$storedNullWeight+=$array4[$i];
								$willCalc=true;
							}
						}
						if($willCalc)
						{
							echo "<style>.courseRightBx{height:530px;}.courseListBx{height:530px;}</style>
									<table class='ffWeight'>
										<tr>
											<td style='font-weight:bold;border:0px;'>Grade: </td><td>A+</td><td>A</td><td>A-</td><td>B+</td><td>B</td><td>B-</td><td>C+</td><td>C</td><td>C-</td><td>D+</td><td>D</td><td>D-</td>
										</tr>
										<tr>
											<td style='font-weight:bold;border:0px;'>%: </td><td>100-90</td><td>89-85</td><td>84-80</td><td>79-77</td><td>76-73</td><td>72-70</td><td>69-67</td><td>66-63</td><td>62-60</td><td>59-57</td><td>56-53</td><td>52-50</td>
										</tr><tr><td style='font-weight:bold;border:0px;'>Average need: </td>";
							foreach($avgNeed as $val)
							{
								$possibleAvg=$val-$finalWeight;
								if(($storedNullWeight>=$possibleAvg)&&($possibleAvg>0))
								{
									echo"<td>".(round(($possibleAvg/$storedNullWeight),3)*100)."%</td>";
								}
								else if($possibleAvg<=0)
								{
									echo"<td><img src='../images/pass.png' alt='checkmark' height='30' width='50px'></td>";
								}
								else{
									echo "<td><img src='../images/x.png' alt='checkmark' height='30' width='50px'></td>";
								}
								
							}
							echo "</tr></table><br><br>";
							echo "<div class='bxFinalWeight'>Total is: ".$finalWeight."%</div>";
								
							
						}
							else
							{
								echo
								"<style>.courseRightBx{height:500px;}.courseListBx{height:530px;}</style>
								<table class='ffWeight'>
									<tr>
										<td style='font-weight:bold;border:0px;'>Grade: </td><td>A+</td><td>A</td><td>A-</td><td>B+</td><td>B</td><td>B-</td><td>C+</td><td>C</td><td>C-</td><td>D+</td><td>D</td><td>D-</td>
									</tr>
									<tr>
										<td style='font-weight:bold;border:0px;'>Percentages: </td><td>100-90</td><td>89-85</td><td>84-80</td><td>79-77</td><td>76-73</td><td>72-70</td><td>69-67</td><td>66-63</td><td>62-60</td><td>59-57</td><td>56-53</td><td>52-50</td>
									</tr>
								</table><br><br>";
							
								if ($finalWeight>=90)
									echo "<div class='bxFinalWeight'>Grade is: A+<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=85)
									echo "<div class='bxFinalWeight'>Grade is: A <br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=80)
									echo "<div class='bxFinalWeight'>Grade is: A-<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=77)
									echo "<div class='bxFinalWeight'>Grade is: B+<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=73)
									echo "<div class='bxFinalWeight'>Grade is: B <br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=70)
									echo "<div class='bxFinalWeight'>Grade is: B-<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=67&&69<=$finalWeight)
									echo "<div class='bxFinalWeight'>Grade is: C+<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=63&&66<=$finalWeight)
									echo "<div class='bxFinalWeight'>Grade is: C <br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=60&&62<=$finalWeight)
									echo "<div class='bxFinalWeight'>Grade is: C-<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=57&&59<=$finalWeight)
									echo "<div class='bxFinalWeight'>Grade is: D+<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=53&&56<=$finalWeight)
									echo "<div class='bxFinalWeight'>Grade is: D<br>Total is: ".$finalWeight."%</div>";
								else if ($finalWeight>=50&&52<=$finalWeight)
									echo "<div class='bxFinalWeight'>Grade is: D-<br>Total is: ".$finalWeight."%</div>";
								else 
									echo "<div class='bxFinalWeight'>Grade is: F <br>Total is: ".$finalWeight."%</div>";
								
							}
						
					}
					else
						echo "<style>vertial-align:bottom;</style> Total % Weight Towards Final Grade must equal to 100% for correct calculation!";
		}
		/////////
		
		//Gives checkmark if desired mark has been achieved
		function checkmark($goal,$achieved)
		{
			if($goal!==null&&$achieved!==null)
			{
				if($goal <= $achieved)
				{
					return "<img src='../images/checkmark.png' alt='checkmark' height='15' width='10'>";
				}
				else return "&nbsp;&nbsp;";
			}
			else return "&nbsp;&nbsp;";
		}
				

				
?>
<!DOCTYPE HTML> 
<html lang="en">
<head>
	<title>Grades</title>
	<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
	<link href="../stylesheet/courseGrade.css" rel="stylesheet" type="text/css"/>
	<link href="../stylesheet/courseOption.css" type="text/css" rel="stylesheet"/>
</head>
<body>
	<?php
	include "../template/template.php";
	include "../template/templateNav.php";
	?>
	
	<div class="wrapper">
		<div class="content">
			<div class="courseListBx">
				<div class="courseHead">
				<h1><?php echo $course_name;?></h1>
				</div> 	
				<div class="CourseTable">
					<ul>
						<li><a href="">Grade</a></li>
						
						<li><a href="archiveTeacher.php">Teacher Rating</a></li>
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
				<h1>Archive Grade(<?php echo $course_name;?>)</h1>
				<!--Grade Table-->
				<form method="post">
				<table class="GradedMaterialsTable">
					<tr>
						<th>Grade Materials</th>
						<th>Desired Marks</th>
						<th>Marks Achieved</th>
						<th>%Weight on Final Grade</th>
					</tr>
					<?php
						for($i=0; $i<6;$i++)
						{	
							echo "<tr>";
							echo "<td>".$array[$i]."</td>";
							echo "<td style='text-align:center;'><input name='inputGoals".$i."' class='txtbxGrade' min='0' max='100' type='number' value='".$array3[$i]."'/>% ".checkmark($array3[$i],$array2[$i])."</td>";
							echo "<td style='text-align:center;'><input name='inputAchieved".$i."' class='txtbxGrade' min='0' max='100' type='number' value='".$array2[$i]."'/>%</td>";
							echo "<td style='text-align:center;'><input name='inputFinal".$i."' class='txtbxGrade' min='0' max='100'  size ='100' type='number' value='".$array4[$i]."'/></td>";
							echo "</tr>";	
						}
					?>
				</table>
				<?php 
					if ($clickCalc) calculateGrade();
						echo "<input type='submit' value='Calculate your grade!' name='btnCalc' class='btnCalc'/>";
						?>
				
				
				</form>
				
			</div>
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>
</body>
</html>
