<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'erp/includes/easyfunctions.php';
//pageViewIncrement('home');

if (isset($_REQUEST['orderId'])) {
    $uniqueOrderId = $_REQUEST['orderId'];
    $orderProcess = getOrderProcessDetailsFromUniqueOrderId($uniqueOrderId);
    $orderItems = getAllDataOfOrderItemTableFromUniqueOrderId($uniqueOrderId);
} else {
    echo "<script>window.location.href = 'index.php';</script>";
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

    <title>Order Trcking Page</title>

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
    </div><!-- /Preloader -->

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

    <!--Order Tracking-->
    <section class="section-padding leaf-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                    <div class="userpanel-menu">
                        <ul>
                            <li class="active"><a href="my-order.php"><i class="fa fa-angle-left"></i> Back</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                    <span>
                        <h6>
                            Order ID:
                            <?php
                            if ($orderProcess['table_id'] > 0) {
                                echo $tableId = "#T"  . $orderProcess['id'] . "-" . $orderProcess['table_id'];
                            } else {
                                echo $tableId = "#O" . $orderProcess['id'];
                            }
                            ?>
                        </h6>
                        <br>
                        <h6>

                            Order Time: <?php echo $orderProcess['order_time']; ?>

                        </h6>
                        <br>

                    </span>
                    <div class="cart-items table-responsive">
                        <table class="table centered mb-60" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <!-- <th scope="col">Quantity</th> -->
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($orderItems as $key => $value) {
                                    $productDetails = getProductDetailsFromId($orderItems[$key]['product_id']);
                                    $productName = $productDetails['name'];


                                ?>
                                    <tr>
                                        <td>
                                                <h4><?php echo $productName; ?></h4>
                                            <br>
                                            <span>
                                                <strong>Quantity: </strong> <?php echo $orderItems[$key]['product_quantity']; ?>
                                            </span>
                                            <br>
                                            <span>
                                                <strong>Size: </strong> <?php
                                                                        $productSizeDetails = getProductSizeDetailsFromProductSizeId($orderItems[$key]['product_size_id']);
                                                                        echo $productSizeDetails['name'];
                                                                        ?>
                                            </span>
                                            <br>

                                            <span>
                                                <strong>Options: </strong> <?php
                                                                            $productOptions = unserialize($orderItems[$key]['product_option_ids']);
                                                                            if (count($productOptions) == 0) {
                                                                                echo "N/A";
                                                                            } else {
                                                                                foreach ($productOptions as $productOptionsIndex => $value) {
                                                                                    $productOptionName = getDetailsOfProductOptionTableFromId($productOptions[$productOptionsIndex]);
                                                                                    if (current($productOptions) == end($productOptions)) {
                                                                                        echo $productOptionName['name'];
                                                                                    } else {
                                                                                        echo $productOptionName['name'] . " , ";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                            </span>
                                            <br>

                                            <span>
                                                <strong>Addons: </strong> <?php
                                                                            $productAddons = unserialize($orderItems[$key]['product_addon_ids']);

                                                                            if (count($productAddons) == 0) {
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
                                                                            }


                                                                            if (count($productAddons) > 0) {
                                                                                echo ", ";
                                                                            }

                                                                            $subCategoryAddons = unserialize($orderItems[$key]['sub_category_addon_ids']);

                                                                            foreach ($subCategoryAddons as $subCategoryAddonsIndex => $value) {
                                                                                $subCategoryAddonName = getSubCategoryAddonDetailsFromSubCategoryAddonId($subCategoryAddons[$subCategoryAddonsIndex]);
                                                                                if (current($subCategoryAddons) == end($subCategoryAddons)) {
                                                                                    echo $subCategoryAddonName['name'];
                                                                                } else {
                                                                                    echo $subCategoryAddonName['name'] . " , ";
                                                                                }
                                                                            }

                                                                            ?>
                                            </span>
                                        </td>
                                        <!-- <td>X <?php echo $orderItems[$key]['product_quantity']; ?></td> -->
                                        <td>৳<?php echo $orderItems[$key]['product_total_price']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                                <tr>
                                    <td>Sub Total</td>
                                    <td>৳<?php echo $orderProcess['basic_total_bill']; ?></td>
                                </tr>
                                <tr>
                                    <td>Service Charge</td>
                                    <td>৳<?php echo $orderProcess['service_charge']; ?></td>
                                </tr>
                                <tr>
                                    <td>VAT</td>
                                    <td>৳<?php echo $orderProcess['tax']; ?></td>
                                </tr>
                                <tr>
                                    <td>Delivery Charge</td>
                                    <td>৳<?php echo $orderProcess['delivery_charge']; ?></td>
                                </tr>
                                <?php
                                if ($orderProcess['discount_amount'] > 0) {
                                ?>
                                    <tr>
                                        <td>Discount</td>
                                        <td>৳<?php echo $orderProcess['discount_amount']; ?></td>
                                    </tr>

                                <?php
                                }
                                ?>
                                <tr>
                                    <td>Total Bill</td>
                                    <td>৳<?php echo $orderProcess['total_bill']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $viewOrderTrackingProcess = getValueFromExtraTableByItemName('viewOrderTrackingProcess');

                    if ($viewOrderTrackingProcess == 1) {

                    ?>
                        <span id="clientOrderStatusView">
                            <?php
                            if ($orderProcess['table_id'] == 0) {
                            ?>
                                <div class="section-title">
                                    <h2>Order Status</h2>
                                </div>
                                <div class="order-status">
                                    <div class="single-order-status success">
                                        <i class="fa fa-check"></i>
                                        Order Placed at <?php echo $orderProcess['order_time']; ?>
                                    </div>
                                    <div class="single-order-status <?php if ($orderProcess['cooking_start_time'] != null) {
                                                                        echo "success";
                                                                        $cooking_started = true;
                                                                    } else {
                                                                        echo "notsuccess";
                                                                        $cooking_started = false;
                                                                    } ?>">
                                        <i class="<?php
                                                    if ($cooking_started) {
                                                        echo "fa fa-check";
                                                    } else {
                                                        echo "fa fa-times";
                                                    }
                                                    ?>"></i>
                                        <?php
                                        if ($cooking_started) {
                                            echo "Accepted by Kithcen at " . $orderProcess['cooking_start_time'];
                                        } else {
                                            echo "Not Yet Accepted By kitchen";
                                        }
                                        ?>

                                    </div>
                                    <div class="single-order-status <?php if ($orderProcess['cooking_finish_time'] != null) {
                                                                        echo "success";
                                                                        $cooking_started = true;
                                                                    } else {
                                                                        echo "notsuccess";
                                                                        $cooking_started = false;
                                                                    } ?>">
                                        <i class="<?php
                                                    if ($cooking_started) {
                                                        echo "fa fa-check";
                                                    } else {
                                                        echo "fa fa-times";
                                                    }
                                                    ?>"></i>
                                        <?php
                                        if ($cooking_started) {
                                            echo "Food is ready to be delivered !";
                                        } else {
                                            echo "Preparing Your Order !";
                                        }
                                        ?>

                                    </div>
                                    <div class="single-order-status <?php if ($orderProcess['delivery_start_time'] != null) {
                                                                        echo "success";
                                                                        $cooking_started = true;
                                                                    } else {
                                                                        echo "notsuccess";
                                                                        $cooking_started = false;
                                                                    } ?>">
                                        <i class="<?php
                                                    if ($cooking_started) {
                                                        echo "fa fa-check";
                                                    } else {
                                                        echo "fa fa-times";
                                                    }
                                                    ?>"></i>
                                        <?php
                                        if ($cooking_started) {
                                            echo "Food is on the way!";
                                        } else {
                                            echo "Delivery Not yet Started !";
                                        }
                                        ?>

                                    </div>

                                    <div class="single-order-status <?php if ($orderProcess['delivery_finish_time'] != null) {
                                                                        echo "success";
                                                                        $cooking_started = true;
                                                                    } else {
                                                                        echo "notsuccess";
                                                                        $cooking_started = false;
                                                                    } ?>">
                                        <i class="<?php
                                                    if ($cooking_started) {
                                                        echo "fa fa-check";
                                                    } else {
                                                        echo "fa fa-times";
                                                    }
                                                    ?>"></i>
                                        <?php
                                        if ($cooking_started) {
                                            echo "Food is delivered !";
                                        } else {
                                            echo "Delivery Not yet Finished !";
                                        }
                                        ?>

                                    </div>

                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="section-title">
                                    <h2>Order Status</h2>
                                </div>
                                <div class="order-status">
                                    <div class="single-order-status success">
                                        <i class="fa fa-check"></i>
                                        Order Taken at <?php echo $orderProcess['order_time']; ?>
                                    </div>
                                    <div class="single-order-status <?php if ($orderProcess['cooking_start_time'] != null) {
                                                                        echo "success";
                                                                        $cooking_started = true;
                                                                    } else {
                                                                        echo "notsuccess";
                                                                        $cooking_started = false;
                                                                    } ?>">
                                        <i class="<?php
                                                    if ($cooking_started) {
                                                        echo "fa fa-check";
                                                    } else {
                                                        echo "fa fa-times";
                                                    }
                                                    ?>"></i>
                                        <?php
                                        if ($cooking_started) {
                                            echo "Cooking started at " . $orderProcess['cooking_start_time'];
                                        } else {
                                            echo "Your order has not started processing";
                                        }
                                        ?>

                                    </div>
                                    <div class="single-order-status <?php if ($orderProcess['cooking_finish_time'] != null) {
                                                                        echo "success";
                                                                        $cooking_started = true;
                                                                    } else {
                                                                        echo "notsuccess";
                                                                        $cooking_started = false;
                                                                    } ?>">
                                        <i class="<?php
                                                    if ($cooking_started) {
                                                        echo "fa fa-check";
                                                    } else {
                                                        echo "fa fa-times";
                                                    }
                                                    ?>"></i>
                                        <?php
                                        if ($cooking_started) {
                                            echo "Cooking finished at " . $orderProcess['cooking_finish_time'];
                                        } else {
                                            echo "Cooking not yet finished !";
                                        }
                                        ?>

                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </span>

                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row text-center" style="padding-top: 50px;">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <span style="margin: auto; width: 50%;">
                        <a class="bttn-mid btn-fill" href="tel:+8801300290494">Click to Call US!</a>
                    </span>
                </div>
            </div>
        </div>

    </section>
    <!--/Order Tracking-->


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
        function updateClietOrderStatusView() {
            var uniqueOrderId = <?php echo $uniqueOrderId; ?>;
            $.ajax({
                    method: "post",
                    url: 'erp/ajaxfunctions.php',
                    data: {
                        funName: "updateClietOrderStatusView",
                        uniqueOrderId: uniqueOrderId
                    }
                })
                .done(function(response) {
                    $('#clientOrderStatusView').html(response);
                });
        }

        setInterval(updateClietOrderStatusView, 5000);
    </script>
</body>

</html>