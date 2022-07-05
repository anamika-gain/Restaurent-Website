<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//print_r($_REQUEST);


require 'includes/easyfunctions.php';
$functionToCall = $_REQUEST['funName'];

switch ($functionToCall) {
    case "perfectOrder":
        processOrder();
        break;
    default:
        showProcessingWindow();
}


function processOrder()
{
    showProcessingWindow();
    global $con;
    $uniqueOrderId = saveOrder();
    $paymentMethodId = $_REQUEST['paymentMethod'];
    if ($paymentMethodId == 2) {
        //$sql = "UPDATE `order_process` SET `payment_status` = '1' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        //$con->query($sql);
        sslCheckout($uniqueOrderId);
    } else {
        $_SESSION['cart'] = array();
        //unset($_SESSION['tableId']);
        if (!isset($_REQUEST["clientId"]) || $_REQUEST["clientId"] == 0) {
            $clientMobile = $_REQUEST['clientMobile'];
        } else {
            $clientMobile = $_COOKIE['clientMobile'];
        }
        echo "<script>window.location.href = '../my-order.php?clientMobile=$clientMobile';</script>";
    }
}



function saveOrder()
{
    global $con;



    if (!isset($_REQUEST["clientId"]) || $_REQUEST["clientId"] == 0) {
        $clientName = $_REQUEST['clientName'];
        $clientEmail = $_REQUEST['clientEmail'];
        $clientMobile = $_REQUEST['clientMobile'];
        $clientDOB = $_REQUEST['clientDOB'];
        $clientAddress = $_REQUEST['clientAddress'];
        $clientPassword = $_REQUEST['clientPassword'];
        saveClient($clientName, $clientEmail, $clientMobile, $clientDOB, $clientAddress, $clientPassword);
        //$clientId = $_COOKIE['client_id'];
        $clientDetails = getClientDetailsFromMobileNumber($clientMobile);
        $clientId = $clientDetails['id'];


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        setcookie("client_id", $clientDetails['id'], time() + (86400 * 30 * 12), "/");
        setcookie("client_name", $clientDetails['name'], time() + (86400 * 30 * 12), "/");
        setcookie("client_email", $clientDetails['email'], time() + (86400 * 30 * 12), "/");
        setcookie("client_mobile", $clientDetails['mobile'], time() + (86400 * 30 * 12), "/");
        setcookie("client_dob", $clientDetails['dob'], time() + (86400 * 30 * 12), "/");
        setcookie("client_address", $clientDetails['address'], time() + (86400 * 30 * 12), "/");
    } else {
        $clientId = $_REQUEST["clientId"];
    }

    $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
    $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];


    $tableId = $_REQUEST['tableId'];

    if ($tableId == 0) {
        // $status = 1;
        // $subBranchId = "0"; //$_SESSION['sub_branch_id'];

        //for time being auto transferred to gulshan branch
        $status = 1;
        $subBranchId = "0"; //$_SESSION['sub_branch_id'];
    } else {
        $status = 2;
        $subBranchId = "1"; //$_SESSION['sub_branch_id'];
    }
    $branchId = "1";




    $uniqueOrderId = round(microtime(true) * 1000) . $clientId;
    $deliveryAddress = $_REQUEST['clientDeliveryAddress'];
    $totalItems = totalCartItem();
    $cartTotalBill = totalCartPrice();
    $basicTotalBill = basePriceFromFinalBill($cartTotalBill, $serviceChargePercentage, $taxPercentage);
    $serviceCharge = totalServiceChargeFromFinalBill($cartTotalBill, $serviceChargePercentage, $taxPercentage); //totalServiceCharge($basicTotalBill, $serviceChargePercentage);
    //$beforeTax = $basicTotalBill + $serviceCharge;
    $tax = totalVatFromFinalBill($cartTotalBill, $taxPercentage); //totalTax($beforeTax, $taxPercentage);
    if (isset($_REQUEST['deliveryCharge'])) {
        $deliveryCharge = $_REQUEST['deliveryCharge'];
    } else {
        $deliveryCharge = 0;
    }

    if (isset($_REQUEST['discountAmount'])) {
        $discountAmount = $_REQUEST['discountAmount'];
    } else {
        $discountAmount = 0;
    }


    $totalBill = (grandTotalFromBasicAmount($basicTotalBill, $serviceChargePercentage, $taxPercentage) + $deliveryCharge) - $discountAmount;
    $paidAmount = $totalBill; //$_REQUEST['paidAmount'];
    $paymentMethodId = $_REQUEST['paymentMethod'];

    if (isset($_REQUEST['orderRemarks'])) {
        $orderRemarks = $_REQUEST['orderRemarks'];
    } else {
        $orderRemarks = "No Extra Requirements";
    }

    $sql = "INSERT INTO `order_process` (`table_id`, `branch_id`, `sub_branch_id`, `client_id`, `unique_order_id`, `delivery_address`, `total_items`, `basic_total_bill`, `service_charge`, `tax`, `delivery_charge`, `discount_amount`, `total_bill`, `paid_amount`, `payment_method_id`, `remarks`, `status`) VALUES ('$tableId', '$branchId', '$subBranchId', '$clientId', '$uniqueOrderId', '$deliveryAddress', '$totalItems', '$basicTotalBill', '$serviceCharge', '$tax', '$deliveryCharge', '$discountAmount', '$totalBill', '$paidAmount', '$paymentMethodId', '$orderRemarks', '$status')";


    if ($paymentMethodId == "2") {
        $sql = "INSERT INTO `order_process` (`table_id`, `branch_id`, `sub_branch_id`, `client_id`, `unique_order_id`, `delivery_address`, `total_items`, `basic_total_bill`, `service_charge`, `tax`, `delivery_charge`, `discount_amount`, `total_bill`, `paid_amount`, `payment_method_id`, `remarks`, `show_notification`, `show_common_notification`, `status`) VALUES ('$tableId', '$branchId', '$subBranchId', '$clientId', '$uniqueOrderId', '$deliveryAddress', '$totalItems', '$basicTotalBill', '$serviceCharge', '$tax', '$deliveryCharge', '$discountAmount', '$totalBill', '$paidAmount', '$paymentMethodId', '$orderRemarks', '0', '0', '$status')";
    }

    //print_r($_SESSION['cart']);

    if ($con->query($sql)) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $productId = $_SESSION['cart'][$key]['product_id'];
            $productSizeId = $_SESSION['cart'][$key]['product_size_id'];
            $basePrice = getProductPriceFromSizeId($_SESSION['cart'][$key]['product_size_id']);
            $productOptionIds = $_SESSION['cart'][$key]['product_option_ids'];
            $productOptionPrices = array();
            foreach ($productOptionIds as $key2 => $value) {
                array_push($productOptionPrices, getProductOptionPriceFromOptionId($productOptionIds[$key2]));
            }
            $totalOptionPrice = array_sum($productOptionPrices);

            $productAddonIds = $_SESSION['cart'][$key]['product_addon_ids'];
            $productAddonPrices = array();
            foreach ($productAddonIds as $key3 => $value) {
                array_push($productAddonPrices, getProductAddonPriceFromAddonId($productAddonIds[$key3]));
            }
            $totalProductAddonPrice = array_sum($productAddonPrices);

            $subCategoryAddonIds = $_SESSION['cart'][$key]['sub_category_addon_ids'];
            $subCategoryAddonPrices = array();
            foreach ($subCategoryAddonIds as $key4 => $value) {
                array_push($subCategoryAddonPrices, getSubCategoryAddonPriceFromSubCategoryAddonId($productAddonIds[$key4]));
            }
            $totalSubCategoryAddonPrice = array_sum($subCategoryAddonPrices);

            $productUnitPrice = round($_SESSION['cart'][$key]['product_price'] / $_SESSION['cart'][$key]['quantity'], 2);
            $productQuantity = $_SESSION['cart'][$key]['quantity'];
            $productTotalPrice = $_SESSION['cart'][$key]['product_price'];
            $perUnitProductionCost = round(getProductionCostPerUnitOfSessionProductFromId($_SESSION['cart'][$key]['product_id']), 3);
            $totalProductionCost = round(($perUnitProductionCost * $productQuantity), 3);

            $productOptionIds2 = serialize($productOptionIds);
            $productOptionPrices2 = serialize($productOptionPrices);
            $productAddonIds2 = serialize($productAddonIds);
            $productAddonPrices2 = serialize($productAddonPrices);
            $subCategoryAddonIds2 = serialize($subCategoryAddonIds);
            $subCategoryAddonPrices2 = serialize($subCategoryAddonPrices);

            $sql = "INSERT INTO `order_items` (`branch_id`, `sub_branch_id`, `unique_order_id`, `product_id`, `product_size_id`, `base_price`, `product_option_ids`, `product_option_prices`, `total_option_price`, `product_addon_ids`, `product_addon_prices`, `total_addon_price`, `sub_category_addon_ids`, `sub_category_addon_prices`, `total_sub_category_addon_price`, `product_unit_price`, `product_quantity`, `product_total_price`, `per_unit_production_cost`, `total_production_cost`, `created_by`) VALUES ('$branchId', '$subBranchId', '$uniqueOrderId', '$productId', '$productSizeId', '$basePrice', '$productOptionIds2', '$productOptionPrices2', '$totalOptionPrice', '$productAddonIds2', '$productAddonPrices2', '$totalProductAddonPrice', '$subCategoryAddonIds2', '$subCategoryAddonPrices2', '$totalSubCategoryAddonPrice', '$productUnitPrice', '$productQuantity', '$productTotalPrice', '$perUnitProductionCost', '$totalProductionCost', '$clientId')";

            $con->query($sql);
        }
    }

    if ($tableId == 0) {
        updateOrderProcess($branchId, $subBranchId, $uniqueOrderId, '2', '0');
    }

    return $uniqueOrderId;
}


