<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
if (!isset($_REQUEST['productId'])) {
    echo "<script>window.location.href = 'index.php';</script>";
}
pageViewIncrement($_REQUEST['productId']);
$productDetails = getProductDetailsFromId($_REQUEST['productId']);
$productSizeDetails = getAllDataOfProductSizeTableFromProductId($productDetails['id']);
$productAddonDetails = getAllDataOfProductAddonTableFromProductId($_REQUEST['productId']);
$subCategoryAddonDetails = getAllDataOfSubCategoryAddonTableFromSubCategoryId($productDetails['sub_category_id']);

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


    <style>
        body {
            text-align: center;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Lato', sans-serif;
        }

        h5,
        h6 {
            font-size: small;
        }

        ul {
            list-style-type: none;
        }

        li {
            display: inline-block;
            margin-left: 15px;
            margin-right: 15px;
        }

        input[type="checkbox"] {
            display: none;
            border: 1px solid black;
        }

        input[type="radio"] {
            display: none;
            border: 1px solid black;
        }

        label {
            border: 1px solid #000;
            padding: 10px;
            display: block;
            position: relative;
            margin: 10px;
            cursor: pointer;
            padding-top: 25px;
            padding-bottom: 65px;
        }

        label:before {
            /* background-color: white;
            color: white; */
            content: " ";
            display: block;
            border-radius: 50%;
            border: 1px solid grey;
            position: absolute;
            top: -5px;
            left: -5px;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 28px;
            transition-duration: 0.4s;
            transform: scale(0);
        }

        label img {
            height: 100px;
            width: 100px;
            transition-duration: 0.2s;
            transform-origin: 50% 50%;
        }

        :checked+label {
            border-color: #ddd;
            background: #FF8B2A;
            transition-duration: 0.4s;
        }

        :checked+label:before {
            content: "✓" !important;
            /* background-color: grey; */
            transform: scale(1);
        }

        :checked+label img {
            transform: scale(0.9);
            /* box-shadow: 0 0 5px #333; */
            z-index: -1;
        }

        .customRadio {
            /* height: 185px; */
            padding: 10px;
            margin-left: 5px;
        }

        .customRadio> :first-child {
            margin-left: 0px;
        }

        .optionsHolderDivCatcher {
            /* padding-left: unset; */
            /* margin-left: 5px; */
            font-size: small;
            justify-content: center;


        }

        .col-sm-4 {
            width: unset;
        }

        .productOptionDivFIx {
            justify-content: center;
            margin-right: auto;
        }

        .quantity {
            justify-content: center;
        }

        @media only screen and (max-width: 600px) {
            .customRadio {
                margin-left: 0px;
            }

            .col-sm-4 {
                width: 50% !important;
                margin-left: -7px;
                margin-right: unset;
                /* justify-content: center; */
            }

            .col-md-4 {
                width: 50%;
                justify-content: center;
            }

            #optionHolderDiv,
            .optionTitleDivForCenter {
                justify-content: center;
            }

            .optionsHolderDivCatcher {
                padding-left: unset;
                /* margin-left: 5px; */
                font-size: small;

            }

            .productOptionDivFIx {
                justify-content: center;
                margin-right: auto;
            }

            .quantity {
                justify-content: center;
            }
        }





        /* [type="checkbox"]:checked+label:after {
            background: #FF8B2A;
        } */


        /* -- quantity box -- */

        /* .quantity {
            display: inline-block;
        }

        .quantity .input-text.qty {
            width: 35px;
            height: 39px;
            padding: 0 5px;
            text-align: center;
            background-color: transparent;
            border: 1px solid #efefef;
        }

        .quantity.buttons_added {
            text-align: left;
            position: relative;
            white-space: nowrap;
            vertical-align: top;
        }

        .quantity.buttons_added input {
            display: inline-block;
            margin: 0;
            vertical-align: top;
            box-shadow: none;
        }

        .quantity.buttons_added .minus,
        .quantity.buttons_added .plus {
            padding: 7px 10px 8px;
            height: 41px;
            background-color: #ffffff;
            border: 1px solid #efefef;
            cursor: pointer;
        }

        .quantity.buttons_added .minus {
            border-right: 0;
        }

        .quantity.buttons_added .plus {
            border-left: 0;
        }

        .quantity.buttons_added .minus:hover,
        .quantity.buttons_added .plus:hover {
            background: #eeeeee;
        }

        .quantity input::-webkit-outer-spin-button,
        .quantity input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;
        }

        .quantity.buttons_added .minus:focus,
        .quantity.buttons_added .plus:focus {
            outline: none;
        } */
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


    <!--Single Item-->
    <form action="erp/addtocart.php" method="POST">
        <!-- <form action="erp/test.php" method="POST"> -->
        <input type="hidden" name="productId" value="<?php echo $_REQUEST['productId']; ?>">
        <section class="section-padding leaf-bottom">
            <div class="container">
                <div class="row mb-40">
                    <div class="col-xl-5 col-lg-5 col-md-6">
                        <div class="item-photo">
                            <img src="erp/images/<?php echo $productDetails['photo']; ?>" alt="<?php echo $productDetails['name']; ?>">
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-6">
                        <div class="item-descriptions">
                            <h2><?php echo $productDetails['name']; ?></h2>
                            <p><?php echo $productDetails['description']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 mb-60">
                        <div class="item-option-title">
                            <h2>Size</h2>
                        </div>
                        <span class="item-options">
                            <fieldset class="form-group">
                                <div class="row productOptionDivFIx">

                                    <?php
                                    foreach ($productSizeDetails as $key => $value) {
                                        $productPrice = 0;
                                        $currentDate = date("Y-m-d H:i:s");

                                        if ($productSizeDetails[$key]['special_price_from'] < $currentDate && $productSizeDetails[$key]['special_price_to'] > $currentDate) {
                                            $productPrice = $productSizeDetails[$key]['special_price'];
                                        } else {
                                            $productPrice = $productSizeDetails[$key]['selling_price'];
                                        }
                                    ?>

                                        <div class="col-sm-4">
                                            <div class="form-check" id="productSizeButtons">
                                                <div class="single-item-radio">
                                                    <input class="form-check-input" type="radio" name="productSizeId" id="ps<?php echo $productSizeDetails[$key]['id']; ?>" value="<?php echo $productSizeDetails[$key]['id']; ?>" onchange="getProductOtionDetailsFromSizeId(this.id)">
                                                    <label class="form-check-label" for="ps<?php echo $productSizeDetails[$key]['id']; ?>">
                                                        <strong><?php echo $productSizeDetails[$key]['name']; ?></strong>
                                                        <span>Base Price <span id="psp<?php echo $productSizeDetails[$key]['id']; ?>"><?php echo $productPrice; ?></span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>
                                    <input type="hidden" name="productSizePrice" value="<?php echo $_REQUEST['productId']; ?>" id="productSizePrice">


                                </div>
                            </fieldset>
                        </span>
                    </div>

                    <div class="col-xl-12">
                        <div class="option-holder" id="optionHolder">

                        </div>
                    </div>
                    <br><br>

                    <div class="col-xl-12">
                        <div class="addon-holder">
                            <div class="item-option-title">
                                <h2><?php if (count($subCategoryAddonDetails) > 0) echo "Choose your Addons"; ?></h2>
                            </div>
                            <div class="row text-center" id="optionHolderDiv">
                                <ul class="text-center">
                                    <?php
                                    foreach ($subCategoryAddonDetails as $key => $value) {
                                        $subCategoryAddonPrice = 0;
                                        $currentDate = date("Y-m-d H:i:s");

                                        if ($subCategoryAddonDetails[$key]['offer_money_from'] < $currentDate && $subCategoryAddonDetails[$key]['offer_money_to'] > $currentDate) {
                                            $subCategoryAddonPrice = $subCategoryAddonDetails[$key]['offer_money_added'];
                                        } else {
                                            $subCategoryAddonPrice = $subCategoryAddonDetails[$key]['extra_money_added'];
                                        }

                                    ?>
                                        <li col-sm-4>
                                            <input type="checkbox" id="psca<?php echo $subCategoryAddonDetails[$key]['id']; ?>" value="<?php echo $subCategoryAddonDetails[$key]['id']; ?>" name="subCategoryAddonIds[]">
                                            <label for="psca<?php echo $subCategoryAddonDetails[$key]['id']; ?>" style="padding:10px;">
                                                <img src="erp/images/<?php echo $subCategoryAddonDetails[$key]['image']; ?>">
                                                <h5><?php echo $subCategoryAddonDetails[$key]['name']; ?></h5>
                                                <h6><?php echo "+৳" . $subCategoryAddonPrice; ?></h6>
                                            </label>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div class="col-xl-12">
                        <div class="addon-holder">
                            <div class="item-option-title">
                                <h2><?php if (count($productAddonDetails) > 0) echo "You May Also Add: "; ?></h2>
                            </div>
                            <div class="row text-center">
                                <ul class="text-center">
                                    <?php
                                    foreach ($productAddonDetails as $key => $value) {
                                        $productAddonPrice = 0;
                                        $currentDate = date("Y-m-d H:i:s");

                                        if ($productAddonDetails[$key]['offer_money_from'] < $currentDate && $productAddonDetails[$key]['offer_money_to'] > $currentDate) {
                                            $productAddonPrice = $productAddonDetails[$key]['offer_money_added'];
                                        } else {
                                            $productAddonPrice = $productAddonDetails[$key]['extra_money_added'];
                                        }

                                    ?>
                                        <li>
                                            <input type="checkbox" id="pc<?php echo $productAddonDetails[$key]['id']; ?>" value="<?php echo $productAddonDetails[$key]['id']; ?>" name="productAddonIds[]">
                                            <label for="pc<?php echo $productAddonDetails[$key]['id']; ?>" style="padding:10px;">
                                                <img src="erp/images/<?php echo $productAddonDetails[$key]['image']; ?>">
                                                <h5><?php echo $productAddonDetails[$key]['name']; ?></h5>
                                                <h6><?php echo "+৳" . $productAddonPrice; ?></h6>
                                            </label>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="item-option-title">
                            <h2>Quantity</h2>
                        </div>
                        <div class="quantity">
                            <a href="#" class="quantity__minus"><span>-</span></a>
                            <input name="productQuntity" type="text" class="quantity__input" value="1">
                            <a href="#" class="quantity__plus"><span>+</span></a>
                        </div>
                    </div>
                    <div class="col mt-60">
                        <input type="submit" class="bttn-mid btn-fill" value="Add To Cart" style="visibility: hidden;" id="addToCartButton">
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!--/Single Item-->

    <?php include 'web-includes/footer.php'; ?>

    <script>
        var psi = document.getElementsByName("productSizeId");
        if (psi.length == 1) {
            $("input[name=productSizeId]").prop("checked", true);
            var psiId = $('input[name=productSizeId]').attr('id')
            getProductOtionDetailsFromSizeId(psiId);
        }

        function getProductOtionDetailsFromSizeId(id) {
            $('#addToCartButton').css("visibility", "visible");
            var productSizeId = id.slice(2);
            $('#productSizePrice').val($('#psp' + productSizeId).html());
            $.ajax({
                    method: "post",
                    url: 'erp/ajaxfunctions.php',
                    data: {
                        funName: "getProductOtionDetailsFromSizeId",
                        productSizeId: productSizeId
                    }
                })
                .done(function(response) {

                    //console.log(response);

                    //$('.loader-holder').hide();

                    if (response != null) {

                        $('#optionHolder').html(response);

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }


                });
        }
    </script>
</body>

</html>