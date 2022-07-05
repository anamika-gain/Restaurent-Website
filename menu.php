<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
pageViewIncrement('menu');
$tableIdS = 0;
if (isset($_GET['tableId'])) {
    $_SESSION['tableId'] = $_GET['tableId'];
    $tableIdS = $_GET['tableId'];
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

    <title>Kona Restaurant</title>

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
        body{
            text-align: center;
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
    <?php
    $branchId = 1;
    $subBranchId = 1;
    ?>


    <!--Food Items Area-->
    <section class="section-padding leaf-bottom">
        <div class="container">
            <h6>You Are Ordering <?php if (isset($_SESSION['tableId'])) echo "From Table No: " . $_SESSION['tableId'];
                                    else echo "Online"; ?></h6><br><br>
            <div class="row">
                <div class="col-xl-12">
                    <div class="cat-mainmenu">
                        <ul>
                            <li class="<?php if (!isset($_GET['categoryId'])) {
                                            echo 'active arrow_box';
                                        } ?>">
                                <a href="menu.php">All Categories</a>
                            </li>

                            <?php
                            $productCategory = getAllDataOfProductCategoryTableForWebsite($branchId, $subBranchId, "");
                            $categoryFound = 0;
                            if (isset($_GET['categoryId']) && $_GET['categoryId'] > 0) {
                                $categoryFound = $_GET['categoryId'];
                            }


                            foreach ($productCategory as $productCategoryKey => $value) {
                                $hrefValue = "menu.php?categoryId=" . $productCategory[$productCategoryKey]['id'];
                            ?>
                                <li class="<?php if (isset($_GET['categoryId']) && $_GET['categoryId'] == $productCategory[$productCategoryKey]['id']) {
                                                echo 'active arrow_box';
                                            } ?>">
                                    <a href="<?php echo $hrefValue; ?>"><?php echo $productCategory[$productCategoryKey]['name']; ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <hr>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel">
                            <?php
                            if ($categoryFound > 0) {
                            ?>
                                <div class="row mb-40">
                                    <div class="col">
                                        <div class="cat-submenu">
                                            <ul>
                                                <li <?php if (!isset($_GET['subCategoryId'])) {
                                                        echo 'class="active"';
                                                    } ?>><a href='<?php echo "menu.php?categoryId=" . $categoryFound; ?>'>All</a></li>
                                                <?php
                                                $productSubCategory = getAllDataOfProductSubCategoryTableForWebsite($branchId, $categoryFound, "");
                                                $subCategoryFound = 0;
                                                if (isset($_GET['subCategoryId']) && $_GET['subCategoryId'] > 0) {
                                                    $subCategoryFound = $_GET['subCategoryId'];
                                                }


                                                foreach ($productSubCategory as $productSubCategoryKey => $value) {
                                                    $hrefValue = "menu.php?categoryId=" . $categoryFound . "&&subCategoryId=" . $productSubCategory[$productSubCategoryKey]['id'];
                                                    //if($productSubCategory[$productSubCategoryKey]['id'] != '17' && $tableIdS != '0'){
                                                ?>
                                                    <li <?php if (isset($_GET['subCategoryId']) && $_GET['subCategoryId'] == $productSubCategory[$productSubCategoryKey]['id']) {
                                                            echo 'class="active"';
                                                        } ?>>
                                                        <a href="<?php echo $hrefValue; ?>"><?php echo $productSubCategory[$productSubCategoryKey]['name']; ?></a>
                                                    </li>
                                                <?php
                                                    //}
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <hr>
                            <div class="row">
                                <?php

                                function mdiff($date1, $date2)
                                {
                                    //Absolute val of Date 1 in seconds from  (EPOCH Time) - Date 2 in seconds from (EPOCH Time)
                                    $diff = abs(strtotime($date1->format('d-m-Y H:i:s.u')) - strtotime($date2->format('d-m-Y H:i:s.u')));

                                    //Creates variables for the microseconds of date1 and date2
                                    $micro1 = $date1->format("u");
                                    $micro2 = $date2->format("u");

                                    //Absolute difference between these micro seconds:
                                    $micro = abs($micro1 - $micro2);

                                    //Creates the variable that will hold the seconds (?):
                                    $difference = $diff . "." . $micro;

                                    return $difference;
                                }
                                $date1 = new DateTime("now");

                                if (isset($_GET['categoryId']) && $_GET['categoryId'] > 0 && !isset($_GET['subCategoryId'])) {
                                    $productDetails = getAllDataOfProductTableForWebsiteView($branchId, $subBranchId, " AND category_id=" . $_GET['categoryId']);
                                } elseif (isset($_GET['categoryId']) && $_GET['categoryId'] > 0 && isset($_GET['subCategoryId']) && $_GET['subCategoryId'] > 0) {
                                    $productDetails = getAllDataOfProductTableForWebsiteView($branchId, $subBranchId, " AND category_id='" . $_GET['categoryId'] . "' AND sub_category_id='" . $_GET['subCategoryId'] . "'");
                                } else {
                                    $productDetails = getAllDataOfProductTableForWebsiteView($branchId, $subBranchId, "");
                                }

                                foreach ($productDetails as $key => $value) {

                                ?>
                                    <a href="product-details.php?productId=<?php echo $productDetails[$key]['id']; ?>">
                                        <div class="col-6 col-md-3">
                                            <div class="food-item-card">
                                                <div class="item-img">
                                                    <img src="erp/images/<?php echo $productDetails[$key]['photo']; ?>" alt="<?php echo $productDetails[$key]['name']; ?>">
                                                </div>
                                                <div class="item-title">
                                                    <h4 class="<?php //if (strlen($productDetails[$key]['name']) > 15) echo "manq"; ?>"><a href="product-details.php?productId=<?php echo $productDetails[$key]['id']; ?>"><?php echo $productDetails[$key]['name']; ?></a></h4>
                                                </div>
                                                <div class="item-description">
                                                    <!-- <p>
                                                        <?php $small = substr($productDetails[$key]['description'], 0, 75);
                                                        echo $small . "...."; ?>
                                                    </p> -->
                                                </div>
                                                <div class="item-meta">
                                                    <div class="price">
                                                        ৳<?php echo getStartingPriceFromProductId($productDetails[$key]['id']); ?>
                                                    </div>
                                                </div>
                                                <div class="item-meta">
                                                    <?php
                                                    if (checkIfAProductGotSizesAndOptions($productDetails[$key]['id'])) {
                                                    ?>

                                                        <div class="button">
                                                            <button class="bttn-small btn-fill" onclick="addToCart('<?php echo $productDetails[$key]['id']; ?>')">Add To Cart</button>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="button">
                                                            <a href="product-details.php?productId=<?php echo $productDetails[$key]['id']; ?>" class="bttn-small btn-fill">Order</a>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php

                                }

                                $date2 = new DateTime("now");

                                //echo mdiff($date1, $date2);

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/Food Items Area-->

    <form action="erp/addtocartdirect.php" method="post" id="addToCartDirect">
        <input type="hidden" name="productId" id="ppi" value="0">
    </form>

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

    <script>
        function addToCart(productId) {
            $('#ppi').val(productId);
            $("#addToCartDirect").submit();
        }
    </script>
</body>

</html>