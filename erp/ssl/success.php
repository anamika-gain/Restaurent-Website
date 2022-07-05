<?php

require '../includes/connect.php';
        
global $con;

$mobileNumber = $_POST['cus_phone'];

$query = $con->query("select * from client WHERE status = 1 AND mobile = '$mobileNumber'");

while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        setcookie("client_id", $row['id'], time() + (86400 * 30 * 12), "/");
        setcookie("client_name", $row['name'], time() + (86400 * 30 * 12), "/");
        setcookie("client_email", $row['email'], time() + (86400 * 30 * 12), "/");
        setcookie("client_mobile", $row['mobile'], time() + (86400 * 30 * 12), "/");
        setcookie("client_dob", $row['dob'], time() + (86400 * 30 * 12), "/");
        setcookie("client_address", $row['address'], time() + (86400 * 30 * 12), "/");

}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "../includes/easyfunctions.php";

if ($_POST['status'] == "VALID") {
    $uniqueOrderId = $_POST['value_a'];
    $paidAmount = $_POST['amount'];

    global $con;

    $sql = "UPDATE `order_process` SET `payment_status` = '1', `paid_amount` = '$paidAmount', `show_notification` = '0', `show_common_notification` = '0', `status` = '1'   WHERE `order_process`.`unique_order_id` = $uniqueOrderId";

    if ($con->query($sql)) {
        $_SESSION['cart'] = array();
        echo "<script>window.location.href = '../../my-order.php?orderId=".$uniqueOrderId."';</script>" ;

    } else {
        $_SESSION['cart'] = array();
        echo "<script>window.location.href = '../../my-order.php?orderId=".$uniqueOrderId."';</script>" ;

    }

}

?>