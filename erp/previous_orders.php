<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php require 'includes/header.php'; ?>
<div class="wrapper">

    <?php require 'includes/navigation.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Order</a></li>
                            <li class="breadcrumb-item active">All Orders</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="orderTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Details</th>
                                    <th>Customer Name</th>
                                    <th>Delivery Address</th>
                                    <th>Mobile No.</th>
                                    <th>Order Time</th>
                                    <th>Cooking Time</th>
                                    <th>Delivery Details<br>Remarks</th>
                                    <th>Status</th>
                                    <th>Total Bill</th>
                                    <th>Action</th>
                                    <!-- <th>Options</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfOrderProcessTable(" AND sub_branch_id = '" . $_SESSION['user_sub_branch_id'] . "' ORDER BY `order_process`.`order_time` DESC");

                                $j = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr <?php if ($result[$key]['status'] == 7) { ?> style="background-color: #ff2020;" <?php } else if ($result[$key]['status'] == 6 || ($result[$key]['table_id'] > 0 && $result[$key]['status'] == 4)) { ?> style="background-color: lime; ;" <?php } else if ($result[$key]['status'] == 1) { ?> style="background-color: #ffc107;" <?php } ?>>
                                        <td class="text-center" style="min-width: 90px;">

                                            <?php
                                            if ($result[$key]['table_id'] > 0) {
                                                echo $tableId = "#T"  . $result[$key]['id'] . "-" . $result[$key]['table_id'];
                                            } else {
                                                echo $tableId = "#O" . $result[$key]['id'];
                                            }

                                            ?>

                                        </td>

                                        <td class="text-center">
                                            <div style="max-height:150px; max-width: 550px; overflow: auto;">

                                                <?php $orderDetails = getOrderProcessDetailsFromUniqueOrderId($result[$key]['unique_order_id']);
                                                $productItems = getAllDataOfOrderItemTableFromUniqueOrderId($result[$key]['unique_order_id']); ?>

                                                <table class="table table-sm">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Quantity</th>
                                                            <th scope="col">Options</th>
                                                            <th scope="col">Addons</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $orderItemCount = 1;
                                                        foreach ($productItems as $index => $value) {

                                                            $productItemDetails = getProductDetailsFromId($productItems[$index]['product_id']);
                                                        ?>
                                                            <tr>


                                                                <td><?php echo $orderItemCount; ?></th>
                                                                <td><?php echo $productItemDetails['name']; ?><br><?php $sizeDetails = getProductSizeDetailsFromProductSizeId($productItems[$index]['product_size_id']);
                                                                                                                    echo "(" . $sizeDetails['name'] . ")"; ?></td>
                                                                <td><?php echo $productItems[$index]['product_quantity'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    $productOptions = unserialize($productItems[$index]['product_option_ids']);
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

                                                                </td>

                                                                <td>
                                                                    <?php
                                                                    $productAddons = unserialize($productItems[$index]['product_addon_ids']);
                                                                    $subCategoryAddons = unserialize($productItems[$index]['sub_category_addon_ids']);

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

                                                                </td>




                                                            </tr>
                                                        <?php $orderItemCount++;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>



                                        </td>

                                        <td class="text-center"><?php $clientDetails = getClientDetailsFromUniqueOrderId($result[$key]['unique_order_id']);
                                                                echo $clientDetails['name']; ?></td>

                                        <td class="text-center"><b><?php echo $result[$key]['delivery_address']; ?></b>
                                            <hr><?php echo $result[$key]['remarks']; ?>
                                        </td>
                                        <td class="text-center"><b><?php echo $clientDetails['mobile']; ?></b></td>

                                        <td class="text-center"><?php echo $result[$key]['order_time']; ?></td>

                                        <td class="text-center">
                                            <?php if ($result[$key]['status'] == 7) {
                                                echo "Order Cancelled";
                                            } else { ?>
                                                Start: <?php echo $result[$key]['status'] < 3 ? "N/A" : $result[$key]['cooking_start_time']; ?>
                                                <br>
                                                End: <?php echo $result[$key]['status'] < 4 ? "N/A" : $result[$key]['cooking_finish_time'];
                                                    } ?>
                                        </td>

                                        <td class="text-center">

                                            <?php if ($result[$key]['status'] == 7) {

                                                echo "Order Cancelled";
                                            } else if ($result[$key]['table_id'] > 0 && $result[$key]['status'] < 4) {

                                                echo "Serve To Table: " . $result[$key]['table_id'];
                                            } else if ($result[$key]['table_id'] == 0 && $result[$key]['status'] < 6) { ?>

                                                <select class="form-control text-center" onchange="startDeliveryProcess('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>',this.value);">

                                                    <?php if ($result[$key]['delivery_man_id'] != '0') {
                                                        $currentDeliveryMan = getUserDetailsFromId($result[$key]['delivery_man_id']);
                                                    ?>

                                                        <option selected disabled value=""><b><?php echo $currentDeliveryMan['full_name'] . " -- " . $currentDeliveryMan['mobile_number']; ?></b></option>

                                                    <?php } else { ?>

                                                        <option selected disabled value="">--Select Delivery Man--</option>

                                                    <?php } ?>

                                                    <?php $deliveryMen = getAllDataOfUserTable(" and user_type = '8'");

                                                    for ($i = 0; $i < count($deliveryMen); $i++) { ?>

                                                        <option value="<?php echo $deliveryMen[$i]['id']; ?>"><?php echo $deliveryMen[$i]['full_name'] . " -- " . $deliveryMen[$i]['mobile_number']; ?></option>
                                                    <?php } ?>
                                                </select>

                                            <?php } else echo "<b>Order Completed!</b>"; ?>





                                        </td>
                                        <td class="text-center bg-gradient-warning"><b>
                                                <?php $status = $result[$key]['status'];
                                                if ($status == "1") echo "Ordered From Guest";
                                                else if ($status == "2") echo "Manager Approved";
                                                else if ($status == "3") echo "Cooking Started";
                                                else if ($status == "4") echo "Cooking Finished";
                                                else if ($status == "5") echo "Delivery Started";
                                                else if ($status == "6") echo "Delivery Finished";
                                                else if ($status == "7") echo "Order Cancelled";
                                                ?>
                                            </b>
                                        </td>
                                        <td>
                                            <?php echo $result[$key]['total_bill']; ?>
                                            <br>
                                            <?php
                                            $paymentMethodDetails = getPaymentMethodDetailsFromId($result[$key]['payment_method_id']);
                                            if ($paymentMethodDetails['id'] == 1) {
                                                echo "Cash From Online Delivery";
                                            } elseif ($paymentMethodDetails['id'] == 2) {
                                                echo "Online Payment From Online Delivery";
                                            } else {
                                                echo $paymentMethodDetails['name'];
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($result[$key]['status'] == 7) {
                                                echo "Order Cancelled";
                                            } else { ?>

                                                <a target="_blank" href="print/kot.php?orderId=<?php echo $result[$key]['unique_order_id']; ?>" class="btn btn-primary btn-sm">KOT</a>
                                                <i class="fa fa-print"></i>
                                                <a target="_blank" href="print/bill.php?orderId=<?php echo $result[$key]['unique_order_id']; ?>" class="btn btn-primary btn-sm">Bill</a>
                                                <br><br>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                        <div class="dropdown-menu text-center" role="menu">

                                                            <?php if ($result[$key]['status'] == 1) { ?>
                                                                <a class="dropdown-item bg-success" href="#" onclick="acceptOrder('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Accept</a>
                                                                <a class="dropdown-item bg-danger" href="#" onclick="declineOrder('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Cancel</a>

                                                            <?php } elseif (($result[$key]['status'] < 3) && ($result[$key]['status'] > 1)) { ?>
                                                                <a class="dropdown-item bg-danger" href="#" onclick="declineOrder('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Cancel</a>
                                                            <?php } else { ?>
                                                                <a class="dropdown-item disabled" disabled href="#">No Actions To Take</a>
                                                            <?php } ?>

                                                        </div>
                                                    </button>
                                                </div>
                                            <?php } ?>
                                        </td>


                                    </tr>
                                <?php
                                    $j++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Order Details</th>
                                    <th>Customer Name</th>
                                    <th>Delivery Address<br>Remarks</th>
                                    <th>Mobile No.</th>
                                    <th>Order Time</th>
                                    <th>Cooking Time</th>
                                    <th>Delivery Details</th>
                                    <th>Status</th>
                                    <th>Total Bill</th>
                                    <th>Action</th>
                                    <!-- <th>Options</th> -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- <audio id="myAudio">
        <source src="Sound/notification.mp3" type="audio/mpeg">
    </audio> -->

    <input type="hidden" id="uniqueIdViewing" value="0">




    <!-- edit Requisition Modal -->
    <div class="modal fade" id="editRequisitionModal">

    </div>
    <!-- add Requisition Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#orderTable").DataTable({
                "pageLength": 50,
                "scrollX": true,
                "order": [
                    [5, "desc"]
                ],
                // "responsive": true,
                "autoWidth": false
            });



        });


        function startDeliveryProcess(branchId, subBranchId, uniqueOrderId, userTypeId, userId, deliveryManId) {
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "updateOrderProcess",
                        branchId: branchId,
                        subBranchId: subBranchId,
                        uniqueOrderId: uniqueOrderId,
                        userTypeId: userTypeId,
                        userId: userId,
                        deliveryManId: deliveryManId,
                        deliveryManSelected: "1"
                    }
                })
                .done(function(response) {

                    //console.log(response);

                    $('.loader-holder').hide();

                    if (parseInt(response) == 1) {

                        swal("Request Successful !", {
                            icon: "success",
                        });

                        setTimeout(
                            function() {
                                location.reload();
                            }, 2000);

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });
        }

        function stopDeliveryProcess() {
            swal("Stopped!", "", "success");
        }

        function acceptOrder(branchId, subBranchId, uniqueOrderId, userTypeId, userId) {

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "updateOrderProcess",
                        branchId: branchId,
                        subBranchId: subBranchId,
                        uniqueOrderId: uniqueOrderId,
                        userTypeId: userTypeId,
                        userId: userId,
                        orderAccepted: "1"
                    }
                })
                .done(function(response) {

                    //console.log(response);

                    $('.loader-holder').hide();

                    if (parseInt(response) == 1) {

                        swal("Request Successful !", {
                            icon: "success",
                        });

                        setTimeout(
                            function() {
                                location.reload();
                            }, 2000);

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });
        }

        function declineOrder(branchId, subBranchId, uniqueOrderId, userTypeId, userId) {

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "updateOrderProcess",
                        branchId: branchId,
                        subBranchId: subBranchId,
                        uniqueOrderId: uniqueOrderId,
                        userTypeId: userTypeId,
                        userId: userId,
                        orderDeclined: "1"
                    }
                })
                .done(function(response) {

                    //console.log(response);

                    $('.loader-holder').hide();

                    if (parseInt(response) == 1) {

                        swal("Request Successful !", {
                            icon: "success",
                        });

                        setTimeout(
                            function() {
                                reloadTable();
                            }, 2000);

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });
        }


        //var x = document.getElementById("myAudio");

        setInterval(function() {
            //location.reload();

            showNotificationFunction();

        }, 10000);


        function stopNotification(uniqueOrderId) {
            //x.loop = false;
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "stopNotification",
                        uniqueOrderId: uniqueOrderId
                    }
                })
                .done(function(response) {


                    if (parseInt(response) == 1) {

                        reloadTable();

                        $('#newOrderSign').css('visibility', 'hidden');

                        swal("Alert Turned Off !", {
                            icon: "success",
                        });



                    }
                });
        }


        // function playNotification() {
        //     x.loop = true;
        //     x.play();
        // }


        function showNotificationFunction() {
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "showNotification"
                    }
                })
                .done(function(response) {

                    if (parseInt(response) > 0) {

                        //playNotification();
                        reloadTable();
                        $('#newOrderSign').css('visibility', 'visible');


                    } else {
                        //x.loop = false;
                    }
                });
        }


        function reloadTable() {
            $('.loader-holder').show();



            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "orderManagementTable"
                    }
                })
                .done(function(response) {

                    $('#orderTable').html(response);


                    $('.loader-holder').hide();

                });
        }
    </script>


    </body>

    </html>