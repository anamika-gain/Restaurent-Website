<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../includes/easyfunctions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kona Recipe</title>
    <style>
        table,
        tr {
            border: 1px solid black;
        }

        .holder{
            border: 1px solid #000000;
            margin: 10px;
            padding: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <?php

    $products = getAllDataOfProductTable("");

    //print_r($products);

    foreach ($products as $product) {
        //echo $product['photo'];
        $imagePath = "../images/" . $product['photo'];

        $productSizes = getAllDataOfProductSizeTableFromProductId($product['id']);

        foreach ($productSizes as $productSize) {

            $productSizeId = $productSize['id'];
            $productSizeName = $productSize['name'];
    ?>
            <span class="holder">
                <span style="display: inline-flex;">
                    <h1><?php echo $product['name'] . " - " . $productSizeName; ?></h1> <img src="../images/<?php echo  $product['photo']; ?>" height="100px" width="auto">
                </span>
                <table width="100%" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Ingredient Name</th>
                            <th>Amount </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //                                    $productId = $productDetails['id'];
                        $result = getAllDataOfProductIngredientTableFromProductSizeId($productSizeId);
                        $i = 1;
                        foreach ($result as $key => $value) {

                            $id = $result[$key]['id'];



                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                                    echo $ingredientDetails['ingredient_name'];
                                    //                                                $weightDetails = getDefaultWeightInNameFromIngredientId($ingredientDetails['id']);
                                    // echo " (".$weightDetails.")";
                                    ?></td>
                                <td>
                                    <?php echo $result[$key]['ingredient_amount']; ?>
                                    <?php
                                    $ingredientDefaultWeightName = getDefaultWeightInNameFromIngredientId($result[$key]['ingredient_id']);
                                    echo $ingredientDefaultWeightName;
                                    $productAllDetails = getProductDetailsFromId($result[$key]['product_id']);
                                    $productName = $productAllDetails['name'];
                                    ?>
                                </td>

                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </span>
    <?php
        }
    }

    ?>
</body>

</html>