<?php require 'includes/easyfunctions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order The System</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
        .single-product-holder {
            border: 1px solid black;
            border-radius: 5px;
            margin: 20px 5px;
            box-shadow: 15px 10px 8px rgba(211, 211, 211, 1);
            padding: 15px 5px;
        }

        .single-product-holder:hover {
            background-color: rgba(155, 155, 155, 0.05);
            box-shadow: -15px -10px 6px rgba(211, 211, 211, 1);
            transition-timing-function: ease-in-out;
        }

        .single-product-holder a {
            text-decoration: none;
            color: inherit;
        }

        .image-holder {
            padding: 5px;
            margin: auto;
            height: 335px;
            width: 320px;
        }

        .image-holder img {
            border-radius: 8px;
            width: 310px;
            height: auto;
        }

        .name-holder {
            font-weight: bold;
            font-style: oblique;
        }


        @media only screen and (max-width: 768px) {
            .image-holder {
                padding: 0;
                margin: 0;
                width: 290px;
                height: auto;
            }
        }

        .cartHolder {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
            color: white;
        }
    </style>
</head>

<body>
    
        
        <span class="cartHolder text-center">
            <h2>Cart Details</h2>
            Total Products -> <?php echo totalCartProduct(); ?> <br>
            Total Items -> <?php echo totalCartItem(); ?> <br>
            <a href="checkout.php">CheckOut</a>
        </span>

    <div class="container" style="margin-top: 150px;">
        <h1 class="text-center">Demo Order Page</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php $productDetails = getAllDataOfProductTableForWebsiteView(2, 1, "");
                    foreach ($productDetails as $key => $value) {

                    ?>
                        <div class="col-md-4 text-center">
                            <div class="single-product-holder">
                                <a href="single_product.php?productId=<?php echo $productDetails[$key]['id']; ?>">
                                    <div class="image-holder">
                                        <img src="images/<?php echo $productDetails[$key]['photo']; ?>" alt="branch-name">
                                    </div>
                                    <div class="name-holder">
                                        <h2><?php echo $productDetails[$key]['name']; ?></h2>
                                    </div>
                                    <div class="price-holder">
                                        <h4>Starts From <?php echo getStartingPriceFromProductId($productDetails[$key]['id']); ?>/-</h4>
                                    </div>
                                    <span class="btn" style="border: 1px solid black;">Click For Details</span>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
</body>

</html>