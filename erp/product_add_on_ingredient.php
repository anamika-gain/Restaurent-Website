    <?php require 'includes/header.php';
        if(!isset($_REQUEST['userId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['userId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $productId = $_REQUEST['userId'];
        $count = mysqli_num_rows($con->query("select * from product_addons_ingredients where product_id = '$productId'"));
        
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
                            <h1 class="m-0 text-dark">Product Addon Ingredients</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Product Addon Ingredients</li>
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
                                    <h3 class="card-title">Add Product Addon Ingredients</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?php 
                            $productDetails = getProductDetailsFromId($productId);
                            ?>
                                <div class="card-body row">
                                    <div class="form-group col-md-6">
                                        <label for="">Product Name</label>
                                        <input type="text" readonly disabled class="form-control" id="productName" value="<?php echo $productDetails['name'];?>">
                                    </div>

                                    <?php $specialQuery = "";
                                    $allProductSize = getAllDataOfProductAddonTableFromProductId($productId);
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select A Product Addon </label>
                                            <select id="addProductAddonId" class="form-control">
                                                <option value="null" selected disabled>--Select A Product Addon--</option>

                                                <?php foreach($allProductSize as $productSizeKey=>$productSizeDetails){?>

                                                <option value="<?php echo intval($allProductSize[$productSizeKey]['id']);?>"><?php echo $allProductSize[$productSizeKey]['name'];?></option>

                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select An Ingredient </label>
                                            <select id="addProductIngredientId" class="form-control select2">
                                                <option value="null" selected disabled>--Select An Ingredient--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Ingredient Amount</label>
                                        <input type="text" class="form-control" value="" id="addProductIngredientAmount" placeholder="Enter Ingredient Amount">
                                    </div>




                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addProductIngredient();">Add</button>
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
                                <a href="products.php" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>Done</b></a>


                            </div>
                        </div>

                    </div>
                    <!--/.col (left) -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Product Ingredient(s) Added</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="branchTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Ingredient Name</th>
                                        <th>Amount </th>
                                        <th>Default Weight In</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Ingredient Name</th>
                                        <th>Amount </th>
                                        <th>Default Weight In</th>
                                        <th>Option</th>
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




        <!-- add Product Modal -->
        <div class="modal fade" id="editProductModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product Ingredient</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="editProductIngredientId" value="">

                            <div class="form-group col-md-4">
                                <label for="">Product Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editProductName" class="form-control" value="">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Edit Product Size Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editProductSizeName" class="form-control" value="">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Edit Product Ingredient Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editProductIngredientName" class="form-control" value="">
                            </div>



                            <div class="form-group col-md-6">
                                <label>Ingredient Default Weight In (Not Editable)</label>
                                <input type="text" readonly disabled value="" id="editDefaultWeightIn" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Edit Product Ingredient Amount**</label>
                                <input type="text" class="form-control" autofocus id="editProductIngredientAmount" value="" placeholder="Enter Ingredient Name">
                            </div>








                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editProductLogoButton')">Unselect Image</button> -->
                        <button type="button" class="btn btn-primary" id="editProductSaveButton" onclick="saveEditProductIngredient()">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- add Product Modal -->




        <?php require 'includes/footer.php'; ?>

        <script>
            $(function() {


                var countOptions = <?php echo $count;?>;
                if (countOptions < 1) {
                    swal("No Product Added Yet!", "", "warning");
                    // setTimeout(
                    //     function() {
                    //         window.location.href = "products.php";
                    //     }, 1000);
                }

                $("#branchTable").DataTable({
                    "scrollX": true,
                    "autoWidth": false
                });

                $('#addSpecialPriceStartDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });

                $('#addSpecialPriceEndDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });


                $('#editSpecialPriceStartDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });

                $('#editSpecialPriceEndDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });


                $('#addProductAddonId').change(function() {
                    $('.loader-holder').show();

                    var selectedSizeId = $('#addProductAddonId option:selected').val();
                    var productSizeName = $('#addProductAddonId option:selected').text();

                    if (selectedSizeId != "" && selectedSizeId != "null") {

                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllUnaddedIngredientDetailsForAddingFromProductAddonIdAsHtmlOptions",
                                    productAddonId: selectedSizeId
                                }
                            })
                            .done(function(response) {
                                if (response != "") {
                                    $('#addProductIngredientId').html(response);
                                    $('.select2').select2();
                                    $('.loader-holder').hide();

                                } else {
                                    $('#addProductIngredientId').html("<option value ='null' selected disabled >--Nothing To Show--</option>");

                                    $('.loader-holder').hide();

                                }

                            });


                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllAddedIngredientFromProductAddonIdAsDataTable",
                                    productAddonId: selectedSizeId,
                                    productSizeName: productSizeName
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

                                } else {
                                    $('#addProductIngredientId').html("<option value ='null' selected disabled >--No Ingredient Added--</option>");

                                    $('.loader-holder').hide();

                                }

                            });

                    }

                });




            });


            function addProductIngredient() {

                $('.loader-holder').show();

                var productAddonId = $("#addProductAddonId option:selected").val();
                var productAddonIngredientId = $("#addProductIngredientId option:selected").val();
                var productAddonIngredientAmount = $("#addProductIngredientAmount").val();

                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                if (!float.test(productAddonIngredientAmount)) {
                    $('.loader-holder').hide();

                    swal("Addon Ingredient Amount Must be Decimal or Floating Digits", "", "warning");
                    return false;
                }

                if (productAddonId != "" && productAddonIngredientId != "" && productAddonIngredientAmount != "") {
                    if (productAddonIngredientId === "null" || productAddonIngredientAmount === "null") {
                        $('.loader-holder').hide();

                        swal("Please Select an Ingredient", "", "warning");
                        return false;
                    }

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveProductAddonIngredients",

                                productId: "<?php echo $productId;?>",
                                productAddonId: productAddonId,
                                productAddonIngredientId: productAddonIngredientId,
                                productAddonIngredientAmount: productAddonIngredientAmount
                            }
                        })
                        .done(function(response) {
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Product Addon Ingredient Added Successfully !", " ", "success");
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

                    swal("Please Fill All the Required Fields Correctly", "", "warning");
                    return false;
                }
            }

        </script>


        </body>

        </html>
