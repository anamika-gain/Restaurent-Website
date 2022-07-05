<?php


if (isset($_REQUEST['clientMobile'])) {
    $clientMobile = $_GET['clientMobile'];
    echo "<script>window.location.href = 'erp/set_cookie_client.php?clientId=" . $clientMobile . "&&returnUrl=../my-order.php';</script>";
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
//pageViewIncrement('home');
if (!isset($_COOKIE['client_id'])) {
    echo "<script>window.location.href = 'register.php';</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <title>My Order Page</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/jquery-ui.css" rel="stylesheet">

    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.min.css" rel="stylesheet">


    <!-- Main css -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        thead,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-hourglass"></div>
    </div>
    <!-- /Preloader -->

    <div class="global-cart-btn">
        <a href="#" class="cart-button"><i class="fa fa-shopping-cart"></i><span id="totalCartProductsView"><?php echo totalCartProduct(); ?></span></a>
    </div>

    <!--Header Area-->
    <?php require 'web-includes/navigation.php'; ?>
    <!--/Header Area-->

    <!--Custom Banner-->
    <div class="custom-banner leaf flower">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </div>
    <!--/Custom Banner-->

    <!--My Order area-->
    <section class="section-padding leaf-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="userpanel-menu">
                        <ul>
                            <li class="active"><a href="">Orders</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                    <div class="cart-items table-responsive">
                        <table class="table centered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Order Details</th>
                                    <!-- <th scope="col">Date</th> -->
                                    <!-- <th scope="col">Total</th> -->
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $orderDetails = getAllDataOfOrderProcessTable(" AND client_id = " . $_COOKIE['client_id'] . " ORDER BY id DESC");

                                foreach ($orderDetails as $key => $value) {
                                ?>

                                    <tr>
                                        <td>
                                            ID:
                                            <?php
                                            if ($orderDetails[$key]['table_id'] > 0) {
                                                echo $tableId = "#T"  . $orderDetails[$key]['id'] . "-" . $orderDetails[$key]['table_id'];
                                            } else {
                                                echo $tableId = "#O" . $orderDetails[$key]['id'];
                                            }
                                            ?>
                                            <hr>
                                            Date: <?php echo $orderDetails[$key]['order_time']; ?>
                                            <hr>
                                            Total Bill: <?php echo "৳" . $orderDetails[$key]['total_bill']; ?>
                                            <hr>
                                            Total Items: <?php echo $orderDetails[$key]['total_items']; ?>


                                        </td>
                                        <!-- <td><?php echo str_replace(' ', '<br />', $orderDetails[$key]['order_time']); ?></td> -->
                                        <!-- <td><?php echo "৳" . $orderDetails[$key]['total_bill']; ?> <br> <?php echo $orderDetails[$key]['total_items']; ?> Items</td> -->
                                        <td><a href="order-tracking.php?orderId=<?php echo $orderDetails[$key]['unique_order_id']; ?>" class="bttn-small btn-fill">View</a></td>
                                    </tr>


                                <?php
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/My Order area-->

    <!--Card Sidebar-->
    <aside id="sidebar-cart">
        <main>
            <a href="#" class="close-button"><span class="close-icon">X</span></a>
            <span id="miniCartDetails">
                <?php require "web-includes/cart.php"; ?>
            </span>
            <div class="action-buttons centered">
                <a class="bttn-mid btn-fill" href="cart.php">Cart</a>
                <a class="bttn-mid btn-fill" href="checkout.php">Checkout</a>
            </div>
            <div class="text-center" style="bottom: 10px; width: 100%; border: 2px solid #FFA259;">
                <span>**Price Includes <?php echo getValueFromExtraTableByItemName('service_charge');?>% Service Charge & <?php echo getValueFromExtraTableByItemName('VAT');?>% VAT</span>
            </div>
        </main>
    </aside>
    <div id="sidebar-cart-curtain"></div>
    <!--/Card Sidebar-->


    <?php require 'web-includes/footer.php'; ?>

</body>

</html>