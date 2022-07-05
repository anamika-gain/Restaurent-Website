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
                        <h1 class="m-0 text-dark">Guard Requisition Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Guard Requisition Management</li>
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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="requisitionTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Requisition ID</th>
                                    <th>Requisition By</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfRequisitionProcessTableForGuardEntry("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>

                                        <td class="text-center"><b><?php echo $result[$key]['unique_requisition_id']; ?></b></td>
                                        <td class="text-center"><?php echo getUserFullNameFromId($result[$key]['created_by']); ?></td>
                                        
                                        <td class="text-center">
                                            <a href="guard_requisition_details.php?userId=<?php echo $result[$key]['unique_requisition_id'];?>" class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
                                            


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
                                    <th>Requisition ID</th>
                                    <th>Requisition By</th>
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



        
    </script>


    </body>

    </html>