function updateOrderProcess($branchId = "", $subBranchId = "", $uniqueOrderId = "", $userTypeId = "", $userId = "")
{
    global $con;

    if (isset($_REQUEST['branchId']) && isset($_REQUEST['subBranchId']) && isset($_REQUEST['uniqueOrderId']) && isset($_REQUEST['userTypeId']) && isset($_REQUEST['userId'])) {
        $branchId = $_REQUEST['branchId'];
        $subBranchId = $_REQUEST['subBranchId'];
        $uniqueOrderId = $_REQUEST['uniqueOrderId'];
        $userTypeId = $_REQUEST['userTypeId'];
        $userId = $_REQUEST['userId'];
    }


    $updateTime = date("Y-m-d H:i:s");
    //$columnName = '';

    if ($userTypeId == 2) { //manager
        $sql = "UPDATE `order_process` SET `manager_id` = '$userId' AND `manager_approve_time` = '$updateTime' AND `status` = '2' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";

        if ($con->query($sql)) {
            deductIngredientsAmountFromStockFromUniqueOrderId($branchId, $subBranchId, $uniqueOrderId, ""); // when manager apporves
        }
    } elseif ($userTypeId == 3) {

        if (isset($_REQUEST['cookingStartTime'])) {
            $cookingStartTime = $_REQUEST['cookingStartTime'];
            $sql = "UPDATE `order_process` SET `cheff_id` = '$userId' AND `cooking_start_time` = '$cookingStartTime' AND `status` = '3' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        } else {
            $cookingFinishTime = $_REQUEST['cookingFinishTime'];
            $sql = "UPDATE `order_process` SET `cooking_finish_time` = '$cookingFinishTime' AND `status` = '4' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        }

        $con->query($sql);
    } elseif ($userTypeId == 8) {
        if (isset($_REQUEST['deliveryStartTime'])) {
            $deliveryStartTime = $_REQUEST['deliveryStartTime'];
            $sql = "UPDATE `order_process` SET `delivery_man_id` = '$userId' AND `delivery_start_time` = '$deliveryStartTime' AND `status` = '5' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        } else {
            $deliveryFinishTime = $_REQUEST['deliveryFinishTime'];
            $sql = "UPDATE `order_process` SET `delivery_finish_time` = '$deliveryFinishTime' AND `status` = '6' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        }

        $con->query($sql);
    } else {
    }
}

function updateOrderPaymentStatus()
{
    global $con;

    // $sql = "UPDATE `order_process` SET `payment_status` = '1' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
    // $con->query($sql);
}

function sslCheckout($uniqueOrderId)
{
    $orderProcessTableDetails = getOrderProcessDetailsFromUniqueOrderId($uniqueOrderId);
    /* PHP */
    $post_data = array();
    $post_data['store_id'] = "konacafebdlive";
    $post_data['store_passwd'] = "602CEC70B0BA227938";
    $post_data['currency'] = "BDT";
    $post_data['tran_id'] = "SSLCZ_TEST_" . $uniqueOrderId;
    $post_data['success_url'] = "http://konacafebd.com/erp/ssl/success.php"; //"http://localhost/new_sslcz_gw/success.php";
    $post_data['fail_url'] = "http://konacafebd.com/erp/ssl/fail.php";
    $post_data['cancel_url'] = "http://konacafebd.com/erp/ssl/cancel.php";
    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE


    # PRODUCT INFORMATION

    $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
    $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];


    $totalItems = totalCartItem();
    $cartTotalBill = totalCartPrice();
    $basicTotalBill = basePriceFromFinalBill($cartTotalBill, $serviceChargePercentage, $taxPercentage);
    $serviceCharge = totalServiceChargeFromFinalBill($cartTotalBill, $serviceChargePercentage, $taxPercentage); //totalServiceCharge($basicTotalBill, $serviceChargePercentage);
    //$beforeTax = $basicTotalBill + $serviceCharge;
    $tax = totalVatFromFinalBill($cartTotalBill, $taxPercentage); //totalTax($beforeTax, $taxPercentage);
    if (isset($_REQUEST['deliveryCharge'])) {
        $deliveryCharge = $_REQUEST['deliveryCharge'];
    } else {
        $deliveryCharge = 0;
    }

    if (isset($_REQUEST['discountAmount'])) {
        $discountAmount = $_REQUEST['discountAmount'];
    } else {
        $discountAmount = 0;
    }


    $totalBill = (grandTotalFromBasicAmount($basicTotalBill, $serviceChargePercentage, $taxPercentage) + $deliveryCharge) - $discountAmount;


    $i = 0;
    $productNameForSsl = "";
    $productCategoryForSsl = "";
    foreach ($_SESSION['cart'] as $key => $value) {
        $productId = $_SESSION['cart'][$key]['product_id'];
        $productDetailsSsl = getProductDetailsFromId($productId);
        $productCategoryDetailsSsl = getProductCategoryDetailsFromId($productDetailsSsl['category_id']);

        if ($i == 0) {
            $productNameForSsl = $productNameForSsl . $productDetailsSsl['name'];
            $productCategoryForSsl = $productCategoryForSsl . $productCategoryDetailsSsl['name'];
        } else {
            $productNameForSsl = ", " . $productNameForSsl . $productDetailsSsl['name'];
            $productCategoryForSsl = " - " . $productCategoryForSsl . $productCategoryDetailsSsl['name'];
        }
        $i++;
    }

    $post_data['product_name'] = $productNameForSsl;
    $post_data['product_category'] = $productCategoryForSsl;
    $post_data['product_profile'] = "Food Item";
    $post_data['total_amount'] = $totalBill;

    # EMI INFO
    $post_data['emi_option'] = "0"; // 1 for enabling emi option
    $post_data['emi_max_inst_option'] = "9";
    $post_data['emi_selected_inst'] = "9";

    # CUSTOMER INFORMATION
    $clientDetails = getClientDetailsFromUniqueOrderId($uniqueOrderId);



    $post_data['cus_name'] = $clientDetails['name'];
    $post_data['cus_email'] = $clientDetails['email'];
    $post_data['cus_add1'] = $clientDetails['address'];
    $post_data['cus_add2'] = "";
    $post_data['cus_city'] = "";
    $post_data['cus_state'] = "";
    $post_data['cus_postcode'] = "";
    $post_data['cus_country'] = "Bangladesh";
    $post_data['cus_phone'] = $clientDetails['mobile'];
    $post_data['cus_fax'] = "";

    # SHIPMENT INFORMATION
    $post_data['shipping_method'] = "NO";
    $post_data['ship_name'] = "Store Test";
    $post_data['ship_add1 '] = "Dhaka";
    $post_data['ship_add2'] = "Dhaka";
    $post_data['ship_city'] = "Dhaka";
    $post_data['ship_state'] = "Dhaka";
    $post_data['ship_postcode'] = "1000";
    $post_data['ship_country'] = "Bangladesh";


    # OPTIONAL PARAMETERS
    $post_data['value_a'] = $uniqueOrderId;
    $post_data['value_b '] = "ref002";
    $post_data['value_c'] = "ref003";
    $post_data['value_d'] = "ref004";

    # CART PARAMETERS
    $cart = array();
    $cartDetails = $_SESSION['cart'];
    foreach ($cartDetails as $key => $value) {
        $newItem = array(
            "product" => $cartDetails[$key]['product_name'],
            "quantity" => $cartDetails[$key]['quantity'],
            "amount" => $cartDetails[$key]['product_price']
        );
        array_push($cart, $newItem);
    }

    $post_data['cart'] = json_encode($cart);

    // $post_data['cart'] = json_encode(array(
    //     array("product" => "DHK TO BRS AC A1", "quantity" => "", "amount" => "200.00"),
    //     array("product" => "DHK TO BRS AC A2", "amount" => "200.00"),
    //     array("product" => "DHK TO BRS AC A3", "amount" => "200.00"),
    //     array("product" => "DHK TO BRS AC A4", "amount" => "200.00")
    // ));
    $post_data['product_amount'] = $totalBill;
    $post_data['vat'] = $tax;
    $post_data['discount_amount'] = $discountAmount;
    $post_data['convenience_fee'] = $deliveryCharge;


    # REQUEST SEND TO SSLCOMMERZ
    $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v4/api.php";

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


    $content = curl_exec($handle);

    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {
        curl_close($handle);
        $sslcommerzResponse = $content;
    } else {
        curl_close($handle);
        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
        exit;
    }

    # PARSE THE JSON RESPONSE
    $sslcz = json_decode($sslcommerzResponse, true);

    //print_r($sslcz);

    if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
        echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
        # header("Location: ". $sslcz['GatewayPageURL']);
        exit;
    } else {


        echo "JSON Data parsing error!";
    }
}

