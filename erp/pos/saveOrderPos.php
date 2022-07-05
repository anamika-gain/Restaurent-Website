<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//print_r($_REQUEST);


require '../includes/easyfunctions.php';
$functionToCall = $_REQUEST['funName'];

switch ($functionToCall) {
    case "perfectOrder":
        processOrder();
        break;
    default:
        echo "HI !!";
}


function processOrder()
{
    global $con;
    $uniqueOrderId = saveOrder();
    echo $uniqueOrderId;
    $sessionName = "table".$_REQUEST['tableId'];
    $_SESSION[$sessionName] = array();
}



function saveOrder()
{
    global $con;

    $clientId = $_REQUEST["clientId"];

    $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
    $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];


    $tableId = $_REQUEST['tableId'];
    $sessionName = "table".$_REQUEST['tableId'];
    $servedBy = $_REQUEST['servedBy'];
    $subBranchId = $_SESSION['user_sub_branch_id'];
    $branchId = "1";

    $uniqueOrderId = round(microtime(true) * 1000) . $clientId;
    $deliveryAddress = "Ordered On Counter";
    $totalItems = totalCartItem($sessionName);
    $cartTotalBill = totalCartPrice($sessionName);
    $basicTotalBill = basePriceFromFinalBill($cartTotalBill, $serviceChargePercentage, $taxPercentage);
    $serviceCharge = totalServiceChargeFromFinalBill($cartTotalBill, $serviceChargePercentage, $taxPercentage); 
    $tax = totalVatFromFinalBill($cartTotalBill, $taxPercentage); //totalTax($beforeTax, $taxPercentage);

    if (isset($_REQUEST['discountAmount'])) {
        $discountAmount = $_REQUEST['discountAmount'];
    } else {
        $discountAmount = 0;
    }


    $totalBill = (grandTotalFromBasicAmount($basicTotalBill, $serviceChargePercentage, $taxPercentage)) - $discountAmount;
    $paidAmount = $totalBill;
    $paymentMethodId = $_REQUEST['paymentMethod'];

    if (isset($_REQUEST['orderRemarks'])) {
        $orderRemarks = $_REQUEST['orderRemarks'];
    } else {
        $orderRemarks = "No Extra Requirements";
    }


    $managerId = $_SESSION["user_id"];
    $updateTime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `order_process` (`table_id`, `branch_id`, `sub_branch_id`, `client_id`, `unique_order_id`, `manager_id`, `served_by`, `manager_approve_time`, `delivery_address`, `total_items`, `basic_total_bill`, `service_charge`, `tax`, `delivery_charge`, `discount_amount`, `total_bill`, `paid_amount`, `payment_method_id`, `remarks`, `show_notification`, `show_common_notification`, `status`) VALUES ('$tableId', '$branchId', '$subBranchId', '$clientId', '$uniqueOrderId', '$managerId', '$servedBy', '$updateTime', '$deliveryAddress', '$totalItems', '$basicTotalBill', '$serviceCharge', '$tax', '0', '$discountAmount', '$totalBill', '$paidAmount', '$paymentMethodId', '$orderRemarks', '0', '0', '2')";

    //print_r($_SESSION['cart']);

    $cartDetails = $_SESSION[$sessionName];

    if ($con->query($sql)) {
        foreach ($cartDetails as $key => $value) {
            $productId = $cartDetails[$key]['product_id'];
            $productSizeId = $cartDetails[$key]['product_size_id'];
            $basePrice = getProductPriceFromSizeId($cartDetails[$key]['product_size_id']);
            $productOptionIds = $cartDetails[$key]['product_option_ids'];
            $productOptionPrices = array();
            foreach ($productOptionIds as $key2 => $value) {
                array_push($productOptionPrices, getProductOptionPriceFromOptionId($productOptionIds[$key2]));
            }
            $totalOptionPrice = array_sum($productOptionPrices);

            $productAddonIds = $cartDetails[$key]['product_addon_ids'];
            $productAddonPrices = array();
            foreach ($productAddonIds as $key3 => $value) {
                array_push($productAddonPrices, getProductAddonPriceFromAddonId($productAddonIds[$key3]));
            }
            $totalProductAddonPrice = array_sum($productAddonPrices);

            $subCategoryAddonIds = $cartDetails[$key]['sub_category_addon_ids'];
            $subCategoryAddonPrices = array();
            foreach ($subCategoryAddonIds as $key4 => $value) {
                array_push($subCategoryAddonPrices, getSubCategoryAddonPriceFromSubCategoryAddonId($productAddonIds[$key4]));
            }
            $totalSubCategoryAddonPrice = array_sum($subCategoryAddonPrices);

            $productUnitPrice = round($cartDetails[$key]['product_price'] / $cartDetails[$key]['quantity'], 2);
            $productQuantity = $cartDetails[$key]['quantity'];
            $productTotalPrice = $cartDetails[$key]['product_price'];
            $perUnitProductionCost = round(getProductionCostPerUnitOfSessionProductFromIdPos($cartDetails[$key]['product_id'], $sessionName), 3);
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

    deductIngredientsAmountFromStockFromUniqueOrderId($branchId, $subBranchId, $uniqueOrderId, "");

    return $uniqueOrderId;
}




?>
