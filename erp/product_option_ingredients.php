    <?php require 'includes/header.php';
        if(!isset($_REQUEST['userId'])&&!isset($_REQUEST['title'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['userId'])&&empty($_REQUEST['title'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $productId = $_REQUEST['userId'];
//        $titleId=$_REQUEST['title'];
        $count = mysqli_num_rows($con->query("select * from product_option_ingredients where product_id = '$productId'"));
$count =2;
            
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
                            <h1 class="m-0 text-dark">Product Option Ingredients</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Product Option Ingredients</li>
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
                                    <h3 class="card-title">Add Product Option Ingredients</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?php 
                            $productDetails = getProductDetailsFromId($productId);
                            ?>
                                <div class="card-body row">
                                    <div class="form-group col-md-4">
                                        <label for="">Product Name</label>
                                        <input type="text" readonly disabled class="form-control" id="productName" value="<?php echo $productDetails['name'];?>">
                                    </div>


                                    <div class="form-group col-md-4">
                                        <?php $specialQuery = "";
                                    $allProductSize = getAllDataOfProductSizeTableFromProductId($productId);
                                    ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Product Size </label>
                                                <select id="addProductSizeId" class="form-control">
                                                    <option value="null" selected disabled>--Select A Size--</option>

                                                    <?php foreach($allProductSize as $productSizeKey=>$productSizeDetails){?>

                                                    <option value="<?php echo intval($allProductSize[$productSizeKey]['id']);?>"><?php echo $allProductSize[$productSizeKey]['name'];?></option>

                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Product Option Title </label>
                                                <select id="addProductOptionTitle" onchange="productTitleChange()" class="form-control">
                                                    <option value="null" selected disabled>--Select A Title--</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select A Product Option </label>
                                                <select id="changeProductOptionSelector" onchange="productOptionChange()" class="form-control">
                                                    <option value="null" selected disabled>--Select An option--</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select An Ingredient </label>
                                            <select id="addProductOptionIngredientId" class="form-control select2">
                                                <option value="null" selected disabled>--Select An Option Ingredient--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Option Ingredient Amount</label>
                                        <input type="text" class="form-control" value="" id="addProductOptionIngredientAmount" placeholder="Enter Ingredient Amount">
                                    </div>



                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addProductOptionIngredient();">Add</button>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="col-md-3" style="margin:auto;">
                            <!-- general form elements -->

                            <div class=" card card-primary" style="height:350px;">
                                <div class="card-header ">
                                    <h5 class="text-center card-title">Finished?</h5>
                                </div>
                                <a href="product_add_on.php?userId=<?php echo $productDetails['id'];?>" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>NEXT</b></a>

                            </div>
                        </div>

                    </div>
                    <!--/.col (left) -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Product Size(s) Added</h3>
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




        <!-- add Product Modal -->
        <div class="modal fade" id="editProductModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product Size</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="editProductSizeId" value="">

                            <div class="form-group col-md-4">
                                <label for="">Product Name</label>
                                <input type="text" readonly disabled class="form-control" value="<?php echo $productDetails['name'];?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Edit Product Size Name</label>
                                <input type="text" class="form-control" id="editProductSizeName" placeholder="Enter Product Size Name">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Edit Product Selling Price</label>
                                <input type="text" class="form-control" id="editProductSellingPrice" placeholder="Enter Product Size Name">
                            </div>

                            <div class="form-group col-md-4">
                                <label>Product Special Price</label>
                                <input type="text" class="form-control" id="editProductSpecialPrice" placeholder="Enter Product Size Name">
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Edit Special Price Start Date</label>
                                    <input type="text" class="form-control" placeholder="Select Special Price Start Date & Time" id="editSpecialPriceStartDate"><br>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Edit Special Price End Date</label>
                                    <input type="text" class="form-control" placeholder="Select Special Price End Date & Time" id="editSpecialPriceEndDate"><br>

                                </div>
                            </div>






                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editProductLogoButton')">Unselect Image</button> -->
                        <button type="button" class="btn btn-primary" id="editProductSaveButton" onclick="saveEditProductSize()">Save</button>
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

                $("#branchTable").DataTable({
                    "scrollX": true,
                    "autoWidth": false
                });

                $('#addOfferPriceStartDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });

                $('#addOfferPriceEndDate').dateTimePicker({
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

                var countOptions = <?php echo $count;?>;
                if (countOptions < 1) {
                    swal("No Product Size Added Yet!", "", "warning");
                    setTimeout(
                        function() {
                            window.location.href = "products.php";
                        }, 1000);
                }


            });

            function reloadDataTable(response) {
                $('#branchTable').html(response);
                if ($.fn.DataTable.isDataTable("#branchTable")) {
                    $('#branchTable').DataTable().clear().destroy();

                }
                $("#branchTable").DataTable({
                    "responsive": true,
                    "autoWidth": true
                });

            }

            function changeDataTableOnProductOptionChange() {
                $('.loader-holder').show();

                var optionId = $('#changeProductOptionSelector option:selected').val();

                if (optionId != "" && optionId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllAddedIngredientFromProductOptionIdAsDataTable",
                                productOptionId: optionId
                            }
                        })
                        .done(function(response) {
                            reloadDataTable(response);

                            $('.loader-holder').hide();



                        });
                }



            }

            function productOptionChange() {
                $('.loader-holder').show();

                var productOptionId = $('#changeProductOptionSelector option:selected').val();

                if (productOptionId != "" && productOptionId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllUnaddedIngredientDetailsForAddingFromProductOptionIdAsHtmlOptions",
                                productOptionId: productOptionId
                            }
                        })
                        .done(function(response) {

                            if (response != "") {
                                $('#addProductOptionIngredientId').html(response);
                                changeDataTableOnProductOptionChange();
                                $('.select2').select2();
                                $('.loader-holder').hide();
                            } else {
                                $('#addProductOptionIngredientId').html("<option value ='null' selected disabled >--Nothing to Show--</option>");
                                changeDataTableOnProductOptionChange();
                                $('.loader-holder').hide();

                            }



                        });
                }



            }

            function productTitleChange() {
                $('.loader-holder').show();

                var titleId = $('#addProductOptionTitle option:selected').val();

                if (titleId != "" && titleId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllProductOptionFromProductTitleIdAsHtmlOption",
                                productTileId: titleId
                            }
                        })
                        .done(function(response) {


                            if (response != "") {
                                $('#changeProductOptionSelector').html(response);
                                productOptionChange();
                                $('.loader-holder').hide();
                            } else {
                                $('#changeProductOptionSelector').html("<option value ='null' selected disabled >--Nothing to Show--</option>");

                                $('.loader-holder').hide();

                            }

                        });
                }



            }

            $('#addProductSizeId').change(function() {
                $('.loader-holder').show();

                var selectedSizeId = $('#addProductSizeId option:selected').val();
                var productSizeName = $('#addProductSizeId option:selected').text();

                if (selectedSizeId != "" && selectedSizeId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getProductOptionTitleFromProductSizeIdAsHtmlOption",
                                sizeId: selectedSizeId
                            }
                        })
                        .done(function(response) {
                            if (response != "") {
                                $('#addProductOptionTitle').html(response);
                                productTitleChange();
                                $('.loader-holder').hide();

                            } else {
                                $('#addProductOptionTitle').html("<option value ='null' selected disabled >--Nothing to Show--</option>");

                                $('.loader-holder').hide();

                            }

                        });

                }

            });

            function addProductOptionIngredient() {

                $('.loader-holder').show();

                var productId = <?php echo $productId;?>;
                var productSizeId = $("#addProductSizeId option:selected").val();
                var productOptionTitleId = $("#addProductOptionTitle option:selected").val();

                var productOptionId = $("#changeProductOptionSelector option:selected").val();
                var productOptionIngredientId = $("#addProductOptionIngredientId option:selected").val();
                var productOptionIngredientAmount = $("#addProductOptionIngredientAmount").val();

                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                if (!float.test(productOptionIngredientAmount)) {
                    $('.loader-holder').hide();

                    swal("Ingredient Amount", "", "warning");
                    return false;
                }


                if (productId != "" && productSizeId != "" && productOptionTitleId != "" && productOptionId != "" && productOptionIngredientId != "" && productOptionIngredientAmount != "" && productId != "null" && productSizeId != "null" && productOptionTitleId != "null" && productOptionId != "null" && productOptionIngredientId != "null" && productOptionIngredientAmount != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveProductOptionIngredients",

                                productId: productId,
                                productSizeId: productSizeId,
                                productOptionTitleId: productOptionTitleId,
                                productOptionId: productOptionId,
                                productOptionIngredientId: productOptionIngredientId,
                                productOptionIngredientAmount: productOptionIngredientAmount
                            }
                        })
                        .done(function(response) {
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Product Size Added Successfully !", " ", "success");
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

                    swal("Please Fill All the Required Fields", "", "warning");
                    return false;
                }
            }

        </script>


        </body>

        </html>
