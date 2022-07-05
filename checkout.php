<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'erp/includes/easyfunctions.php';
pageViewIncrement('checkout');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <title>Checkout - Kona Cafe</title>

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
    <section class="section-padding gray-bg-2 leaf-bottom">
        <div class="container">


            <?php

            if (!isset($_SESSION['tableId'])) {
                $tableId = 0;
                $deliveryCharge = getValueFromExtraTableByItemName("delivery_charge");
            } else {
                $tableId = $_SESSION['tableId'];
                $deliveryCharge = 0;
            }


            if (!isset($_COOKIE['client_id'])) {
                $showValues = false;
            ?>
                <form action="erp/login.php" method="POST">
                    <input type="hidden" name="function" value="felogin">
                    <input type="hidden" name="returnUrl" value="../checkout.php">
                    <div class="row mb-40">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="coupon-accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <i class="fa fa-file-o"></i> Already Registered?
                                            <a href="" class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Sign in
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <span>If you have an account before, please sign in below.</span>
                                                <form action="#">
                                                    <input name="mobileNumber" type="text" placeholder="Mobile Number">
                                                    <input name="password" type="password" placeholder="Password">
                                                    <button type="submit" class="bttn-small btn-fill">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            } else {
                $showValues = true;
            }
            ?>

            <form action="erp/saveOrder.php" method="post" id="clintDataForm">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="checkout-card">
                            <div class="input-text">
                                <label for="fname">Full Name</label>
                                <input type="text" id="clientName" name="clientName" placeholder="Full Name" value="<?php if ($showValues) {
                                                                                                                        echo $_COOKIE['client_name'];
                                                                                                                    } ?>">
                            </div>
                            <div class="input-text">
                                <label for="email">Email Address</label>
                                <input type="text" id="clientEmail" name="clientEmail" placeholder="Email" value="<?php if ($showValues) {
                                                                                                                        echo $_COOKIE['client_email'];
                                                                                                                    } ?>">
                            </div>
                            <div class="input-text">
                                <label for="pnumber">Phone Number</label>
                                <input type="text" id="clientMobile" name="clientMobile" placeholder="Mobile" value="<?php if ($showValues) {
                                                                                                                            echo $_COOKIE['client_mobile'];
                                                                                                                        } ?>">

                                <input type="hidden" class="input-text" id="clientBranch" name="clientBranch" value="1">
                                <input type="hidden" class="input-text" id="clientSubBranch" name="clientSubBranch" value="1">
                                <!-- <input type="hidden" class="input-text" id="clientDOB" name="clientDOB"> -->
                                <input type="hidden" class="input-text" id="clientPaymentMethod" name="clientPaymentMethod">
                                <input type="hidden" class="input-text" value="perfectOrder" name="funName">
                                <input type="hidden" class="input-text" value="<?php echo $deliveryCharge; ?>" name="deliveryCharge" id="deliveryCharge">
                                <input type="hidden" class="input-text" value="<?php echo $tableId; ?>" name="tableId" id="tableId">
                                <input type="hidden" class="input-text" id="clientId" value="<?php if ($showValues) {
                                                                                                    echo $_COOKIE['client_id'];
                                                                                                } else {
                                                                                                    echo "0";
                                                                                                } ?>" name="clientId">
                            </div>
                            <div class="input-text">
                                <label for="date">Date of birth</label>
                                <input type="text" id="datepicker" name="clientDOB" placeholder="Date of birth" required value="<?php if ($showValues) {
                                                                                                                                    echo $_COOKIE['client_dob'];
                                                                                                                                } ?>">
                            </div>
                            <div class="input-text">
                                <label for="fname">Billing Address</label>
                                <textarea rows="3" id="clientAddress" name="clientAddress" placeholder="Client Address"><?php if ($showValues) {
                                                                                                                            echo $_COOKIE['client_address'];
                                                                                                                        } ?></textarea>
                            </div>
                            <?php
                            if ($tableId == 0) {
                            ?>
                                <div class="checkout-checkbox">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="sameAddress" onclick="sameAddressFun();">
                                        <label class="form-check-label" for="sameAddress">Check if same</label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="input-text">
                                <label for="clientDeliveryAddress">Delivery Address</label>
                                <textarea rows="3" id="clientDeliveryAddress" name="clientDeliveryAddress" placeholder="Delivery Address"></textarea>
                            </div>
                            <div class="input-text">
                                <label for="orderRemarks">Remarks</label>
                                <textarea rows="3" id="orderRemarks" name="orderRemarks" placeholder="Any Extra Requirements.">No Extra Requirements</textarea>
                            </div>
                            <?php
                            if ($showValues == false) {
                            ?>
                                <div class="input-text">
                                    <input type="password" id="clientPassword" name="clientPassword" placeholder="Client Password">
                                </div>
                                <div class="input-text">
                                    <input type="password" id="retypePassword" name="retypePassword" placeholder="Confirm Client Password">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="checkout-card">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Your order</h4>
                                </div>
                                <div class="card-body">
                                    <div class="single-checkout-total">
                                        <p class="checkout-amount">Product</p>
                                        <p class="checkout-amount">Subtotal</p>
                                    </div>
                                    <?php
                                    $i = 1;
                                    $cartDetails = $_SESSION['cart'];
                                    $totalPrice = 0;
                                    foreach ($cartDetails as $key => $value) {


                                    ?>
                                        <div class="single-checkout-total">
                                            <p>
                                                <b><?php echo $cartDetails[$key]['product_name']; ?> × <?php echo $cartDetails[$key]['quantity']; ?></b>
                                                <br>
                                                Size: <?php echo $cartDetails[$key]['product_size_name']; ?>
                                                <br>
                                                Options:
                                                <?php
                                                $productOptions = $cartDetails[$key]['product_option_ids'];
                                                if (count($productOptions) == 0) {
                                                    echo "N/A";
                                                } else {
                                                    $c = 1;
                                                    foreach ($productOptions as $productOptionsIndex => $value) {
                                                        $productOptionName = getDetailsOfProductOptionTableFromId($productOptions[$productOptionsIndex]);
                                                        if ($c == 1) {
                                                            echo $productOptionName['name'];
                                                        } else {
                                                            echo " , " . $productOptionName['name'];
                                                        }
                                                        $c++;
                                                    }
                                                }
                                                ?>
                                                <br>
                                                Addons:
                                                <?php
                                                $productAddons = $cartDetails[$key]['product_addon_ids'];
                                                $subCategoryAddons = $cartDetails[$key]['sub_category_addon_ids'];

                                                if (count($productAddons) == 0 && count($subCategoryAddons) == 0) {
                                                    echo "N/A";
                                                } else {
                                                    foreach ($productAddons as $productAddonsIndex => $value) {
                                                        $productAddonName = getProductAddonDetailsFromAddonId($productAddons[$productAddonsIndex]);
                                                        if (current($productAddons) == end($productAddons)) {
                                                            echo $productAddonName['name'];
                                                        } else {
                                                            echo $productAddonName['name'] . " , ";
                                                        }
                                                    }

                                                    if (count($productAddons) > 0) {
                                                        echo ", ";
                                                    }

                                                    foreach ($subCategoryAddons as $subCategoryAddonsIndex => $value) {
                                                        $subCategoryAddonName = getSubCategoryAddonDetailsFromSubCategoryAddonId($subCategoryAddons[$subCategoryAddonsIndex]);
                                                        if (current($subCategoryAddons) == end($subCategoryAddons)) {
                                                            echo $subCategoryAddonName['name'];
                                                        } else {
                                                            echo $subCategoryAddonName['name'] . " , ";
                                                        }
                                                    }
                                                }
                                                ?>
                                            </p>
                                            <p class="checkout-amount">৳<?php echo $cartDetails[$key]['product_price']; ?></p>
                                        </div>
                                    <?php
                                        $i++;
                                        $totalPrice = $totalPrice + $cartDetails[$key]['product_price'];
                                    } ?>
                                    <div class="single-checkout-total">
                                        <p class="checkout-amount">Total</p>
                                        <p class="checkout-amount">৳<?php echo $totalPrice; ?></p>
                                    </div>
                                    <!-- <div class="single-checkout-total">
                                        <p class="checkout-amount">Service Charge</p>
                                        <?php $serviceChargePercent = (float)getValueFromExtraTableByItemName('service_charge'); ?>
                                        <h4 class="checkout-amount">৳<?php echo $totalServiceCharge =  totalServiceCharge($totalPrice, $serviceChargePercent); ?></h4>
                                    </div>
                                    <div class="single-checkout-total">
                                        <p class="checkout-amount">VAT</p>
                                        <?php $vatPercent = (float)getValueFromExtraTableByItemName('VAT'); ?>
                                        <h4 class="checkout-amount">৳<?php
                                                                        $beforTax = $totalPrice + $totalServiceCharge;
                                                                        echo totalTax($beforTax, $vatPercent);
                                                                        ?></h4>
                                    </div>
                                    <div class="single-checkout-total">
                                        <p class="checkout-amount">Delivery Charge</p>
                                        <h4 class="checkout-amount">৳<?php
                                                                        echo $deliveryCharge;
                                                                        ?></h4>
                                    </div>
                                    <div class="single-checkout-total">
                                        <p class="checkout-amount">Total</p>
                                        <h4 class="checkout-amount cl-primary">৳<?php echo grandTotalFromBasicAmount($totalPrice, $serviceChargePercent, $vatPercent) + $deliveryCharge . "/-"; ?></h4>
                                    </div> -->


                                    <br><br>
                                    <div class="checkout-checkbox">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="termAndCondition" onclick="termsAndConditions();">
                                            <label class="form-check-label" for="termAndCondition">Accept Our Terms & Condition (<a href="">View</a>)</label>
                                        </div>
                                    </div>

                                    <div style="visibility: hidden;" id="paymentDiv">
                                        <div class="payment-options">

                                            <ul class="row">
                                                <?php
                                                $paymentMethods = getAllDataOfPaymentMethodTable(" AND show_in_website = 1 ORDER BY id DESC");
                                                //print_r()
                                                foreach ($paymentMethods as $key => $value) {
                                                ?>
                                                    <li class="col-xl-6 col-md-12">
                                                        <input type="radio" id="paymentId<?php echo $paymentMethods[$key]['id']; ?>" name="paymentMethod" value="<?php echo $paymentMethods[$key]['id']; ?>" onclick="paymentMethodSelected();">
                                                        <label for="paymentId<?php echo $paymentMethods[$key]['id']; ?>"><?php echo $paymentMethods[$key]['name']; ?></label>
                                                        <div class="payment-option-text">
                                                            <?php echo $paymentMethods[$key]['description']; ?>
                                                        </div>
                                                    </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="button" class="bttn-mid btn-fill w-100 centered" style="visibility: hidden; z-index: 1112;" id="payOnlieButton" onclick="nextStep()">Continue to Payment</button>
                                    <button type="button" class="bttn-mid btn-fill w-100 centered" style="visibility: hidden; z-index: 1112;" id="cashOnDeliveryButton" onclick="nextStep()">Confirm Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/Checkout area-->

    <!--Card Sidebar-->

    <!--/Card Sidebar-->


    <?php require 'web-includes/footer.php'; ?>

    <script>
        var tableId = <?php echo $tableId; ?>;

        if (tableId > 0) {
            $('#clientDeliveryAddress').val("Food To Be Delivered To Table No " + tableId);
            $('#clientDeliveryAddress').prop('readonly', true);
        }

        function sameAddressFun() {
            if ($('#sameAddress').is(":checked")) {
                //alert("checked!");
                $("#clientDeliveryAddress").val($("#clientAddress").val());

            }
        }


        function termsAndConditions(){
            if($('#termAndCondition').is(':checked')){
                $('#paymentDiv').css("visibility", "visible");
            }else{
                $('#paymentDiv').css("visibility", "hidden");
            }
        }

        function paymentMethodSelected() {

            var clientId = $('#clientId').val();
            var clientName = $('#clientName').val();
            var clientEmail = $('#clientEmail').val();
            var clientMobile = $('#clientMobile').val();
            var clientDOB = $('#datepicker').val();
            //var clientDOB = $('#clientDate').val() + "-" + $('#clientMonth').val();
            var clientAddress = $('#clientAddress').val();
            var clientDeliveryAddress = $('#clientDeliveryAddress').val();
            var clientPassword = $('#clientPassword').val();
            var retypePassword = $('#retypePassword').val();
            //$('#clientDOB').val(clientDOB);

            //alert(clientName+"  "+clientEmail+"  "+clientMobile+"  "+clientDOB+"  "+clientAddress+"  "+clientDeliveryAddress);

            if (clientName != "" && clientEmail != "" && clientMobile != "" && clientDOB != "" && clientAddress != "" && clientDeliveryAddress != "") {

                var id = document.querySelector('input[name="paymentMethod"]:checked').value;
                if (id == 1) {
                    $('#payOnlieButton').css("visibility", "hidden");
                    $('#cashOnDeliveryButton').css("visibility", "visible");
                } else if (id == 2) {
                    $('#payOnlieButton').css("visibility", "visible");
                    $('#cashOnDeliveryButton').css("visibility", "hidden");
                } else {
                    $('#payOnlieButton').css("visibility", "hidden");
                    $('#cashOnDeliveryButton').css("visibility", "visible");
                }
            } else {
                alert('Please Select All Fields !');
            }



        }

        function nextStep() {
            var paymentId = document.querySelector('input[name="paymentMethod"]:checked').value;
            $('#clientPaymentMethod').val(paymentId);
            // if (paymentId == 2) {
            //     $('#tableId').val("0");
            // }else{

            // }
            var clientId = $('#clientId').val();
            var clientName = $('#clientName').val();
            var clientEmail = $('#clientEmail').val();
            var clientMobile = $('#clientMobile').val();
            var clientDOB = $('#datepicker').val();
            var clientAddress = $('#clientAddress').val();
            var clientDeliveryAddress = $('#clientDeliveryAddress').val();
            var clientPassword = $('#clientPassword').val();
            var retypePassword = $('#retypePassword').val();

            if (paymentId != "" || clientName != "" || clientEmail != "" || clientMobile != "" || clientDOB != "" || clientAddress != "" || clientDeliveryAddress != "") {

                if (clientId >= 0) {

                    $('#clintDataForm').submit();

                } else {
                    alert('Please Fill All The Fields !');
                }
            } else {
                alert('Please Fill All The Fields !');
            }
        }

        function deleteProduct(productId, productSizeId, productOptionIds, productAddonIds) {

            $.ajax({
                    method: "get",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "deleteSingleItemFromCart",
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds

                    }
                })
                .done(function(response) {

                    location.reload();

                });

        }
    </script>
</body>

</html>