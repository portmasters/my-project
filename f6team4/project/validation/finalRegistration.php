<?php
ob_start();
session_start();
include "serverTest.php";

//insert into student information table
$sessionID = $_SESSION['accountSession'];
$sessionFN = $_SESSION['userFirstName'];
$sessionLN = $_SESSION['userLastName'];
$sessionEM = $_SESSION['userEmail'];
$sessionPH = $_SESSION['userPhone'];
$sessionCO = $_SESSION['userCountry'];
$sessionCI = $_SESSION['userCity'];
$sessionPS = $_SESSION['userProvinceState'];
$sessionAD = $_SESSION['userAddress'];
$sessionZP = $_SESSION['userZipPostal'];


$sql = "INSERT INTO student_infomation (id,first_name,last_name,email,phone,country,city,stateorprovince,address,postal)
        VALUES (?,?,?,?,?,?,?,?,?,?)
        ";
$stmt=$conn->prepare($sql);
$stmt->bind_param("isssssssss",$sessionID,$sessionFN,$sessionLN,$sessionEM,$sessionPH,$sessionCO,$sessionCI,$sessionPS,$sessionAD,$sessionZP);
$stmt->execute();

unset($_SESSION['accountSession']);
unset($_SESSION['userFirstName']);
unset($_SESSION['userLastName']);
unset($_SESSION['userEmail']);
unset($_SESSION['userPhone']);
unset($_SESSION['userCountry']);
unset($_SESSION['userCity']);
unset($_SESSION['userProvinceState']);
unset($_SESSION['userAddress']);
unset($_SESSION['userZipPostal']);
session_unset();
session_destroy();

header("Location:../website_pages/AccountCreated.php");
?>