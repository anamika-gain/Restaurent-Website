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
                        <h1 class="m-0 text-dark">Requisition Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Requisition Management</li>
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
                        <span class="float-right"><a class="btn bg-gradient-primary" href="requisition_add.php">Add</a></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="requisitionTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Unique ID</th>
                                    <th>Total Items</th>
                                    <th>Requisition Time</th>
                                    <th>Requisition By</th>
                                    <th>Requisition Approvals</th>
                                    <th>Current Status</th>
                                    <th>Remarks</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfRequisitionProcessTable(" ORDER BY id DESC");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>

                                        <td class="text-center"><b><?php echo $result[$key]['unique_requisition_id']; ?></b></td>
                                        <td class="text-center"><?php echo $result[$key]['total_item']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['created_at']; ?></td>

                                        <td class="text-center"><?php echo getUserFullNameFromId($result[$key]['created_by']); ?></td>

                                        <td class="text-center"><?php getRequisitionApproveTimeDetailsFromRequisitionUniqueId($result[$key]['unique_requisition_id']); ?></td>


                                        <td class="text-center">
                                            <?php currentStatusOfRequisitionProcess($result[$key]['created_by'], $result[$key]['status']); ?>


                                        </td>

                                        <td class="text-center"><?php echo $result[$key]['remarks']; ?></td>


                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm " onclick="viewRequisition('<?php echo $result[$key]['unique_requisition_id']; ?>', '<?php echo $result[$key]['created_at']; ?>', '<?php echo $result[$key]['created_by']; ?>', '<?php echo $result[$key]['status']; ?>')"><i class="fa fa-eye"></i> View</button>
                                            <button class="btn btn-danger btn-sm " onclick="statusToggler('Do You Want To Delete The Requisition ? Once Done, It Can Not Be Undone !','','<?php echo $id; ?>','0')"><i class="fa fa-trash"></i> Delete</button>


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
                                    <th>Unique ID</th>
                                    <th>Total Items</th>
                                    <th>Requisition Time</th>
                                    <th>Requisition By</th>
                                    <th>Requisition Approvals</th>
                                    <th>Current Status</th>
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

            $("#requisitionTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });



        });



        function viewRequisition(uniqueId, requisitionDate, requisitionGivenBy, status) {
            $('.loader-holder').show();

            $('#uniqueIdViewing').val(uniqueId);

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "viewRequisition",
                        uniqueId: uniqueId,
                        requisitionDate: requisitionDate,
                        requisitionGivenBy: requisitionGivenBy,
                        status: status
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