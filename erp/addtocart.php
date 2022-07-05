<?php

session_start();

require 'includes/easyfunctions.php';

//print_r($_REQUEST);

$productId = $_REQUEST['productId'];
$productSizeId = $_REQUEST['productSizeId'];
$productSizePrice = $_REQUEST['productSizePrice'];

$extraOptionPrice = 0;
$numberOfExtraOption = 0;


if (isset($_REQUEST['productOptionIds'])) {

    $optionTitleId = groupOptionNameByOptionTitleFromOptionIds($_REQUEST['productOptionIds']);
    
    foreach ($optionTitleId as $key => $value) {
        
        $optionLimit = getFreeOptionLimitFromProductOptionTitleId($optionTitleId[$key]['title_id']);
        $totalOptions = substr_count($optionTitleId[$key]['option_id'], ",")+1;
        if ($totalOptions > $optionLimit) {
            $perOptionCost = getValueFromExtraTableByItemName("extraAmountForOption");
            $optionDifference = $totalOptions - $optionLimit;
            $extraAmount = $perOptionCost * $optionDifference;
            $extraOptionPrice = $extraOptionPrice + $extraAmount;
            $numberOfExtraOption = $numberOfExtraOption + $optionDifference;
        }
    }



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

$productQuantity = $_REQUEST['productQuntity'];

$addNew = 1;


foreach ($_SESSION['cart'] as $i => $value) {
    if ($productId == $_SESSION['cart'][$i]['product_id']) {
        if ($productSizeId == $_SESSION['cart'][$i]['product_size_id']) {
            if ($productOptionIds === $_SESSION['cart'][$i]['product_option_ids']) {
                if ($productAddonIds === $_SESSION['cart'][$i]['product_addon_ids'] && $subCategoryAddonIds === $_SESSION['cart'][$i]['sub_category_addon_ids']) {
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

    $productPrice = $productPrice + $extraOptionPrice;

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
        "product_extra_option" => $numberOfExtraOption,
        "product_extra_option_price" => $extraOptionPrice,
        "quantity" => "$productQuantity",
        "product_price" => $productPrice * $productQuantity
    );

    array_push($_SESSION['cart'], $newItem);
} else {

    $previousQuantity = $_SESSION['cart'][$foundInArrayIndex]['quantity'];
    $unitPrice = $_SESSION['cart'][$foundInArrayIndex]['product_price'] / $previousQuantity;

    if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "cartPage") {
        $_SESSION['cart'][$foundInArrayIndex]['quantity'] = $productQuantity;
    } else {
        $_SESSION['cart'][$foundInArrayIndex]['quantity'] = $_SESSION['cart'][$foundInArrayIndex]['quantity'] + $productQuantity;
    }

    $_SESSION['cart'][$foundInArrayIndex]['product_price'] = $unitPrice * $_SESSION['cart'][$foundInArrayIndex]['quantity'];

    if ($_SESSION['cart'][$foundInArrayIndex]['quantity'] <= 0) {
        unset($_SESSION['cart'][$foundInArrayIndex]);
    }
}



if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "cartPage") {
    $goto = "../cart.php";
} else {
    $goto = "../menu.php";
}

echo "<script>window.location.href = '$goto';</script>";

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

    <h1>Adding <?php echo $productName; ?> To Cart</h1>
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
</body>

</html>