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
                        <h1 class="m-0 text-dark">Order Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Order Management</li>
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
                                    <th>Order ID</th>
                                    <th>Order Details</th>
                                    <th>Order Time</th>
                                    <th>Manager Approve Time</th>
                                    <th>Status</th>

                                    <!-- <th>Options</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfOrderProcessTable(" and status>1 Order by order_time desc LIMIT 50");

                                $j = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr <?php if ($result[$key]['status'] == 7) { ?> style="background-color: #ff2020;" <?php } else if (($result[$key]['status'] >= 4)) { ?> style="background-color: lime; " <?php } else if ($result[$key]['status'] == 2) { ?> style="background-color: #ffc107;" <?php } ?>>

                                        <td class="text-center"><?php echo $j; ?></td>

                                        <td class="text-center">
                                            <b class="text-center text-lg">
                                                <?php
                                                if ($result[$key]['table_id'] > 0) {
                                                    echo $tableId = "#T" . $result[$key]['table_id']; 
                                                } else{
                                                    echo $tableId = "#O" . $result[$key]['table_id'] . $result[$key]['id'];
                                                }
                                                 
                                                ?>
                                            </b>
                                        </td>

                                        <td class="text-center">

                                            <button class="btn btn-lg bg-gradient-danger" onclick="fetchChefOrderDetails('<?php echo $tableId; ?>','<?php echo $result[$key]['unique_order_id']; ?>');">View Order Details</button>

                                        </td>



                                        <td class="text-center"><?php echo $result[$key]['order_time']; ?></td>

                                        <td class="text-center">
                                            <?php
                                            $managerApproveTime = $result[$key]['manager_approve_time'];
                                            echo $result[$key]['manager_approve_time']; ?>
                                        </td>



                                        <td class="text-center bg-gradient-info"><b>
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



                                    </tr>
                                <?php
                                    $j++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Order Details</th>
                                    <th>Order Time</th>
                                    <th>Manager Approve Time</th>
                                    <th>Status</th>
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

    <input type="hidden" id="uniqueIdViewing" value="0">




    <!-- edit Requisition Modal -->

    <!-- add Requisition Modal -->
    <div id="viewOrderDetailsModal">

    </div>


    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#orderTable").DataTable({
                "pageLength": 50,
                "scrollX": true,
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
                        deliveryStartTime: "1"
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
            $('.loader-holder').show();
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
                                location.reload();
                            }, 2000);

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });
        }

        function fetchChefOrderDetails(tableId, uniqueOrderId) {

            if (tableId == "" || uniqueOrderId == "") {
                return false;
            }

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "getOrderDetailsForCheffFromUniqueOrderId",
                        tableId: tableId,
                        uniqueOrderId: uniqueOrderId
                    }
                })
                .done(function(response) {
                    $('.loader-holder').hide();

                    if (response != "") {

                        $('#viewOrderDetailsModal').html(response);
                        $('#viewOrderDetails').modal();

                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });

        }

        function startCooking(branchId, subBranchId, uniqueOrderId, userTypeId, userId) {
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
                        cookingStartTime: "1"
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

        function finishCooking(branchId, subBranchId, uniqueOrderId, userTypeId, userId) {
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
                        cookingFinishTime: "1"
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