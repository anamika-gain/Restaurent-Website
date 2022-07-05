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
                        <h1 class="m-0 text-dark">Stock Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Stock Management</li>
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
                        <h3 class="card-title">Stock List</h3>
                        <span class="float-right"><button type="button" onclick="window.location.href='requisition_add.php';" class="btn bg-gradient-primary">Add Requisition</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered text-center table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Ingredient Name</th>
                                    <th>Current Stock</th>
                                    <th>Expiry Date</th>
                                    <th>Branch</th>
                                    <th>Sub Branch</th>
                                    <th>Purchase ID </th>
                                    <th>Requisition ID </th>
                                    <th>Stock In</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfStockTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><b><?php $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                                                                    echo $ingredientDetails['ingredient_name']; ?></b></td>
                                        <td class="text-center <?php if (getNotificationLimitFromIngredientId($result[$key]['ingredient_id'])) {
                                            echo "bg-danger";
                                        } ?>"><b><?php echo $result[$key]['ingredient_amount'] . " " . getDefaultWeightInNameFromIngredientId($result[$key]['ingredient_id']); ?></b></td>
                                        <td class="text-center"><?php echo $result[$key]['ingredient_expiry_date']; ?></td>
                                        <td class="text-center"><?php $branchDetails = getBranchDetailsFromId($result[$key]['branch_id']);
                                                                echo $branchDetails['name'] ?></td>
                                        <td class="text-center"><?php $subBranchDetails = getSubBranchDetailsFromId($result[$key]['sub_branch_id']);
                                                                echo $subBranchDetails['name'] ?></td>
                                        <td class="text-center"><?php echo $result[$key]['unique_purchase_id']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['unique_requisition_id']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['created_at']; ?></td>

                                    <?php
                                    $i++;
                                }
                                    ?>
                                    </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Ingredient Name</th>
                                    <th>Current Stock</th>
                                    <th>Expiry Date</th>
                                    <th>Branch</th>
                                    <th>Sub Branch</th>
                                    <th>Purchase ID </th>
                                    <th>Requisition ID </th>
                                    <th>Stock In</th>
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
                "pageLength": 500,
                "scrollX": true,
                "autoWidth": false
            });

        });
    </script>


    </body>

    </html>