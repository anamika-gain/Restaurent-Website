<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'includes/easyfunctions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order The System</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <style>
    </style>
</head>

<body>
    <div class="container" style="margin-top: 50px;">
        <h1 class="text-center">Demo Checkout Page</h1>
        <br><br><br>
        <?php
        if (!isset($_COOKIE['client_id'])) {
            $showValues = false;
        ?>
            <h2>Already Registered ? sign in</h2>
            <form action="login.php" method="POST">
                <input type="hidden" name="function" value="felogin">
                <input type="hidden" name="returnUrl" value="checkout.php">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mobileNumber">Mobile Number</label>
                            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Regestered Mb No">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="password">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-primary"></button>
                            <input type="submit" value="Login" class="form-control btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        <?php
        } else {
            $showValues = true;
        }
        ?>

        <form action="ssl/sslcheckout.php" method="post" id="clintDataForm">
            <div class="clientInfo">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-center bg-info">Client Info</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clientName">Name</label>
                            <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Full Name" value="<?php if ($showValues) {
                                                                                                                                            echo $_COOKIE['client_name'];
                                                                                                                                        } ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clientEmail">Email</label>
                            <input type="text" class="form-control" id="clientEmail" name="clientEmail" placeholder="Email" value="<?php if ($showValues) {
                                                                                                                                        echo $_COOKIE['client_email'];
                                                                                                                                    } ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clientMobile">Mobile</label>
                            <input type="text" class="form-control" id="clientMobile" name="clientMobile" placeholder="Mobile" value="<?php if ($showValues) {
                                                                                                                                            echo $_COOKIE['client_mobile'];
                                                                                                                                        } ?>">
                            
                            <input type="hidden" class="form-control" id="clientDOB" name="clientDOB">
                            <input type="hidden" class="form-control" id="clientPaymentMethod" name="clientPaymentMethod">
                            <input type="hidden" class="form-control" value="perfectOrder" name="funName">
                            <input type="hidden" class="form-control" value="<?php if ($showValues) {
                                                                                    echo $_COOKIE['client_id'];
                                                                                } else {
                                                                                    echo "0";
                                                                                } ?>" name="clientId">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="clientDate">Birth Date</label>

                            <select class="form-control" id="clientDate" name="clientDate">
                                <option name="" value="" style="display:none;">DD</option>

                                <?php

                                for ($i = 1; $i < 32; $i++) {

                                ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="clientMonth">Birth Month</label>
                            <!-- <input type="month" id="clientMonth" name="clientMonth"> -->
                            <select class="form-control" id="clientMonth" name="clientMonth">
                                <option name="" value="" style="display:none;">MM</option>
                                <option name="January" value="1">January</option>
                                <option name="February" value="2">February</option>
                                <option name="March" value="3">March</option>
                                <option name="April" value="4">April</option>
                                <option name="May" value="5">May</option>
                                <option name="June" value="6">June</option>
                                <option name="July" value="7">July</option>
                                <option name="August" value="8">August</option>
                                <option name="September" value="9">September</option>
                                <option name="October" value="10">October</option>
                                <option name="November" value="11">November</option>
                                <option name="December" value="12">December</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="clientAddress">Address</label>
                            <textarea class="form-control" id="clientAddress" name="clientAddress" placeholder="Client Address"><?php if ($showValues) {
                                                                                                                                    echo $_COOKIE['client_address'];
                                                                                                                                } ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="clientDeliveryAddress">Delivery Address</label>
                            <textarea class="form-control" id="clientDeliveryAddress" name="clientDeliveryAddress" placeholder="Delivery Address"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="sameAddress">If Same</label><br>
                            <input type="checkbox" id="sameAddress" onclick="sameAddressFun();">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($showValues == false) {
            ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clientPassword">Password</label>
                            <input type="password" class="form-control" id="clientPassword" name="clientPassword" placeholder="Client Password">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="retypePassword">Retype Password</label>
                            <input type="password" class="form-control" id="retypePassword" name="retypePassword" placeholder="Client Password">
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </form>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center bg-info">Cart Info</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Options</th>
                            <th scope="col">Addons</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $cartDetails = $_SESSION['cart'];
                        $totalPrice = 0;
                        foreach ($cartDetails as $key => $value) {


                        ?>
                            <tr>

                                <th scope="row"><?php echo $i; ?></th>
                                <td><img src="images/<?php echo $cartDetails[$key]['product_image']; ?>" height="100px" width="auto" alt=""></td>
                                <td><?php echo $cartDetails[$key]['product_name']; ?></td>
                                <td><?php echo $cartDetails[$key]['product_size_name']; ?></td>
                                <td>
                                    <?php
                                    if (count($cartDetails[$key]['product_option_ids']) > 0) {
                                        foreach ($cartDetails[$key]['product_option_ids'] as $key2 => $value) {
                                            $optionDetails = getAllDataOfProductOptionTableFromProductOptionId($cartDetails[$key]['product_option_ids'][$key2]);
                                            echo $optionDetails['name'] . "<br>---<br>";
                                        }
                                    } else {
                                        echo "N/A";
                                    }

                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (count($cartDetails[$key]['product_addon_ids']) > 0) {
                                        foreach ($cartDetails[$key]['product_addon_ids'] as $key2 => $value) {
                                            $addonDetails = getAllDataOfProductAddonTableFromProductAddonId($cartDetails[$key]['product_addon_ids'][$key2]);
                                            echo $addonDetails['name'] . "<br>";
                                        }
                                    } else {
                                        echo "N/A";
                                    }

                                    ?>
                                </td>
                                <td><?php echo ($cartDetails[$key]['product_price'] / $cartDetails[$key]['quantity']); ?></td>
                                <td><?php echo $cartDetails[$key]['quantity']; ?></td>
                                <td><?php echo $cartDetails[$key]['product_price']; ?></td>
                                <th scope="row"><button class="btn btn-danger" onclick="deleteProduct('<?php echo $cartDetails[$key]['product_id']; ?>', '<?php echo $cartDetails[$key]['product_size_id']; ?>', '<?php echo implode(",", $cartDetails[$key]['product_option_ids']); ?>', '<?php echo implode(",", $cartDetails[$key]['product_addon_ids']); ?>')">Delete</button></th>
                            </tr>

                        <?php
                            $i++;
                            $totalPrice = $totalPrice + $cartDetails[$key]['product_price'];
                        } ?>

                        <tr>
                            <td colspan="8" class="text-center">
                                Total
                            </td>
                            <td>
                                <?php echo $totalPrice . "/-"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                Service Charge
                                <?php $serviceChargePercent = (float)getValueFromExtraTableByItemName('service_charge'); ?>
                            </td>
                            <td>
                                <?php echo $totalServiceCharge =  totalServiceCharge($totalPrice, $serviceChargePercent);
                                echo "/-"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                VAT
                                <?php $vatPercent = (float)getValueFromExtraTableByItemName('VAT'); ?>
                            </td>
                            <td>
                                <?php
                                $beforTax = $totalPrice + $totalServiceCharge;
                                echo totalTax($beforTax, $vatPercent) . "/-";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="text-center">
                                Grand Total
                            </td>
                            <td>
                                <span id="grandTotal"><?php echo grandTotalFromBasicAmount($totalPrice, $serviceChargePercent, $vatPercent) . "/-"; ?></span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center bg-info">Payment Method</h2>
            </div>
        </div>

        <div class="row text-center">
            <div class="form-group">

                <?php
                $paymentMethods = getAllDataOfPaymentMethodTable("");
                foreach ($paymentMethods as $key => $value) {
                ?>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-control form-check-input" name="paymentMethod" value="<?php echo $paymentMethods[$key]['id']; ?>" onclick="paymentMethodSelected();"><?php echo $paymentMethods[$key]['name']; ?>
                        </label>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>

        <div class="row">
            <button type="button" class="btn btn-primary" style="visibility: hidden;" id="payOnlieButton" onclick="nextStep()">Continue to Payment</button>
            <button type="button" class="btn btn-primary" style="visibility: hidden;" id="cashOnDeliveryButton" onclick="nextStep()">Confirm Order</button>
        </div>
    </div>

    <br><br><br><br><br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        <?php
        if ($showValues) {
            $storedDate = strtok($_COOKIE['client_dob'], '-');
            $storedMonth = explode('-', $_COOKIE['client_dob'], 2)[1];
        }
        ?>
        var $showValuesJS = <?php if ($showValues) {
                                echo $showValues;
                            } else {
                                echo "false";
                            } ?>;
        if ($showValuesJS) {
            var storedDate = <?php echo strtok($_COOKIE['client_dob'], '-'); ?>;
            var storedMonth = <?php echo explode('-', $_COOKIE['client_dob'], 2)[1]; ?>;
            $("#clientMonth").val(storedMonth).change();
            $("#clientDate").val(storedDate).change();
        }

        function sameAddressFun() {
            if ($('#sameAddress').is(":checked")) {
                //alert("checked!");
                $("#clientDeliveryAddress").val($("#clientAddress").val());

            }
        }

        function paymentMethodSelected() {
            var id = document.querySelector('input[name="paymentMethod"]:checked').value;
            if (id == 1) {
                $('#payOnlieButton').css("visibility", "hidden");
                $('#cashOnDeliveryButton').css("visibility", "visible");
            } else if (id == 2) {
                $('#payOnlieButton').css("visibility", "visible");
                $('#cashOnDeliveryButton').css("visibility", "hidden");
            } else {
                $('#payOnlieButton').css("visibility", "hidden");
                $('#cashOnDeliveryButton').css("visibility", "visible");
            }
        }

        function nextStep() {
            var paymentId = document.querySelector('input[name="paymentMethod"]:checked').value;
            $('#clientPaymentMethod').val(paymentId);
            var clientName = $('#clientName').val();
            var clientEmail = $('#clientEmail').val();
            var clientMobile = $('#clientMobile').val();
            var clientDOB = $('#clientDate').val() + "-" + $('#clientMonth').val();
            var clientAddress = $('#clientAddress').val();
            var clientDeliveryAddress = $('#clientDeliveryAddress').val();
            var clientPassword = $('#clientPassword').val();
            var retypePassword = $('#retypePassword').val();
            $('#clientDOB').val(clientDOB);

            if (paymentId != "" || clientName != "" || clientEmail != "" || clientMobile != "" || clientDOB != "" || clientAddress != "" || clientDeliveryAddress != "") {
                if (clientPassword == retypePassword) {
                    $('#clintDataForm').submit();
                } else {
                    alert('Password Does not match');
                }

            }
        }

        function deleteProduct(productId, productSizeId, productOptionIds, productAddonIds) {

            $.ajax({
                    method: "get",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "deleteSingleItemFromCart",
                        productId: productId,
                        productSizeId: productSizeId,
                        productOptionIds: productOptionIds,
                        productAddonIds: productAddonIds

                    }
                })
                .done(function(response) {

                    location.reload();

                });

        }
    </script>
</body>

</html>