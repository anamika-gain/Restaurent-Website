<?php
require 'includes/easyfunctions.php';
$productDetails = getProductDetailsFromId($_REQUEST['productId']);
$productSizeDetails = getAllDataOfProductSizeTableFromProductId($productDetails['id']);
$productAddonDetails = getAllDataOfProductAddonTableFromProductId($_REQUEST['productId']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productDetails['name']; ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        ul {
            list-style-type: none;
        }

        li {
            display: inline-block;
        }

        input[type="checkbox"],
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
        }

        label:before {
            background-color: white;
            color: white;
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
        }

        :checked+label:before {
            content: "✓";
            background-color: grey;
            transform: scale(1);
        }

        :checked+label img {
            transform: scale(0.9);
            /* box-shadow: 0 0 5px #333; */
            z-index: -1;
        }
    </style>
</head>

<body>

    <div class="container">
        <form action="addtocart.php">
            <input type="hidden" name="productId" value="<?php echo $_REQUEST['productId']; ?>">
            <h1 class="text-center">Details Of <?php echo $productDetails['name']; ?></h1>
            <div class="img-holder text-center">
                <img src="images/<?php echo $productDetails['photo']; ?>" alt="<?php echo $productDetails['name']; ?>">
            </div>
            <div class="size-holder">
                <h2 class="text-center">Select A Size</h2>
                <div class="row text-center">
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
                        <div class="col-md-4 text-center">
                            <input type="radio" id="ps<?php echo $productSizeDetails[$key]['id']; ?>" name="productSizeId" value="<?php echo $productSizeDetails[$key]['id']; ?>" onchange="getProductOtionDetailsFromSizeId(this.id)">
                            <label for="ps<?php echo $productSizeDetails[$key]['id']; ?>">
                                <?php echo $productSizeDetails[$key]['name']; ?><br>
                                Base Price <span id="psp<?php echo $productSizeDetails[$key]['id']; ?>"><?php echo $productPrice; ?></span>
                            </label><br>
                        </div>
                    <?php
                    }
                    ?>
                    <input type="hidden" name="productSizePrice" value="<?php echo $_REQUEST['productId']; ?>" id="productSizePrice">
                </div>
            </div>
            <div class="option-holder" id="optionHolder">

            </div>

            <div class="addon-holder">
                <h2 class="text-center">Choose Your Addon</h2>
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
                                <label for="pc<?php echo $productAddonDetails[$key]['id']; ?>">
                                    <img src="images/<?php echo $productAddonDetails[$key]['image']; ?>">
                                    <h4><?php echo $productAddonDetails[$key]['name']; ?></h4>
                                    <h5><?php echo "Add BDT " . $productAddonPrice; ?></h5>
                                </label>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="quantity-holder">
                <label for="quantityId">Enter Your Quantity</label>
                <input type="number" name="productQuntity" value="1" min="1" max="20" id="quantityId">
            </div>
            <br><br><br>

            <input type="submit" value="Add To Cart" class="btn btn-primary">
            <span>Total Price of the Product BDT 320</span>
        </form>
                        <br><br>
        <a href="products_order.php" class="btn btn-primary text-center">Back To Order Page</a>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>

    <script>
        function getProductOtionDetailsFromSizeId(id) {
            var productSizeId = id.slice(2);
            $('#productSizePrice').val($('#psp'+productSizeId).html());
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "getProductOtionDetailsFromSizeId",
                        productSizeId: productSizeId
                    }
                })
                .done(function(response) {

                    //console.log(response);

                    $('.loader-holder').hide();

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