<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <title>About</title>

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
                <div class="col-12 text-center" style="">
                    <h1>Kona Café</h1><br><br>
                    <span class="about-us-all">
                    <span style="font-size: xx-large; font-family: 'Playfair Display', serif;">A</span>s the radiant sun prepares to duck behind the isles of Hawaii,
                    we begin brewing your day in a cup of Kona here in Bangladesh.
                    Behind every cup is hours of harvesting one of the most exquisite coffee discovered
                    in the world from the volcanic slopes of Hualalai and Mauna Loa.
                    <br><br>
                    <span style="font-size: xx-large; font-family: 'Playfair Display', serif;">H</span>andpicked from the terrains of sunlit mornings, drizzly afternoons and breezy nights,
                    the beans will sweep you off to a tropical utopia of serene beaches and leisurely
                    moments.
                    Perfectly paired with a refreshing plethora of hearty poke bowl and popping boba
                    varieties, we are here to serve you a big slice of beautiful Hawaii every time you surf
                    into our shacks.
                    <br><br>
                    <span style="font-size: xx-large; font-family: 'Playfair Display', serif;">S</span>ince 2019, KONA Cafe has been a place where you can go for authentic, tropically-inspired cuisines, always cooked from scratch. Over the years, people have come to our patio to enjoy dishes such as Poke Bowl, Bubble tea, Salads, Savory Desserts, Hotdogs, and Sandwiches!
                    So, while KONA Cafe might be known for hearty breakfast, authentic lunch and bountiful dinners, anyone who visits us knows that we're more than that - We're also a place where our community can go to relax and have a great meal. Stop by KONA cafe at Lakeshore Hotel, Gulshan, or at Shatarkul Chef’s Table Courtside and experience the tradition of Hawaiian cuisines for yourself.
                    </span>
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