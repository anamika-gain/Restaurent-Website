<?php

error_reporting(0);

//for localhost
// $host = "localhost";
// $db_user = "root";
// $db_pass = "";
// $db_name = "restauranterp";


//for kona cafe server
$host = "localhost";
$db_user = "konacafe_erpu";
$db_pass = "konacafe_erpp";
$db_name = "konacafe_erp";


//for beta test
// $host = "localhost";
// $db_user = "konacafe_betaerpu";
// $db_pass = "konacafe_betaerpp";
// $db_name = "konacafe_betaerp";


$con = mysqli_connect($host, $db_user, $db_pass, $db_name);

//$con = new mysqli($hostname, $username, $passward, $db_name);


if (!$con) {
  echo "Database connection failed".mysqli_error($con);

	//header('location: error_db.php');
	//exit;
}



date_default_timezone_set('Asia/Dhaka');
$con->set_charset("utf8");

?>
