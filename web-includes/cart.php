<h2>Order Summery <span class="count"><?php echo totalCartProduct(); ?></span></h2>
<ul class="products">
    <?php
    $i = 1;
    $cartDetails = $_SESSION['cart'];
    $totalPrice = 0;
    //print_r($cartDetails);
    foreach ($cartDetails as $key => $value) {

    ?>
        <li class="product">
            <a href="#" class="product-link">
                <span class="product-image">
                    <img src="erp/images/<?php echo $cartDetails[$key]['product_image']; ?>" alt="<?php echo $cartDetails[$key]['product_name']; ?>">
                </span>
                <span class="product-details">
                    <h3><?php echo $cartDetails[$key]['product_name']; ?></h3>
                    <p><b>Size:</b> <?php echo $cartDetails[$key]['product_size_name']; ?></p>
                    <p><b>Options:</b>


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
                    <p>
                        <b>Addons:</b>
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
                    <p>
                        <b>Extra Addons Price(<?php echo $cartDetails[$key]['product_extra_option']; ?>):</b>
                        <?php echo "৳" . $cartDetails[$key]['product_extra_option_price']; ?>
                    </p>
                    <?php
                    $productId = $cartDetails[$key]['product_id'];
                    $productSizeId = $cartDetails[$key]['product_size_id'];
                    $productOptionIds = implode(",", $cartDetails[$key]['product_option_ids']);
                    $productAddonIds = implode(",", $cartDetails[$key]['product_addon_ids']);
                    $subCategoryAddonIds = implode(",", $cartDetails[$key]['sub_category_addon_ids']);
                    ?>
                    <span class="qty-price" style="display: block;">
                        <span class="qty">
                            <p><b>Quantity:</b> </p>
                            <button class="minus-button" id="minus-button-1">-</button>
                            <input type="number" id="quantity<?php echo $i; ?><?php echo $productId; ?><?php echo $productSizeId; ?>" class="qty-input" step="1" min="1" max="50" name="qty-input" value="<?php echo  $cartDetails[$key]['quantity']; ?>" pattern="[0-9]*" title="Quantity" inputmode="numeric" productId='<?php echo $productId; ?>' productSizeId='<?php echo $productSizeId; ?>' productOptionIds='<?php echo $productOptionIds; ?>' productAddonIds='<?php echo $productAddonIds; ?>' subCategoryAddonIds='<?php echo $subCategoryAddonIds; ?>'>
                            <button class="plus-button" id="plus-button-1">+</button>
                        </span>
                        <span class="price">৳ <?php echo  $cartDetails[$key]['product_price']; ?></span>
                    </span>
                </span>
            </a>

            <a href="#remove" class="remove-button" onclick="removeSingleCartItem('<?php echo $productId; ?>', '<?php echo $productSizeId; ?>', '<?php echo $productOptionIds; ?>', '<?php echo $productAddonIds; ?>', '<?php echo $subCategoryAddonIds; ?>');return false;"><span class="remove-icon">X</span></a>
            <!-- <button class="remove-button"><span class="remove-icon">X</span></button> -->
        </li>

    <?php
        $i++;
        $totalPrice = $totalPrice + $cartDetails[$key]['product_price'];
    }
    $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
    $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];
    ?>
</ul>
<div class="totals">
    <div class="subtotal">
        <span class="label">Total:</span> <span class="amount">৳ <?php echo  $totalPrice; ?></span>
    </div>

    <!--<div class="subtotal">
                        <span class="label">Service Charge:</span> <span class="amount">৳ <?php echo  $serviceCharge = totalServiceCharge($totalPrice, $serviceChargePercentage);
                                                                                            $beforeVat = $totalPrice + $serviceCharge; ?></span>
                    </div>
                    <div class="subtotal">
                        <span class="label">VAT:</span> <span class="amount">৳ <?php echo  totalTax($beforeVat, $taxPercentage); ?></span>
                    </div>
                    <div class="subtotal">
                        <span class="label"><strong>Total:</strong></span> <span class="amount"><strong>৳ <?php echo  grandTotalFromBasicAmount($totalPrice, $serviceChargePercentage, $taxPercentage); ?></strong></span>
                    </div> -->
</div>