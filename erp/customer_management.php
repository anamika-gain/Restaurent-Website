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
                        <h1 class="m-0 text-dark">Customer Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Customer Management</li>
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
                        <h2 class="card-title">Customer Details</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered text-center table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>DOB</th>
                                    <th>Address</th>
                                    <th>Total Orders</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfClientTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><b><?php $customerDetails = getClientDetailsFromId($result[$key]['id']);
                                                                    echo $customerDetails['name']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['mobile']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['dob']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['address']; ?></b></td>
                                        <td class="text-center"><b><?php echo count(getAllDataOfOrderProcessTableFromClientId($result[$key]['id'])); ?></b></td>


                                    <?php
                                    $i++;
                                }
                                    ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>DOB</th>
                                    <th>Address</th>
                                    <th>Total Orders</th>
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







    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });

        });
    </script>


    </body>

    </html>