function saveClient($clientName = "", $clientEmail = "", $clientMobile = "", $clientDOB = "", $clientAddress = "", $clientPassword = "")
{
    global $con;
    $salt = generateSaltString();
    $returnResult = false;

    if (isset($_REQUEST['clientName']) || isset($_REQUEST['clientEmail']) || isset($_REQUEST['clientMobile']) || isset($_REQUEST['clientDOB']) || isset($_REQUEST['clientAddress']) || isset($_REQUEST['clientPassword'])) {
        $clientName = $_REQUEST['clientName'];
        $clientEmail = $_REQUEST['clientEmail'];
        $clientMobile = $_REQUEST['clientMobile'];
        $clientDOB = $_REQUEST['clientDOB'];
        $clientAddress = $_REQUEST['clientAddress'];
        $clientPassword = $salt . strrev(hash('sha256', $_REQUEST['clientPassword']));

        $returnResult = true;
    }

    $sql = "INSERT INTO `client` (`name`, `email`, `mobile`, `dob`, `address`, `password`) VALUES ('$clientName', '$clientEmail', '$clientMobile', '$clientDOB', '$clientAddress', '$clientPassword')";

    if ($returnResult) {
        if ($con->query($sql)) {
            echo "1";
        } else {
            echo "0";
        }
    } else {

        if ($con->query($sql)) {
            $clientDetails = getClientDetailsFromMobileNumber($clientMobile);

            setcookie("client_id", $clientDetails['id'], time() + (86400 * 30 * 12), "/");
            setcookie("client_name", $clientDetails['name'], time() + (86400 * 30 * 12), "/");
            setcookie("client_email", $clientDetails['email'], time() + (86400 * 30 * 12), "/");
            setcookie("client_mobile", $clientDetails['mobile'], time() + (86400 * 30 * 12), "/");
            setcookie("client_dob", $clientDetails['dob'], time() + (86400 * 30 * 12), "/");
            setcookie("client_address", $clientDetails['address'], time() + (86400 * 30 * 12), "/");
        }
    }
}


