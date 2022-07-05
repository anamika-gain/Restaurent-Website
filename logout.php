<?php
session_start();
date_default_timezone_set('Asia/Dhaka');

setcookie("client_id","",1,'/');
setcookie("client_name","",1,'/');
setcookie("client_email","",1,'/');
setcookie("client_mobile","",1,'/');
setcookie("client_dob","",1,'/');
setcookie("client_address","",1,'/');
unset($_COOKIE["client_id"]);
unset($_COOKIE["client_name"]);
unset($_COOKIE["client_email"]);
unset($_COOKIE["client_mobile"]);
unset($_COOKIE["client_dob"]);
unset($_COOKIE["client_address"]);


//print_r($_COOKIE);
echo "<script>window.location.href = 'index.php';</script>";
?>
