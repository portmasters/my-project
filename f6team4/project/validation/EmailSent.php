<?php
ob_start();
include "../validation/serverTest.php";


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



        $msg = "Username:".$user."Password:".$pass;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";

        mail($email,"Account Recover",$msg,$headers);

        



    }

}


?>

<!DOCTYPE HTML>

<html>
<head>

	<title>Email sent</title>
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
                            <label>Your username / password has been sent to your email!</label>
							<label> click <a href="../index.php">here</a> to go back.</label>
                            <div class="row">

     
                            </div>
                           
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