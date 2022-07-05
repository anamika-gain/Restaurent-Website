    <?php require 'includes/header.php';
        if(!isset($_REQUEST['userId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['userId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $vendorId = $_REQUEST['userId'];
        $count = mysqli_num_rows($con->query("select * from vendor where id = '$vendorId'"));
        
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
                            <h1 class="m-0 text-dark">Vendor Category</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Vendor Category</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="row">

                        <!-- left column -->
                        <div class="col-md-9" style="margin:auto;">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add Vendor Category</h3>
                                </div>
                                <!-- /.card-header -->
                                
                                <div class="card-body row">
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Vendor Name</label>
                                            <?php 
                                                $vendorDetails = getVendorDetailsFromId($vendorId);
                                            ?>
                                        <input type="text" class="form-control" value="<?php echo $vendorDetails['company_name'];?>" disabled readonly id="addVendorName" placeholder="Enter Ingredient Amount">
                                            
                                        </div>
                                    </div>


                                        <?php $specialQuery = "";
                                        $allBranch = getAllUnaddedIngredientCategoryForVendor($vendorId);
                                        ?>
                                    <div class="form-group col-md-6">
                                        <label>Vendor Category</label>
                                            <select id="addVendorCategoryId" class="form-control">
                                                <option value="null" selected disabled>--Select A Category--</option>

                                                <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                                <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                        <?php }?>
                                    </select>
                                    </div>

                                    




                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addVendorCategory();">Add</button>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-md-3" style="margin:auto;">
                            <!-- general form elements -->

                            <div class=" card card-primary" style="height:319px;">
                                <div class="card-header ">
                                    <h5 class="text-center card-title">Finished?</h5>
                                </div>
                                <a href="vendor_management.php" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>Done</b></a>
                                

                            </div>
                        </div>

                    </div>
                    <!--/.col (left) -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Vendor Category Added</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="branchTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Action </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                <?php

                                $result = getAllAddedIngredientCategoryForVendor($vendorId);
                                $i = 1;
                                foreach ($result as $key => $value) { ?>

                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><b><?php $cat = getIngredientCategoryDetailsFromId($result[$key]['category_id']); echo $cat['name']; ?></b></td>
                                    

                                    <td class="text-center"><a class="dropdown-item bg-danger"  onclick="statusToggler('Do You Want To Delete The Vendor Category ? Once Done, It Can Not Be Undone !','vendor_ingredient_category','<?php echo $result[$key]['id']; ?>','0')">Delete</a></td>
                                </tr>

                                <?php $i++;}?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                       <th>#</th>
                                        <th>Category Name</th>
                                        <th>Action </th>
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

        <!--

-->



        <?php require 'includes/footer.php'; ?>

        <script>
            $(function() {


                var countOptions = <?php echo $count;?>;
                if (countOptions < 1) {
                    swal("No Product Size Added Yet!", "", "warning");
                    setTimeout(
                        function() {
                            window.location.href = "vendor_management.php";
                        }, 1000);
                }

                $("#branchTable").DataTable({
                    "scrollX": true,
                    "autoWidth": false
                });

            

            });


            function addVendorCategory() {

                $('.loader-holder').show();

                var branchId = <?php echo $vendorDetails['branch_id'];?>;
                var subBranchId = "0";
                var categoryId = $("#addVendorCategoryId option:selected").val();
                var vendorId = <?php echo $vendorId;?>;


                

                if (branchId != "" && subBranchId != "" && categoryId != "" && vendorId != "") {

                    
                    if (branchId === "null" || subBranchId === "null"|| categoryId === "null"|| vendorId === "null") {
                    $('.loader-holder').hide();
                    swal("Please Fill Everything", "", "warning");
                    return false;
                    }


                
                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveVendorCategory",

                                branchId: branchId,
                                subBranchId: subBranchId,
                                categoryId: categoryId,
                                vendorId: vendorId
                            }
                        })
                        .done(function(response) {
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Vendor Category Added Successfully !", " ", "success");
                                setTimeout(
                                    function() {
                                       
                                        location.reload();
                                    }, 1000);

                            } else {
                                swal("Request Can't Be Processed !", {
                                    icon: "error",
                                });
                            }
                        });

                } else {
                    $('.loader-holder').hide();
                    alert(branchId+" "+subBranchId+" "+categoryId+" "+vendorId);
                    swal("Please Fill All the Required Fields Correctly", "", "warning");
                    return false;
                }
            }

          

        </script>


        </body>

        </html>
