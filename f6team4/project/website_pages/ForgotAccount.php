<?php
ob_start();
include "../validation/serverTest.php";
$notFound=false;

if(isset ($_COOKIE["nonee"]))
	$notFound=$_COOKIE["nonee"];

if(isset($_POST['value'])) {
	
    if (isset ($_POST['email'])) {
        $email = $_POST['email'];
    }


    $sql = "SELECT id FROM student_infomation WHERE email=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt->bind_result($temp);
    $stmt->fetch();
    $stmt->close();

    if ($temp !== null) {
        $sql = "SELECT username,password FROM student_account WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $temp);
        $stmt->execute();

        $stmt->bind_result($user, $pass);
        $stmt->fetch();
        $stmt->close();


		
		if(isset($user) && isset($pass))
		{
        $msg =
		"Greetings from Student-Go, "
		."<br>"
		."<br>"
		."Your username and password are "
		."<br>"
		."<br>"
		."Username: "."<b>".$user."</b>"
		."<br>"
		."Password: "."<b>".$pass."</b>"
		."<br>"
		."<br>"
		."<b>"."Note"."</b>".": This email was sent from a notification-only e-mail address that cannot accept incoming email. Please do not reply to this message! "
		;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <student-go@mail.com>' . "\r\n";

        mail($email,"Account Recovery",$msg,$headers);
		
		header("Location:../validation/EmailSent.php");
		}
        



    }
	else
	{
		setcookie("nonee",true,time()+10);
		header("Location:ForgotAccount.php");
	}
}


?>

<!DOCTYPE HTML>

<html>
<head>


	<link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
    <link href="../stylesheet/ForgotAccount.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php include "../template/template.php"; ?>

<div class="wrapper">
    <div class="content">
        <div id="Header">
            <h2>Forgot Password / Username?</h2>
        </div>
        <div class="container">
            <div class="col-lg-12 well" style="margin-bottom:0px;">
                <div class="row">
                    <form action="ForgotAccount.php" method="post">
                        <div class="col-sm-12">
							<?php if($notFound) echo"<label>Sorry! We could not find your email. Try again?</label> <br>";?>
                            <label>Please enter your email address, and we'll send your username / password to your email.</label>
                            <div class="row">

                                 <div class="col-sm-6 form-group">

                                        <label><small style="color: red;">*</small> Email Address <small>( max. 300 characters, e.g example@hotmail.com ) </small></label>
                                      <input maxlength="300" type="text" placeholder="Enter Email Address Here.." class="form-control" name="email" required="" oninvalid="this.setCustomValidity('Email is required / invalid !')" oninput="setCustomValidity('')" pattern="[A-Za-z0-9_.-]{1,}@[a-zA-Z]{1,}([.]{1}[a-zA-Z]{2,}|[.]{1}[a-zA-Z]{2,}[.]{1}[a-zA-Z]{2,})">
                                  </div>
                            </div>
                            <button class="btn btn-lg btn-info" type="submit" name="value">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
            <?php include "../template/templateFoot.php"; ?>
    </div>
</div>
</body>
</html>