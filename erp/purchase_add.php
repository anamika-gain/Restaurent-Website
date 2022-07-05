<?php
require 'includes/header.php';
if ($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 5) {
} else {

    header('Location: purchase_list.php');
}
?>
<div class="wrapper">
    <?php require 'includes/navigation.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Purchase Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Purchase Management</a></li>
                            <li class="breadcrumb-item active">Purchase Add</li>
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
                        <h3 class="card-title">Place A Purchase</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Requisition ID</label>
                                    <select class="form-control select2bs4" style="width: 100%;" onchange="loadRequisitionItemsForPurchaseAdd(this.value);" id="requisitionId">
                                        <option selected="selected" value="">Select Requisition ID</option>
                                        <!-- AND status = 4 -->
                                        <?php $allPurchaseRequisition = getAllDataOfRequisitionProcessTableForPurchaseListSelect(" ORDER BY id DESC"); ?>
                                        <?php foreach ($allPurchaseRequisition as $data => $key) { ?>

                                            <option title="<?php echo "Requisition Time: " . $allPurchaseRequisition[$data]['requisition_approval_time'] . "  ------   Total Items: " . $allPurchaseRequisition[$data]['total_item']; ?>" value="<?php echo intval($allPurchaseRequisition[$data]['unique_requisition_id']); ?>"><?php echo $allPurchaseRequisition[$data]['unique_requisition_id']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Purchase Date & Time</label>
                                    <input type="text" class="form-control" placeholder="Select Purchase Date & Time" id="purchaseDate"><br>

                                </div>
                            </div>
                        </div>
                        <div class="row" id="requisitionPurchaseTableHolder" style="overflow-x: scroll;">


                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4" style="margin:auto;">
                <button class="btn btn-primary btn-block" onclick="savePurchase()" id="savePurchaseButton">Add Purchase</button>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require 'includes/footer.php'; ?>
    <script>
        $(function() {
            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $('#purchaseDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd HH:mm:ss'
            });

            $('#savePurchaseButton').hide();
        });

        function loadRequisitionItemsForPurchaseAdd(uniqueRequisitionId) {
            //console.log(uniqueRequisitionId);
            $('.loader-holder').show();

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "loadRequisitionItemsForPurchaseAdd",
                        uniqueRequisitionId: uniqueRequisitionId
                    }
                })
                .done(function(response) {

                    //console.log(response);



                    if (response != "") {

                        $('#requisitionPurchaseTableHolder').html(response);


                        $('.select2bs4').select2({
                            theme: 'bootstrap4'
                        });


                        $(".expiryDate").each(function() {
                            $(this).dateTimePicker({
                                mode: 'dateTime',
                                format: 'yyyy-MM-dd HH:mm:ss'
                            });
                        });

                        if (($('table#purchaseAddTable > tbody > tr:last').index() + 1) > 0) {
                            $('#savePurchaseButton').show();
                        } else {
                            $('#savePurchaseButton').hide();
                        }


                        $('.loader-holder').hide();
                        swal("Request Successful !", {
                            icon: "success",
                            timer: 1500
                        });

                    } else {
                        $('.loader-holder').hide();
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });

        }


        function savePurchase() {

            $('.loader-holder').show();

            var purchasedRequisitionItemTableId = $('input[name="purchasedRequisitionItemTableId[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedIngredientId = $('input[name="purchasedIngredientId[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedRequisitionAmount = $('input[name="purchasedRequisitionAmount[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedAmount = $('input[name="purchasedAmount[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedUnitPrice = $('input[name="purchasedUnitPrice[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedTotalPrice = $('input[name="purchasedTotalPrice[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedTotalPaid = $('input[name="purchasedTotalPaid[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedIngredientExpiryDate = $('input[name="purchasedIngredientExpiryDate[]"]').map(function() {
                return this.value;
            }).get();
            var purchasedVendorId = $('select[name="purchasedVendorId[]"]').map(function() {
                return this.value;
            }).get();

            var requisitionId = $('#requisitionId').val();
            var purchaseDate = $('#purchaseDate').val();



            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "savePurchase",
                        purchasedRequisitionItemTableId: purchasedRequisitionItemTableId,
                        purchasedIngredientId: purchasedIngredientId,
                        purchasedRequisitionAmount: purchasedRequisitionAmount,
                        purchasedAmount: purchasedAmount,
                        purchasedUnitPrice: purchasedUnitPrice,
                        purchasedTotalPrice: purchasedTotalPrice,
                        purchasedTotalPaid: purchasedTotalPaid,
                        purchasedVendorId: purchasedVendorId,
                        purchaseDate: purchaseDate,
                        requisitionId: requisitionId,
                        purchasedIngredientExpiryDate: purchasedIngredientExpiryDate
                    }
                })
                .done(function(response) {

                    //console.log(response);
                    response = response.trim();

                    $('.loader-holder').hide();


                    if (response != "") {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    } else {
                        swal("Request Successful !", {
                            icon: "success",
                        });

                        setTimeout(
                            function() {
                                location.reload();
                            }, 2000);
                    }

                });


        }
    </script>
    </body>

    </html>