<?php 	
	ob_start();
	session_start();
	include "../validation/serverTest.php";
	
	if (!isset($_SESSION["username"]))
		header("Location:../index.php");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!-- Form Handling -->
    <?php
	
	//collects user info and change information of user
	$accountAltered = 0;
    if(isset($_POST['value']))
    {
				$passwordChanged= false;
				
				if (isset($_POST['password']))
					$password = trim($_POST['password']);
				else
					$password="";
				
				if (isset($_POST['confirm_password'])) 
					$confirm_password = trim($_POST['confirm_password']);
				else
					$confirm_password="";

                if (isset ($_POST['email'])) 
                    $email = $_POST['email'];
				else
					$email="";
				
                if (isset ($_POST['phone'])) 
                    $phone = $_POST['phone']; 
				else
					$phone="";
				
				
				if($password!=="")
				{
					if($password==$confirm_password)
					{
					$sql = "UPDATE student_account
							SET password=? where id=?";
					$result = $conn->prepare($sql);
					$result->bind_param("si",$password,$_SESSION['student_id']);
					$result->execute();
					$passwordChanged = true;
					}
					else
					{
						header("Location:AccountChangeBootStrap.php");
						exit();
					}
				}
				if($email!=="")
				{
					$sql = "UPDATE student_infomation
							SET email=? where id=?";
					$result = $conn->prepare($sql);
					$result->bind_param("si",$email,$_SESSION['student_id']);
					$result->execute();
				}			
				if($phone!=="")
				{
					$sql = "UPDATE student_infomation
							SET phone=? where id=?";
					$result = $conn->prepare($sql);
					$result->bind_param("si",$phone,$_SESSION['student_id']);
					$result->execute();
				}
				
				if($phone===""&&$email===""&&$password==="")
				{
					$accountAltered = 2;
				}
				else if($passwordChanged)
					header("Location:AccountChanged.php");
				else
					{
						$accountAltered=1;
					}          
    }
	//
    ?>
	
		<title>Account Setting</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<link href="../stylesheet/registrationBootstrap.css" rel="stylesheet" type="text/css">
		<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>

<?php
include "../template/template.php";
include "../template/templateNav.php";
?>
	
<div style="padding-top:15px;" class="wrapper">
    <div  class="content">
        <div  id="registrationHeader">
            <h1><?php if($accountAltered==1)echo "Account Altered!";if($accountAltered==2)echo "Account Unchanged!"; else echo "Account Info Edit";?></h1>
        </div>
        <div class="container">
            <div class="col-lg-12 well" style="margin-bottom:0px;">
                <div class="row">	
                    <form action="AccountChangeBootStrap.php" method="post" onsubmit="jsTest()">
                        <div class="col-sm-12">
                            <div class="row">							
	                           <div class="col-sm-6 form-group">
                                    <label> Password <small style="color: black;">( max. 16 characters, cannot contain special character  (e.g. !, @, #, $ etc.)) </small></label>
                                    <input maxlength="16" type="password" placeholder="Enter password.." class="form-control" name="password" id="password" oninvalid="this.setCustomValidity('Password is invalid !')" oninput="setCustomValidity('')" pattern="^[a-zA-Z0-9]{1,16}$">
                                </div>  
                                <div class="col-sm-6 form-group">
                                    <label>Confirm password</label>
                                    <input maxlength="16" type="password" placeholder="Confirm password.." class="form-control" id="confirm_password" name="confirm_password" oninvalid="this.setCustomValidity('Confirm password is invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_]{1,16}">
                                </div>

                            </div>
                            <div class="form-group">
                                <label> Email Address <small>( max. 300 characters, e.g example@hotmail.com ) </small></label>
                                <input maxlength="300" type="text" placeholder="Enter Email Address Here.." class="form-control" name="email" oninvalid="this.setCustomValidity('Email is invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_.-]{1,}@[a-zA-Z]{1,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})">
                            </div>
                            <div class="form-group">
                                <label> Phone Number <small>( e.g 416XXXXXXX ) </small></label>
                                <input maxlength="10" type="text" placeholder="Enter Phone Number Here.." class="form-control" name="phone" oninvalid="this.setCustomValidity('Phone number is required / invalid !')" oninput="setCustomValidity('')" pattern="[0-9]{10,10}">
                            </div>		
                            <button class="btn btn-lg btn-info" type="submit" name="value">Change Account Setting</button>		
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
			//display alert if password does not match
            var username;

            function jsTest()
            {
               password = document.getElementById("password").value;
               confirm_password = document.getElementById("confirm_password").value;

               if(password != confirm_password)
               {
                   alert("Password does not match");
               }
            }
        </script>
    </div>
    <?php include '../template/templateFoot.php'?>
</div>


</body>
</html>
