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
                        <h1 class="m-0 text-dark">Report Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Report Management</a></li>
                            <li class="breadcrumb-item active">Purchase Report Management</li>
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
                            <h3 class="card-title">Purchase Item Inquiries</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select an Item </label>
                                    <select id="ingredientId" class="form-control select2">
                                        <option value="null" selected disabled>--Select An Item--</option>
                                        <option value="0">All Items</option>
                                        <?php
                                            $allProductDetails = getAllDataOfIngredientTable(" order by ingredient_name");

                                            foreach ($allProductDetails as $key => $value) {

                                                
                                                $productDetails = getIngredientDetailsFromId($allProductDetails[$key]['id']);
                                        ?>
                                        <option value="<?php echo $productDetails['id'];?>">
                                            <?php echo $productDetails['ingredient_name'];?></option>

                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select a Branch </label>
                                    <select id="subBranchId" class="form-control select2">
                                        <option value="0" selected>--All Sub Branch--</option>
                                        <?php
                                            $allSubBranchDetails = getAllDataOfSubBranchTable(" order by name");

                                            foreach ($allSubBranchDetails as $key => $value) {

                                                
                                                $subBranchDetails = getSubBranchDetailsFromId($allSubBranchDetails[$key]['id']);
                                        ?>
                                        <option value="<?php echo $subBranchDetails['id'];?>">
                                            <?php echo $subBranchDetails['name'];?></option>

                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="text" class="form-control"
                                        placeholder="Select From Date for Sales Report" id="fromDate"><br>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="text" class="form-control"
                                        placeholder="Select From Till for Sales Report" id="toDate"><br>

                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="col-md-4" style="margin:auto;">
                                <button class="btn btn-primary btn-block" onclick="generateReport();">Generate
                                    Report</button>
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Purchase Details</h2>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered text-center table-striped">
                            
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

        // $("#branchTable").DataTable({
        //     "scrollX": true,
        //     "autoWidth": false
        // });

    });

    $('#fromDate').dateTimePicker({
        mode: 'dateTime',
        format: 'yyyy-MM-dd'
    });

    $('#toDate').dateTimePicker({
        mode: 'dateTime',
        format: 'yyyy-MM-dd'
    });

    $('.select2').select2();


    function generateReport() {

        var ingredientId = $('#ingredientId option:selected').val();
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

        if (ingredientId != "" && ingredientId != "null" && fromDate != "" && toDate != "") {

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "itemWisePurchaseReport",

                        ingredientId: ingredientId,
                        subBranchId: subBranchId,
                        fromDate: fromDate,
                        toDate: toDate
                    }
                })
                .done(function(response) {
                    if (response != "") {

                        $('#branchTable').html(response);
                        if ($.fn.DataTable.isDataTable("#branchTable")) {
                            $('#branchTable').DataTable().clear().destroy();

                        }
                        $("#branchTable").DataTable({
                            "responsive": true,
                            "autoWidth": true
                        });
                        $('.loader-holder').hide();

                        // $('.loader-holder').show();
                    } else {

                        swal("Something is broken", "warning");


                    }

                });


        } else {
            swal("Select all options", "error");
            return false;
        }
    }
    </script>





    </body>

    </html>