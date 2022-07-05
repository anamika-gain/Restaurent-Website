<?php



require 'includes/connect.php';

global $con;
$returnUrl = "../menu.php";

$mobileNumber = $_REQUEST['clientId'];




$query = $con->query("select * from client WHERE status = 1 AND mobile = '$mobileNumber'");



while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

    //echo "came";
    //echo $row['id'];

    //setcookie("client_demo", "28", time() + (86400 * 30 * 12), "/");

    setcookie("client_id", $row['id'], time() + (86400 * 30 * 12), "/");
    setcookie("client_name", $row['name'], time() + (86400 * 30 * 12), "/");
    setcookie("client_email", $row['email'], time() + (86400 * 30 * 12), "/");
    setcookie("client_mobile", $row['mobile'], time() + (86400 * 30 * 12), "/");
    setcookie("client_dob", $row['dob'], time() + (86400 * 30 * 12), "/");
    setcookie("client_address", $row['address'], time() + (86400 * 30 * 12), "/");
}



$query2 = $con->query("SELECT * FROM `order_process` WHERE `client_id` = '" . $row['id'] . "' ORDER BY `order_process`.`order_time` DESC LIMIT 1");

while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
    $returnUrl = "../order-tracking.php?orderId=".$row2['unique_order_id'];
}

//var_dump(headers_list());

//print_r($row);

//print_r($_COOKIE);

// if (isset($_REQUEST['returnUrl'])) {
//     $returnUrl = $_REQUEST['returnUrl'];
// }
echo "<script>window.location.href = '" . $returnUrl . "';</script>";
