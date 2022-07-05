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
                        <h1 class="m-0 text-dark">Purchase Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Purchase Management</li>
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
                        <h3 class="card-title">Purchase List</h3>
                        <span class="float-right"><a class="btn bg-gradient-primary" href="requisition_add.php">Add</a></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="requisitionTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Branch</th>
                                    <th>Sub Branch</th>
                                    <th>Unique Purchase ID</th>
                                    <th>Requisition Unique ID</th>
                                    <th>Requisition By</th>
                                    <th>Requisition Time</th>
                                    <th>Purchased By</th>
                                    <th>Purchased Time</th>
                                    <th>Purchased Amount</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfPurchaseTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>

                                        <td class="text-center"><?php $branchDetails = getbranchDetailsFromId($result[$key]['branch_id']); echo $branchDetails['name']; ?></td>

                                        <td class="text-center"><?php $subBranchDetails = getSubBranchDetailsFromId($result[$key]['sub_branch_id']); echo $subBranchDetails['name']; ?></td>

                                        <td class="text-center"><b><?php echo $result[$key]['unique_purchase_id']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['unique_requisition_id']; ?></b></td>

                                        <td class="text-center"><?php echo getUserFullNameFromId($result[$key]['requisition_by']); ?></td>

                                        <td class="text-center"><?php echo $result[$key]['requisition_at']; ?></td>

                                        <td class="text-center"><?php echo getUserFullNameFromId($result[$key]['created_by']); ?></td>
                                        <td class="text-center"><?php echo $result[$key]['created_at']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['total_purchased_amount']; ?></td>

                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm " onclick="viewPurchase('<?php echo $result[$key]['unique_purchase_id']; ?>','<?php echo $result[$key]['requisition_at']; ?>','<?php echo $result[$key]['created_at']; ?>')"><i class="fa fa-eye"></i> View</button>
                                            


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
                                    <th>Branch</th>
                                    <th>Sub Branch</th>
                                    <th>Unique Purchase ID</th>
                                    <th>Requisition Unique ID</th>
                                    <th>Requisition By</th>
                                    <th>Requisition Time</th>
                                    <th>Purchased By</th>
                                    <th>Purchased Time</th>
                                    <th>Purchased Amount</th>
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

            $("#requisitionTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });



        });



        function viewPurchase(uniquePurchaseId, requisitionDate, purchaseDate) {
            $('.loader-holder').show();


            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "viewPurchaseCompletedList",
                        uniquePurchaseId: uniquePurchaseId,
                        requisitionDate: requisitionDate,
                        purchaseDate: purchaseDate
                    }
                })
                .done(function(response) {

                    $('#editRequisitionModal').html(response);

                    $('.loader-holder').hide();

                    if (response != "") {

                        $('#editRequisitionModal').modal('show');

                    } else {
                        swal(uniqueId + " can not be fetched !", {
                            icon: "error",
                        });
                    }
                });
        }


        
    </script>


    </body>

    </html>