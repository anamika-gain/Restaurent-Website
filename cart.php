<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
pageViewIncrement('menu');
$deliveryCharge = getValueFromExtraTableByItemName("delivery_charge");
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

    <!-- <div class="global-cart-btn">
        <a href="#" class="cart-button"><i class="fa fa-shopping-cart"></i><span id="totalCartProductsView"><?php //echo totalCartProduct(); 
                                                                                                            ?></span></a>
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

    <!--Cart area-->
    <section class="section-padding gray-bg-2 leaf-bottom">
        <div class="container">
            <div class="row mb-60">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="cart-items table-responsive">
                        <table class="table centered borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                $cartDetails = $_SESSION['cart'];
                                $totalPrice = 0;
                                //print_r($cartDetails);
                                foreach ($cartDetails as $key => $value) {

                                ?>
                                    <tr>
                                        <td><img src="erp/images/<?php echo $cartDetails[$key]['product_image']; ?>" alt="<?php echo $cartDetails[$key]['product_name']; ?>" alt="<?php echo $cartDetails[$key]['product_name']; ?>"></td>
                                        <td><a href="product-details.php?productId=<?php echo $cartDetails[$key]['product_id']; ?>"><?php echo $cartDetails[$key]['product_name']; ?></a>
                                            <br>
                                            <span>
                                                                                    <p><b>Size:</b> <?php echo $cartDetails[$key]['product_size_name']; ?></p><p><b>Options:</b>


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

                                                </p>
                                                <p><b>Addons:</b>
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
                                            </span>
                                        </td>
                                        <td>৳ <?php echo  round($cartDetails[$key]['product_price'] / $cartDetails[$key]['quantity'], 2); ?></td>
                                        <td><input min="0" max="100" value="<?php echo  $cartDetails[$key]['quantity']; ?>" type="number" id="quantity<?php echo  $cartDetails[$key]['product_id']; ?>"></td>
                                        <td>৳ <?php echo $cartDetails[$key]['product_price']; ?></td>
                                        <?php
                                        $productId = $cartDetails[$key]['product_id'];
                                        $productSizeId = $cartDetails[$key]['product_size_id'];
                                        $productOptionIds = implode(",", $cartDetails[$key]['product_option_ids']);
                                        $productAddonIds = implode(",", $cartDetails[$key]['product_addon_ids']);
                                        $subCategoryAddonIds = implode(",", $cartDetails[$key]['sub_category_addon_ids']);
                                        ?>


                                        <td><a href="#cartQuantity" onclick="cartUpdate('<?php echo $productId; ?>', '<?php echo $productSizeId; ?>', '<?php echo $productOptionIds; ?>', '<?php echo $productAddonIds; ?>', '<?php echo $subCategoryAddonIds; ?>')"><i class="fa fa-refresh"></i></a></td>


                                        <td>
                                            <a href="#remove" class="remove-button" onclick="removeSingleCartItem('<?php echo $productId; ?>', '<?php echo $productSizeId; ?>', '<?php echo $productOptionIds; ?>', '<?php echo $productAddonIds; ?>', '<?php echo $subCategoryAddonIds; ?>'); reloadLocation();"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                <?php
                                    $i++;
                                    $totalPrice = $totalPrice + $cartDetails[$key]['product_price'];
                                }
                                //$serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
                                //$taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6 mb-30">
                    <div class="cart-card">
                        <!-- <div class="card">
                            <div class="card-header">
                                <h4>Coupon</h4>
                            </div>
                            <div class="card-body">
                                <p>Enter your coupon code if you have</p>
                                <form action="#" class="form-inline">
                                    <input type="text" placeholder="Coupon code">
                                    <button type="submit" class="bttn-small btn-fill">Apply</button>
                                </form>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="cart-card">
                        <div class="card">
                            <div class="card-header">
                                <h4>Cart Totals</h4>
                            </div>
                            <div class="card-body">
                                <div class="single-cart-total">
                                    <p>Subtotal</p>
                                    <p class="cart-amount">৳ <?php echo $totalPrice; ?></p>
                                </div>
                                <div class="single-cart-total">
                                    <p>Service Charge</p>
                                    <?php $serviceChargePercent = (float)getValueFromExtraTableByItemName('service_charge'); ?>
                                    <p class="cart-amount">৳ <?php echo $totalServiceCharge =  totalServiceCharge($totalPrice, $serviceChargePercent); ?></p>
                                </div>
                                <div class="single-cart-total">
                                    <p>VAT</p>
                                    <?php $vatPercent = (float)getValueFromExtraTableByItemName('VAT'); ?>
                                    <p class="cart-amount">৳ <?php
                                                                    $beforTax = $totalPrice + $totalServiceCharge;
                                                                    echo totalTax($beforTax, $vatPercent);
                                                                    ?></p>
                                </div>
                                <div class="single-cart-total">
                                    <p>Delivery Charge</p>
                                    <p class="cart-amount">৳ <?php
                                                                    echo $deliveryCharge;
                                                                    ?></p>
                                </div>
                                <div class="single-cart-total">
                                    <p>Total</p>
                                    <p class="cart-amount cl-primary">৳ <?php echo grandTotalFromBasicAmount($totalPrice, $serviceChargePercent, $vatPercent) + $deliveryCharge . "/-"; ?></p>
                                </div>
                                <!-- <a href="" class="calculate-shipping">Calculate Shipping</a> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-50">
                <div class="col centered">
                    <a href="checkout.php" class="bttn-mid btn-fill">Procceed to Checkout</a>
                </div>
            </div>
        </div>
    </section>
    <!--/Cart area-->



    <?php require 'web-includes/footer.php'; ?>

    <script>
        function cartUpdate(productId, productSizeId, productOptionIds, productAddonIds, subCategoryAddonIds) {

            var productQuantity = $('#quantity'+productId).val();

            $.ajax({
                    method: "post",
                    url: 'erp/ajaxfunctions.php',
                    data: {
                        funName: "updateCartQuantity",
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds,
                        subCategoryAddonIds: subCategoryAddonIds,
                        productQuantity: productQuantity,
                        updateFrom: "cartPage"
                    }
                })
                .done(function(response) {
                    location.reload();
                });
        }
    </script>

</body>

</html>