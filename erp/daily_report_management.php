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
                        <h1 class="m-0 text-dark">Reports Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Reports Management</a></li>
                            <!-- <li class="breadcrumb-item active">Reports Management</li> -->
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12" style="margin:auto;">
                    <!-- general form elements -->
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Daily Report</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select a Branch </label>
                                    <select id="subBranchId" class="form-control select2">
                                        <option value="0" selected>All Branch</option>
                                        <?php
                                        $allSubBranchDetails = getAllDataOfSubBranchTable(" order by name");

                                        foreach ($allSubBranchDetails as $key => $value) {


                                            $subBranchDetails = getSubBranchDetailsFromId($allSubBranchDetails[$key]['id']);
                                        ?>
                                            <option value="<?php echo $subBranchDetails['id']; ?>">
                                                <?php echo $subBranchDetails['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="text" class="form-control" placeholder="Select From Date for Sales Report" id="fromDate"><br>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="text" class="form-control" placeholder="Select From Till for Sales Report" id="toDate"><br>

                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-4" style="margin: auto;">
                                    <button class="btn btn-primary btn-block" onclick="generateReport();">
                                        Generate Report
                                    </button>
                                </div>
                                <div class="col-md-4" style="margin: auto;" id="printingButtonHolder">
                                    <button class="btn btn-primary btn-block" onclick="printReport();">
                                        Print Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div id="allTables">
                    <?php
                    $subBranchId = 0;
                    $nullSubBranchId = null;
                    $fromDate = date("Y-m-d");
                    $toDate = date("Y-m-d");
                    ?>

                    <!-- ticket wise report -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Ticket Report</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="paymentMethodwiseReport" class="table table-bordered text-center table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Branch Name</th>
                                        <th>Total Ticket</th>
                                        <th>Total Bill</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    $totalTicket = 0;
                                    $totalBill = 0;
                                    $ticketReportDetails = orderCountReport($nullSubBranchId, $fromDate, $toDate);
                                    foreach ($ticketReportDetails as $key => $value) {

                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>

                                            <td class="text-center">
                                                <?php
                                                echo $ticketReportDetails[$key]['sub_branch_name'];
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <?php
                                                echo $ticketReportDetails[$key]['total_orders'];
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <?php
                                                echo $ticketReportDetails[$key]['total_bill'];
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $totalBill = $totalBill + $ticketReportDetails[$key]['total_bill'];
                                        $totalTicket = $totalTicket + $ticketReportDetails[$key]['total_orders'];
                                        $i++;
                                    }
                                    ?>

                                    <tr class="bg-info">
                                        <td colspan="2">
                                            <b>Summary</b>
                                        </td>
                                        <td>
                                            <b>
                                                <?php
                                                echo $totalTicket;
                                                ?>
                                            </b>
                                        </td>
                                        <td>
                                            <b>
                                                <?php
                                                echo $totalBill;
                                                ?>
                                            </b>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Branch Name</th>
                                        <th>Total Ticket</th>
                                        <th>Total Bill</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- ticket wise report -->

                    <!-- payment method wise report -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Payment Methodwise Report</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="paymentMethodwiseReport" class="table table-bordered text-center table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Payment Method</th>
                                        <th>Total Bill</th>
                                        <th>Total Paid Amount</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    $paymentMethodReportDetails = getPaymentMethodwiseReport($nullSubBranchId, null, $fromDate, $toDate);
                                    foreach ($paymentMethodReportDetails as $key => $value) {

                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($paymentMethodReportDetails[$key]['payment_method_id'] == 1) {
                                                    echo "Cash From Online Delivery";
                                                } elseif ($paymentMethodReportDetails[$key]['payment_method_id'] == 2) {
                                                    echo "Online Payment From Online Delivery";
                                                } else {
                                                    echo $paymentMethodReportDetails[$key]['payment_method_name'];
                                                }

                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                echo $paymentMethodReportDetails[$key]['total_bill'];
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($paymentMethodReportDetails[$key]['payment_method_id'] == 1) {
                                                    echo $paymentMethodReportDetails[$key]['total_bill'];
                                                } elseif ($paymentMethodReportDetails[$key]['payment_method_id'] == 2) {
                                                    echo $paymentMethodReportDetails[$key]['total_bill'];
                                                } else {
                                                    echo $paymentMethodReportDetails[$key]['total_paid_amount'];
                                                }
                                                ?>
                                            </td>

                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>

                                    <tr class="bg-info">
                                        <td colspan="2">
                                            <b>Summary</b>
                                        </td>
                                        <td>
                                            <b>
                                                <?php
                                                echo $paymentMethodReportDetails[$key]['grand_total_bill'];
                                                ?>
                                            </b>
                                        </td>
                                        <td>
                                            <b>
                                                <?php
                                                echo $paymentMethodReportDetails[$key]['grand_paid_amount'];
                                                ?>
                                            </b>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Payment Method</th>
                                        <th>Total Bill</th>
                                        <th>Total Paid Amount</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- payment method wise report -->


                    <?php if ($_SESSION['user_type'] == 1) { ?>
                        <!-- customer wise report -->
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Customer Wise Report</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="customerwiseReport" class="table table-bordered text-center table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Customer Name</th>
                                            <th>Total Orders</th>
                                            <th>Total Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        $customerReportDetails = getCustomerwiseReport($nullSubBranchId, null, $fromDate, $toDate);
                                        foreach ($customerReportDetails as $key => $value) {

                                        ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td class="text-center">
                                                    <?php

                                                    echo $customerReportDetails[$key]['customer_name'];

                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php

                                                    echo $customerReportDetails[$key]['number_of_order'];

                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    echo $customerReportDetails[$key]['total_bill'];
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>

                                        <tr class="bg-info">
                                            <td colspan="3">
                                                <b>Summary</b>
                                            </td>
                                            <td>
                                                <b>
                                                    <?php
                                                    echo $customerReportDetails[$key]['grand_total_bill'];
                                                    ?>
                                                </b>
                                            </td>

                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Customer Method</th>
                                            <th>Total Orders</th>
                                            <th>Total Bill</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- customer wise report -->
                    <?php } ?>
                    <!-- item wise report -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Item Wise Sales Report</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="itemwiseSalesReport" class="table table-bordered text-center table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Item Name</th>
                                        <th>Total Sold Unit</th>
                                        <th>Average Selling Price</th>
                                        <th>Total Sold (Taka)</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $itemwiseReportDetails = getItemwiseSalesReport(0, $subBranchId, $fromDate, $toDate);
                                    // print_r($itemwiseReportDetails);
                                    $totalItemWiseSalesQuantity = 0;
                                    $totalItemWiseSalesAmount = 0;
                                    foreach ($itemwiseReportDetails as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $itemwiseReportDetails[$key]['product_name'] . "(" . $itemwiseReportDetails[$key]['product_size_name'] . ")"; ?></td>
                                            <td class="text-center"><?php echo $itemwiseReportDetails[$key]['quantity']; ?></td>
                                            <td class="text-center"><?php echo round($itemwiseReportDetails[$key]['product_price'] / $itemwiseReportDetails[$key]['quantity'], 2); ?></td>
                                            <td class="text-center"><?php echo $itemwiseReportDetails[$key]['product_price']; ?></td>
                                        </tr>
                                    <?php
                                        $totalItemWiseSalesQuantity = $totalItemWiseSalesQuantity + $itemwiseReportDetails[$key]['quantity'];
                                        $totalItemWiseSalesAmount = $totalItemWiseSalesAmount + $itemwiseReportDetails[$key]['product_price'];
                                        $i++;
                                    } ?>

                                    <?php if ($_SESSION['user_type'] == 1 && $_SESSION['user_type'] == 6) { ?>

                                        <tr class="bg-info">
                                            <td colspan="2">
                                                <b>Summary</b>
                                            </td>
                                            <td>
                                                <b>
                                                    <?php
                                                    echo $totalItemWiseSalesQuantity;
                                                    ?>
                                                </b>
                                            </td>
                                            <td>
                                                <b>
                                                    <?php
                                                    if ($totalItemWiseSalesAmount > 0)
                                                        echo round($totalItemWiseSalesAmount / $totalItemWiseSalesQuantity);
                                                    else
                                                        echo "0";
                                                    ?>
                                                </b>
                                            </td>
                                            <td>
                                                <b>
                                                    <?php
                                                    echo $totalItemWiseSalesAmount;
                                                    ?>
                                                </b>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Item Name</th>
                                        <th>Total Sold Unit</th>
                                        <th>Average Selling Price</th>
                                        <th>Total Sold (Taka)</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- item wise report -->

                    <!-- item wise purchase report -->
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Item Wise Purchase Report</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="itemwisePurchaseReport" class="table table-bordered text-center table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Item Name</th>
                                        <th>Purchase Date</th>
                                        <th>Purchase Amount</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Current Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $totalPurchaseAmount = 0;
                                    $itemwisePurchaseReportDetails = getItemwisePurchaseReport(0, $subBranchId,  $fromDate, $toDate);
                                    foreach ($itemwisePurchaseReportDetails as $key => $value) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['ingredient_name']; ?></td>
                                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['purchase_date']; ?></td>
                                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['purchase_amount']; ?></td>
                                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['ingredient_unit_price']; ?></td>
                                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['ingredient_price']; ?></td>
                                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['current_stock']; ?></td>
                                        </tr>
                                    <?php
                                        $totalPurchaseAmount = $totalPurchaseAmount + $itemwisePurchaseReportDetails[$key]['ingredient_price'];
                                        $i++;
                                    }
                                    ?>

                                    <tr class="bg-info">
                                        <td colspan="6">
                                            <b>Total Purchase</b>
                                        </td>
                                        <td>
                                            <b>
                                                <?php
                                                echo "BDT " . $totalPurchaseAmount;
                                                ?>
                                            </b>
                                        </td>

                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Item Name</th>
                                        <th>Purchase Date</th>
                                        <th>Purchase Amount</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Current Stock</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- item wise purchase report -->


                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->







    <?php require 'includes/footer.php'; ?>

    <script>
        $("#printingButtonHolder").hide();
        $(function() {

            // $("#paymentMethodwiseReport").DataTable({
            //     "scrollX": true,
            //     "autoWidth": false
            // });

            $('#fromDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd'
            });

            $('#toDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd'
            });

            $('.select2').select2();



        });

        function generateReport() {
            $("#printingButtonHolder").show();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var subBranchId = $('#subBranchId option:selected').val();




            var date = (Date.parse(toDate) - Date.parse(fromDate)) / 86400000;
            if (date < 0) {
                // $('.loader-holder').hide();

                swal("Please Check the date", "From Date Cannot be Smaller Than Till Date", "warning");
                return false;
            }
            // alert(ingredientId + " " + fromDate + " " + toDate+" " +subBranchId);
            // return false;

            if (fromDate != "" && toDate != "") {

                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "dailyReport",
                            subBranchId: subBranchId,
                            fromDate: fromDate,
                            toDate: toDate
                        }
                    })
                    .done(function(response) {
                        if (response != "") {

                            $('#allTables').html(response);

                            $('.loader-holder').hide();

                        } else {

                            swal("Issue with the Network, Please Solve It !", "warning");


                        }

                    });


            } else {
                swal("Date Not Selected Perfectly !", "error");
                return false;
            }
        }

        function printReport() {
            $("#printingButtonHolder").hide();
            window.print();
        }
    </script>


    </body>

    </html>