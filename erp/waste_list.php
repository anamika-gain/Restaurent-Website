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
                        <h1 class="m-0 text-dark">Wastage Details</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Wastage Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->




        <section class="content mt-5">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Wastage Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="wasteTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Ingredient Name</th>
                                    <th>Waste Amount</th>
                                    <th>Input Date</th>
                                    <th>Input By</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfWastageTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center">
                                            <?php

                                            $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']); ?>
                                            <input type="hidden" value="<?php echo $id; ?>" name="ingredientId[]">
                                            <b><?php echo $ingredientDetails['ingredient_name']; ?></b>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $result[$key]['amount'];
                                            echo " " . getDefaultWeightInNameFromIngredientId($ingredientDetails['default_weight_in']); ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo $result[$key]['created_at']; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo getUserFullNameFromId($result[$key]['created_by']); ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo $result[$key]['reason']; ?>
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
                                    <th>Ingredient Name</th>
                                    <th>Waste Amount</th>
                                    <th>Input Date</th>
                                    <th>Input By</th>
                                    <th>Reason</th>
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

            $("#wasteTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });



        });
    </script>


    </body>

    </html>