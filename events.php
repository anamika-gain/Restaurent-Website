<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'erp/includes/easyfunctions.php';
pageViewIncrement('events');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <title>Events - Kona Cafe</title>

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

    <!-- <div class="global-cart-btn">
        <a href="#" class="cart-button"><i class="fa fa-shopping-cart"></i><span id="totalCartProductsView">2</span></a>
    </div> -->

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

    <!--Checkout area-->
    <section class="section-padding gray-bg-2 leaf-bottom text-center" style="align-content: center;">
        <div class="container text-center" style="align-content: center;">

            <?php

            $eventsTable = getAllDataOfEventsTable(" ORDER BY order_by ASC");

            foreach ($eventsTable as $key => $value) {
            ?>

                <iframe sandbox src="<?php echo $eventsTable[$key]['url']; ?>" style="border:1px solid #F88428; margin-bottom: 50px; padding:10px; box-shadow: 0px 0px 8px 0px;" width="90%" height="<?php echo $eventsTable[$key]['height']; ?>"></iframe>

            <?php

            }

            ?>
        </div>
    </section>
    <!--/Checkout area-->


    <?php require 'web-includes/footer.php'; ?>

    <script>
    </script>
</body>

</html>