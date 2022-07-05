<?php
    require 'includes/header.php';

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
                            <li class="breadcrumb-item active">Purchase List</li>
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
                        <h3 class="card-title">Requisition List</h3>
                        <span class="float-right"><a class="btn bg-gradient-primary" href="purchase_add.php">Add</a></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="purchaseRequisitionTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Unique<br>Requisition ID</th>
                                    <th>Total Items</th>
                                    <th>Requisition <br>Approval Time</th>
                                    <th>Remarks</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfRequisitionProcessTableForPurchaseList("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>

                                        <td class="text-center"><b><?php echo $result[$key]['unique_requisition_id']; ?></b></td>
                                        <td class="text-center"><?php echo $result[$key]['total_item']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['requisition_approval_time']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['remarks']; ?></td>

                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm " onclick="viewRequisitionInPurchase('<?php echo $result[$key]['unique_requisition_id']; ?>', '<?php echo $result[$key]['requisition_approval_time']; ?>')"><i class="fa fa-eye"></i> View</button>
                                            <button class="btn btn-danger btn-sm " onclick=""><i class="fa fa-trash"></i> Print</button>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Unique<br>Requisition ID</th>
                                    <th>Total Items</th>
                                    <th>Requisition <br>Approval Time</th>
                                    <th>Remarks</th>
                                    <th>Options</th>
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

            $("#purchaseRequisitionTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });



        });



        function viewRequisitionInPurchase(uniqueId, requisitionDate) {
            $('.loader-holder').show();

            $('#uniqueIdViewing').val(uniqueId);

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "viewRequisitionInPurchase",
                        uniqueId: uniqueId,
                        requisitionDate: requisitionDate
                    }
                })
                .done(function(response) {

                    $('#editRequisitionModal').html(response);

                    $('.loader-holder').hide();

                    if (response != "") {

                        swal(uniqueId + " Fetched Successfully !", {
                            icon: "success",
                            timer: 1500
                        });

                        $('#editRequisitionModal').modal('show');

                    } else {
                        swal(uniqueId + " can not be fetched !", {
                            icon: "error",
                        });
                    }
                });
        }


        function updateRequisitionForm(arrayName, uName, status) {
            var arrayList = $('input[name="' + arrayName + '[]"]').map(function() {
                return this.value;
            }).get();
            var ids = $('input[name="itemTableId[]"]').map(function() {
                return this.value;
            }).get();
            var uniqueId = $('#uniqueIdViewing').val();


            $.ajax({
                    method: "get",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "updateRequisition",
                        arrayList: arrayList,
                        ids: ids,
                        uName: uName,
                        status: status,
                        uniqueId: uniqueId
                    }
                })
                .done(function(response) {

                    $('.loader-holder').hide();

                    console.log(response);

                    if (parseInt(response) == 1) {

                        swal("Updated Successfully !", {
                            icon: "success",
                        });


                        setTimeout(
                            function() {
                                location.reload();
                            }, 2000);


                    } else {
                        swal(" can not be done !", {
                            icon: "error",
                        });
                    }
                });
        }
    </script>


    </body>

    </html>