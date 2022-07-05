<?php

session_start();

require '../includes/easyfunctions.php';

print_r($_REQUEST);

$productId = $_REQUEST['productId'];
$productSizeId = $_REQUEST['productSizeId'];
$productSizePrice = getProductPriceFromSizeId($productSizeId);


if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "cartPage") {
    if ($_REQUEST['productOptionIds'] == "") {
        $productOptionIds = array();
    } else {
        $productOptionIds = explode(",", $_REQUEST['productOptionIds']); //comma seperated string
    }

    if ($_REQUEST['productAddonIds'] == "") {
        $productAddonIds = array();
    } else {
        $productAddonIds = explode(",", $_REQUEST['productAddonIds']); //comma seperated string
    }

    if ($_REQUEST['subCategoryAddonIds'] == "") {
        $subCategoryAddonIds = array();
    } else {
        $subCategoryAddonIds = explode(",", $_REQUEST['subCategoryAddonIds']); //comma seperated string
    }
} else {

    if (isset($_REQUEST['productOptionIds'])) {
        $productOptionIds = $_REQUEST['productOptionIds']; //array
        $productOptionPrices = array();

        foreach ($productOptionIds as $key => $value) {
            $optionDetails = getAllDataOfProductOptionTableFromProductOptionId($productOptionIds[$key]);


            $currentDate = date("Y-m-d H:i:s");

            if ($optionDetails['offer_money_from'] < $currentDate && $optionDetails['offer_money_to'] > $currentDate) {
                $optionDetailsPrice = $optionDetails['offer_money_added'];
            } else {
                $optionDetailsPrice = $optionDetails['extra_money_added'];
            }

            array_push($productOptionPrices, $optionDetailsPrice);
        }
    } else {
        $productOptionIds = array(); //array
        $productOptionPrices = array(); //array
    }

    if (isset($_REQUEST['productAddonIds'])) {
        $productAddonIds = $_REQUEST['productAddonIds']; //array
        $productAddonPrices = array();

        foreach ($productAddonIds as $key => $value) {
            $addonDetails = getAllDataOfProductAddonTableFromProductAddonId($productAddonIds[$key]);


            $currentDate = date("Y-m-d H:i:s");

            if ($addonDetails['offer_money_from'] < $currentDate && $addonDetails['offer_money_to'] > $currentDate) {
                $addonDetailsPrice = $addonDetails['offer_money_added'];
            } else {
                $addonDetailsPrice = $addonDetails['extra_money_added'];
            }

            array_push($productAddonPrices, $addonDetailsPrice);
        }
    } else {
        $productAddonIds = array(); //array
        $productAddonPrices = array(); //array
    }

    if (isset($_REQUEST['subCategoryAddonIds'])) {
        $subCategoryAddonIds = $_REQUEST['subCategoryAddonIds']; //array
        $subCategoryAddonPrices = array();

        foreach ($subCategoryAddonIds as $key => $value) {
            $addonDetails = getAllDataOfSubCategoryAddonTableFromSubCategoryAddonId($subCategoryAddonIds[$key]);


            $currentDate = date("Y-m-d H:i:s");

            if ($addonDetails['offer_money_from'] < $currentDate && $addonDetails['offer_money_to'] > $currentDate) {
                $addonDetailsPrice = $addonDetails['offer_money_added'];
            } else {
                $addonDetailsPrice = $addonDetails['extra_money_added'];
            }

            array_push($subCategoryAddonPrices, $addonDetailsPrice);
        }
    } else {
        $subCategoryAddonIds = array(); //array
        $subCategoryAddonPrices = array(); //array
    }
}

$productQuantity = $_REQUEST['productQuntity'];

$tableId = $_REQUEST['tableIdNo'];

echo $sessionName = "table" . $tableId;

$addNew = 1;


foreach ($_SESSION[$sessionName] as $i => $value) {
    if ($productId == $_SESSION[$sessionName][$i]['product_id']) {
        if ($productSizeId == $_SESSION[$sessionName][$i]['product_size_id']) {
            if ($productOptionIds === $_SESSION[$sessionName][$i]['product_option_ids']) {
                if ($productAddonIds === $_SESSION[$sessionName][$i]['product_addon_ids'] && $subCategoryAddonIds === $_SESSION[$sessionName][$i]['sub_category_addon_ids']) {
                    $foundInArrayIndex = $i;
                    $addNew = 0;
                }
            }
        }
    }
}

if ($addNew == 1) {

    $productPrice = $productSizePrice;

    foreach ($productOptionPrices as $key => $value) {
        $productPrice = $productPrice + $productOptionPrices[$key];
    }

    foreach ($productAddonPrices as $key => $value) {
        $productPrice = $productPrice + $productAddonPrices[$key];
    }

    foreach ($subCategoryAddonPrices as $key => $value) {
        $productPrice = $productPrice + $subCategoryAddonPrices[$key];
    }

    $productDetails = getProductDetailsFromId($productId);
    $productName = $productDetails['name'];
    $productImage = $productDetails['photo'];
    $productSizeDetails = getProductSizeDetailsFromProductSizeId($productSizeId);
    $productSizeName = $productSizeDetails['name'];


    $_SESSION['branch_id'] = $productDetails['branch_id'];
    $_SESSION['sub_branch_id'] = $productDetails['sub_branch_id'];


    $newItem = array(
        "product_id" => "$productId",
        "product_name" => "$productName",
        "product_image" => "$productImage",
        "product_size_id" => "$productSizeId",
        "product_size_name" => "$productSizeName",
        "product_option_ids" => $productOptionIds,
        "product_addon_ids" => $productAddonIds,
        "sub_category_addon_ids" => $subCategoryAddonIds,
        "product_size_price" => "$productSizePrice",
        "product_option_prices" => $productOptionPrices,
        "product_addon_prices" => $productAddonPrices,
        "sub_category_addon_prices" => $subCategoryAddonPrices,
        "quantity" => "$productQuantity",
        "product_price" => $productPrice * $productQuantity
    );

    array_push($_SESSION[$sessionName], $newItem);
} else {

    $previousQuantity = $_SESSION[$sessionName][$foundInArrayIndex]['quantity'];
    $unitPrice = $_SESSION[$sessionName][$foundInArrayIndex]['product_price'] / $previousQuantity;

    if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "cartPage") {
        $_SESSION[$sessionName][$foundInArrayIndex]['quantity'] = $productQuantity;
    } else {
        $_SESSION[$sessionName][$foundInArrayIndex]['quantity'] = $_SESSION[$sessionName][$foundInArrayIndex]['quantity'] + $productQuantity;
    }

    $_SESSION[$sessionName][$foundInArrayIndex]['product_price'] = $unitPrice * $_SESSION[$sessionName][$foundInArrayIndex]['quantity'];

    if ($_SESSION[$sessionName][$foundInArrayIndex]['quantity'] <= 0) {
        unset($_SESSION[$sessionName][$foundInArrayIndex]);
    }
}



// if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "cartPage") {
//     $goto = "../cart.php";
// } else {
//     $goto = "../menu.php";
// }

// echo "<script>window.location.href = '$goto';</script>";

print_r($_SESSION[$sessionName]);
