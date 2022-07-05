<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
pageViewIncrement('home');
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <title>Kona Cafe</title>

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

    <!-- Home Popup Section -->
    <div class="modal fade subscribe_popup" id="onload-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                    </button>
                    <div class="row no-gutters">
                        <div class="col-sm-12">
                            <div class="popup_content" style="background: url('assets/images/popup.jpg') no-repeat;">
                                <div class="popup-text">
                                    <h4>Sign Up for our Newsletter to get discounts!</h4>
                                    <p>We’ll be sending you offers and discounts every week</p>
                                </div>
                                <div class="newslatter">
                                    <form action="#">
                                        <input type="email" placeholder="Email Address" required>
                                        <button type="submit">Signup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Screen Load Popup Section -->

    <!--Header Area-->
    <?php require 'web-includes/navigation.php'; ?>
    <!--/Header Area-->

    <!-- Banner Area-->
    <div class="hero owl-carousel leaf gray-bg-2 flower" id="menu">
        <section class="banner-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 order-sm-1 order-2">
                        <div class="banner">
                            <h3>Bursting With Flavour</h3>
                            <p>The finest ingredients from land and sea, serving them up Hawaii-style, as fresh and wholesome bowls.</p>
                            <a href="https://www.konacafebd.com/product-details.php?productId=50" class="bttn-mid btn-fill">Order now</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 order-sm-2 order-1">
                        <div class="banner">
                            <img src="assets/images/food.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 order-sm-1 order-2">
                        <div class="banner">
                            <h3>A Bowl Full <br> Of Love!</h3>
                            <p>The original inspiration for Ahi Poké came following a road trip up the California coast. Traditional forms are aku and heʻe.</p>
                            <a href="https://www.konacafebd.com/product-details.php?productId=52" class="bttn-mid btn-fill">Order now</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 order-sm-2 order-1">
                        <div class="banner">
                            <img src="assets/images/food-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="banner-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6 order-sm-1 order-2">
                        <div class="banner">
                            <h3>Bibimbap<br>The Ultimate Comfort Food !!</h3>
                            <p>More traditional and authentic versions of Bibimbap are made with raw beef and raw egg yolk along with other vegetables. </p>
                            <a href="https://www.konacafebd.com/product-details.php?productId=48" class="bttn-mid btn-fill">Order now</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 order-sm-2 order-1">
                        <div class="banner">
                            <img src="assets/images/food-2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /Banner Area-->

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


    <!-- About Area-->
    <section class="banner-area section-padding gray-bg-2" id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-7 col-md-6">
                    <div class="banner-img">
                        <img src="assets/images/about.png" alt="">
                    </div>
                </div>
                <div class="col-xl-5 col-md-6">
                    <div class="banner">
                        <h3 class="cl-mint">Animal Fries and Hot Dogs: <br>Treat for Everyone</h3>
                        <!--<p>The name "Kona" pays homage to the beans cultivated on the slopes of Hualalai and Mauna Loa volcanoes in the Kona districts of Hawaii. This hightly prized coffee beans are mixed with Guatamelan Antigua beans to create a custom-->
                        <!--    blend that is full-bodies in flavor, and has a rich, pleasing aroma.</p>-->
                        <p>Whether it’s Crunchy or Spicy, there’s a choice for everyone. Our tasty fries & inhouse Hawaiian Bun for Hot Dogs make everything better. </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Area-->

    <!-- About Area 2-->
    <section class="banner-area section-padding leaf-left gray-bg-2" id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-md-6 offset-xl-1">
                    <div class="banner">
                        <h3 class="cl-pink">Kona Revives You</h3>
                        <p>Twitch your day with our freshly blended juice or smoothie. Sweet, tangy and fresh, our juice will give you a lift.<br>“The name “Kona” pays homage to the beans cultivated on the slopes of Hualalai and Mauna Loa volcanoes in the Kona districts of Hawaii.”</p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="banner-img">
                        <img src="assets/images/about-2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /About Area 2-->

    <!-- CTA -->
    <!--<section class="section-padding dark-overlay" id="faq" style="background: url('assets/images/cta-bg.jpg') no-repeat center center fixed;">-->
    <!--    <div class="container-fluid">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-xl-10 col-md-12 centered">-->
    <!--                <div class="cta">-->
    <!--                    <h3 class="cl-white">“The name “Kona” pays homage to the beans cultivated on the slopes of Hualalai and Mauna Loa volcanoes in the Kona districts of Hawaii.”</h3>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- /CTA-->

    <!-- About Area-->
    <!--<section class="banner-area section-padding gray-bg-2 leaf">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-6 col-md-6">-->
    <!--                <div class="banner-img">-->
    <!--                    <img src="assets/images/about-3.png" alt="">-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-xl-6 col-md-6">-->
    <!--                <div class="banner">-->
    <!--                    <h3 class="cl-blue">This is just a placehole <br> headline for now</h3>-->
    <!--                    <p>The name "Kona" pays homage to the beans cultivated on the slopes of Hualalai and Mauna Loa volcanoes in the Kona districts of Hawaii. This hightly prized coffee beans are mixed with Guatamelan Antigua beans to create a custom-->
    <!--                        blend that is full-bodies in flavor, and has a rich, pleasing aroma.</p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- /About Area-->

    <!-- Location Area-->
    <section class="banner-area section-padding gray-bg-2" id="location">
        <div class="container mb-60">
            <div class="row">
                <div class="col-xl-5 col-md-6">
                    <div class="banner">
                        <div class="mb-60">
                            <h3>Find Our <br> Shacks</h3>
                        </div>
                        <h4>Open Everyday</h4>
                        <h5>Hotline: +8801300290494</h5>
                        <div class="map-location">
                            <div class="single">
                                <p>
                                    Lakeshore Hotel (Open 24/7) 
                                    <br>
                                    House: 46, Road: 41, Gulshan 2
                                    <br>
                                    Dhaka 1212
                                </p>
                            </div>
                            <div class="single">
                                <p>
                                    Chefs Table Courtside (12.00 - 22.00)
                                    <br>
                                    Madani Ave, Dhaka 1212
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-md-6">
                    <div class="banner-img">
                        <img src="assets/images/about-4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Location Area-->

    <?php require 'web-includes/footer.php'; ?>


</body>

</html>