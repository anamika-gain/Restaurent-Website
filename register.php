<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
//pageViewIncrement('home');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <title>Register</title>

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

    <!--Register-->
    <section class="section-padding leaf-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5 col-12">
                    <form action="erp/login.php" method="post">
                        <div class="checkout-card">
                            <div class="input-text">
                                <label for="fname">Full Name</label>
                                <input type="text" id="clientName" name="clientName" placeholder="Full Name">
                            </div>
                            <div class="input-text">
                                <label for="email">Email Address</label>
                                <input type="text" id="clientEmail" name="clientEmail" placeholder="Email">
                            </div>
                            <div class="input-text">
                                <label for="pnumber">Phone Number</label>
                                <input type="text" id="clientMobile" name="clientMobile" placeholder="Mobile">

                                <input type="hidden" class="input-text" id="clientBranch" name="clientBranch" value="1">
                                <input type="hidden" class="input-text" id="clientSubBranch" name="clientSubBranch" value="1">
                                <input type="hidden" class="input-text" value="register" name="function">
                            </div>
                            <div class="input-text">
                                <label for="date">Date of birth</label>
                                <input type="text" id="datepicker" name="clientDOB" placeholder="Date of birth" required>
                            </div>
                            <div class="input-text">
                                <label for="fname">Client Address</label>
                                <textarea rows="3" id="clientAddress" name="clientAddress" placeholder="Client Address"></textarea>
                            </div>
                            <div class="input-text">
                                <input type="password" id="clientPassword" name="clientPassword" placeholder="Client Password">
                            </div>
                            <div class="input-text">
                                <input type="password" id="retypePassword" name="retypePassword" placeholder="Confirm Client Password">
                            </div>

                            <input type="submit" class="bttn-mid btn-fill w-100" value="Register">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/Register-->

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