//this will always be the last fucntion
function showProcessingWindow()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adding to Cart</title>
        <style>
            @import url("https://fonts.googleapis.com/css?family=Amatic+SC");

            body {
                background-color: #ffde6b;
                height: 100vh;
                width: 100vw;
                overflow: hidden;
            }

            h1 {
                position: relative;
                margin: 0 auto;
                top: 25vh;
                width: 100vw;
                text-align: center;
                font-family: 'Amatic SC';
                font-size: 6vh;
                color: #333;
                opacity: .75;
                animation: pulse 2.5s linear infinite;
            }

            h1 .custom {
                position: relative;
                margin: 0 auto;
                top: 25vh;
                width: 100vw;
                text-align: center;
                font-family: 'Amatic SC';
                font-size: 6vh;
                color: #333;
                opacity: .75;
            }

            #cooking {
                position: relative;
                margin: 0 auto;
                top: 0;
                width: 75vh;
                height: 75vh;
                overflow: hidden;
            }

            #cooking .bubble {
                position: absolute;
                border-radius: 100%;
                box-shadow: 0 0 0.25vh #4d4d4d;
                opacity: 0;
            }

            #cooking .bubble:nth-child(1) {
                margin-top: 2.5vh;
                left: 58%;
                width: 2.5vh;
                height: 2.5vh;
                background-color: #454545;
                animation: bubble 2s cubic-bezier(0.53, 0.16, 0.39, 0.96) infinite;
            }

            #cooking .bubble:nth-child(2) {
                margin-top: 3vh;
                left: 52%;
                width: 2vh;
                height: 2vh;
                background-color: #3d3d3d;
                animation: bubble 2s ease-in-out .35s infinite;
            }

            #cooking .bubble:nth-child(3) {
                margin-top: 1.8vh;
                left: 50%;
                width: 1.5vh;
                height: 1.5vh;
                background-color: #333;
                animation: bubble 1.5s cubic-bezier(0.53, 0.16, 0.39, 0.96) 0.55s infinite;
            }

            #cooking .bubble:nth-child(4) {
                margin-top: 2.7vh;
                left: 56%;
                width: 1.2vh;
                height: 1.2vh;
                background-color: #2b2b2b;
                animation: bubble 1.8s cubic-bezier(0.53, 0.16, 0.39, 0.96) 0.9s infinite;
            }

            #cooking .bubble:nth-child(5) {
                margin-top: 2.7vh;
                left: 63%;
                width: 1.1vh;
                height: 1.1vh;
                background-color: #242424;
                animation: bubble 1.6s ease-in-out 1s infinite;
            }

            #cooking #area {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 50%;
                height: 50%;
                background-color: transparent;
                transform-origin: 15% 60%;
                animation: flip 2.1s ease-in-out infinite;
            }

            #cooking #area #sides {
                position: absolute;
                width: 100%;
                height: 100%;
                transform-origin: 15% 60%;
                animation: switchSide 2.1s ease-in-out infinite;
            }

            #cooking #area #sides #handle {
                position: absolute;
                bottom: 18%;
                right: 80%;
                width: 35%;
                height: 20%;
                background-color: transparent;
                border-top: 1vh solid #333;
                border-left: 1vh solid transparent;
                border-radius: 100%;
                transform: rotate(20deg) rotateX(0deg) scale(1.3, 0.9);
            }

            #cooking #area #sides #pan {
                position: absolute;
                bottom: 20%;
                right: 30%;
                width: 50%;
                height: 8%;
                background-color: #333;
                border-radius: 0 0 1.4em 1.4em;
                transform-origin: -15% 0;
            }

            #cooking #area #pancake {
                position: absolute;
                top: 24%;
                width: 100%;
                height: 100%;
                transform: rotateX(85deg);
                animation: jump 2.1s ease-in-out infinite;
            }

            #cooking #area #pancake #pastry {
                position: absolute;
                bottom: 26%;
                right: 37%;
                width: 40%;
                height: 45%;
                background-color: #333;
                box-shadow: 0 0 3px 0 #333;
                border-radius: 100%;
                transform-origin: -20% 0;
                animation: fly 2.1s ease-in-out infinite;
            }

            @keyframes jump {
                0% {
                    top: 24%;
                    transform: rotateX(85deg);
                }

                25% {
                    top: 10%;
                    transform: rotateX(0deg);
                }

                50% {
                    top: 30%;
                    transform: rotateX(85deg);
                }

                75% {
                    transform: rotateX(0deg);
                }

                100% {
                    transform: rotateX(85deg);
                }
            }

            @keyframes flip {
                0% {
                    transform: rotate(0deg);
                }

                5% {
                    transform: rotate(-27deg);
                }

                30%,
                50% {
                    transform: rotate(0deg);
                }

                55% {
                    transform: rotate(27deg);
                }

                83.3% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(0deg);
                }
            }

            @keyframes switchSide {
                0% {
                    transform: rotateY(0deg);
                }

                50% {
                    transform: rotateY(180deg);
                }

                100% {
                    transform: rotateY(0deg);
                }
            }

            @keyframes fly {
                0% {
                    bottom: 26%;
                    transform: rotate(0deg);
                }

                10% {
                    bottom: 40%;
                }

                50% {
                    bottom: 26%;
                    transform: rotate(-190deg);
                }

                80% {
                    bottom: 40%;
                }

                100% {
                    bottom: 26%;
                    transform: rotate(0deg);
                }
            }

            @keyframes bubble {
                0% {
                    transform: scale(0.15, 0.15);
                    top: 80%;
                    opacity: 0;
                }

                50% {
                    transform: scale(1.1, 1.1);
                    opacity: 1;
                }

                100% {
                    transform: scale(0.33, 0.33);
                    top: 60%;
                    opacity: 0;
                }
            }

            @keyframes pulse {
                0% {
                    transform: scale(1, 1);
                    opacity: .25;
                }

                50% {
                    transform: scale(1.2, 1);
                    opacity: 1;
                }

                100% {
                    transform: scale(1, 1);
                    opacity: .25;
                }
            }
        </style>
    </head>

    <body>

        <h1 class="custom">Processing Order !</h1>


        <div id="cooking">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div id="area">
                <div id="sides">
                    <div id="pan"></div>
                    <div id="handle"></div>
                </div>
                <div id="pancake">
                    <div id="pastry"></div>
                </div>
            </div>
        </div>

        <script>
            // setTimeout(function() {
            //     window.history.back();
            // }, 5000);
        </script>
    </body>

    </html>



<?php
}






?>