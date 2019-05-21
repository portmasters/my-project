<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Account Created</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link href="../stylesheet/registrationBootstrap.css" rel="stylesheet" type="text/css">
	<link href="../stylesheet/templateStyleSheet.css" rel="stylesheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
</head>
<body style="padding-top: 0px;">
	<?php
		include "../template/template.php";
	?>
	<div class="wrapper">
		<div class="content">
			<div id="registrationHeader">
				<h1 style="text-align: center;">Congratulations!</h1>
			</div>
			<div class="container">
				<div class="col-lg-12 well" style="margin-bottom:0px;">
					<h3 style="text-align:center;">Your account has been created</h3 >
					<label style="text-align: center; display:block;">Click here to <a href="../index.php">log in!</a></label>
				</div>
			</div>
		</div>
		<?php include '../template/templateFoot.php'?>
	</div>

</body>
</html>
