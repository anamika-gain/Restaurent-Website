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
                        <h1 class="m-0 text-dark">Order Distribution</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Order Distribution</li>
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
                                    <th>Action</th>
                                    <!-- <th>Options</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfOrderProcessTable(" AND sub_branch_id = 0 Order BY order_time desc");
                                //$result = getAllDataOfOrderProcessTable(" Order BY order_time desc");

                                $j = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr <?php if ($result[$key]['status'] == 7) { ?> style="background-color: #ff2020;" <?php } else if ($result[$key]['status'] == 6 || ($result[$key]['table_id'] > 0 && $result[$key]['status'] == 4)) { ?> style="background-color: lime; ;" <?php } else if ($result[$key]['status'] == 1) { ?> style="background-color: #ffc107;" <?php } ?>>
                                        <td class="text-center"><?php echo $j; ?></td>

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
                                                                <td><?php echo $productItemDetails['name']; ?></td>
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

                                        <td class="text-center"><b><?php echo $result[$key]['delivery_address']; ?></b></td>
                                        <td class="text-center"><b><?php echo $clientDetails['mobile']; ?></b></td>

                                        <td class="text-center"><?php echo $result[$key]['order_time']; ?></td>

                                        <td class="text-center">

                                            <?php
                                            $branchId = $result[$key]['branch_id'];
                                            $subBranchDetails = getAllDataOfSubBranchTableFromBranchIdForWebsite($branchId, "");
                                            ?>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Assign</button>
                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    <div class="dropdown-menu text-center" role="menu">

                                                        <?php
                                                        if (count($subBranchDetails) == 0) { ?>
                                                            <a class="dropdown-item disabled" disabled href="#">No Sub Branch to Display</a>

                                                            <?php } else {

                                                            foreach ($subBranchDetails as $subBranchDetailsIndex => $value) { ?>


                                                                <a class="dropdown-item" href="#" onclick="transferOrder('<?php echo $subBranchDetails[$subBranchDetailsIndex]['id']; ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_id'] ?>')"><?php echo $subBranchDetails[$subBranchDetailsIndex]['name'] ?></a>

                                                        <?php }
                                                        } ?>




                                                    </div>
                                                </button>
                                            </div>

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
                                    <th>Delivery Address</th>
                                    <th>Mobile No.</th>
                                    <th>Order Time</th>
                                    <th>Action</th>
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



        function transferOrder(subBranchId, uniqueOrderId, userId) {

            // swal("Order Trasferred to", "Sub Branch: " + subBranchId + " ,Order ID: " + uniqueOrderId + " User ID: " + userId, "success");
            // return false;

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "updateOrderDistribution",
                        subBranchId: subBranchId,
                        uniqueOrderId: uniqueOrderId
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

        
    </script>


    </body>

    </html>