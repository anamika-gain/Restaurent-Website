    <?php require 'includes/header.php';
        if(!isset($_REQUEST['userId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['userId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $productId = $_REQUEST['userId'];
        $count = mysqli_num_rows($con->query("select * from product_size where product_id = '$productId'"));
            
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
                            <h1 class="m-0 text-dark">Product Option Title</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Product Option Title</li>
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
                                    <h3 class="card-title">Add Product Option Title</h3>
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
                                    $allProductSize = getAllDataOfProductSizeTableFromProductId($productId);
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select A Product Size </label>
                                            <select id="addProductSizeId" class="form-control">
                                                <option value="null" selected disabled>--Select A Product Size--</option>

                                                <?php foreach($allProductSize as $productSizeKey=>$productSizeDetails){?>

                                                <option value="<?php echo intval($allProductSize[$productSizeKey]['id']);?>"><?php echo $allProductSize[$productSizeKey]['name'];?></option>

                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Option Type </label>
                                            <select id="addProductOptionType" class="form-control">
                                                <option value="checkbox">Checkbox</option>
                                                <option value="radio">Radio Button</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Option Title</label>
                                        <input type="text" class="form-control" value="" id="addProductOptionTitle" placeholder="Enter Option Title Name">
                                    </div>




                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addProductOptionTitleFunction();">Add</button>
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
                                <h4 class="text-center" style="margin:auto;"><b>Add Product Options</b></h4>
                                <a href="product_options_add.php?userId=<?php echo $productId;?>" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>Next</b></a>

                                <p></p>

                            </div>
                        </div>

                    </div>
                    <!--/.col (left) -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Product Option Title Added</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="branchTable" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Product Name</th>
                                        <th>Product Size Name </th>
                                        <th>Option Title</th>
                                        <th>Option type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Product Name</th>
                                        <th>Product Size Name </th>
                                        <th>Option Title</th>
                                        <th>Option type</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                            <input type="hidden" id="editProductOptionTitleId" value="">

                            <div class="form-group col-md-6">
                                <label for="">Product Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editProductName" class="form-control" value="">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Product Size Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editProductSizeName" class="form-control" value="">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Edit Product Option Title **</label>
                                <input type="text" value="" id="editProductOptionTitle" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Edit Product Option Type **</label>
                                <select id="editProductOptionType" class="form-control">
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio Button</option>

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editProductLogoButton')">Unselect Image</button> -->
                        <button type="button" class="btn btn-primary" id="editProductSaveButton" onclick="saveEditProductOptionTitle()">Save</button>
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
                    swal("No Product Size Added Yet!", "", "warning");
                    setTimeout(
                        function() {
                            window.location.href = "products.php";
                        }, 1000);
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


                $('#addProductSizeId').change(function() {
                    $('.loader-holder').show();

                    var selectedSizeId = $('#addProductSizeId option:selected').val();
                    var productSizeName = $('#addProductSizeId option:selected').text();

                    if (selectedSizeId != "" && selectedSizeId != "null") {



                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllAddedProductOptionTitleFromProductSizeFromProductSizeIdAsDataTable",
                                    productSizeId: selectedSizeId,
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







                $('#editProductBranchId').change(function() {
                    $('.loader-holder').show();

                    fetchSubBranch();



                });


                $('#editProductCategoryId').change(function() {
                    $('.loader-holder').show();
                    fetchSubCategory();





                });


            });


            function addProductOptionTitleFunction() {

                $('.loader-holder').show();

                var productSizeId = $("#addProductSizeId option:selected").val();
                var productOptionType = $("#addProductOptionType option:selected").val();
                var productOptionTitle = $("#addProductOptionTitle").val();



                if (productSizeId != "" && productOptionType != "" && productOptionTitle != "") {
                    if (productSizeId === "null") {
                        $('.loader-holder').hide();

                        swal("Please Select an Product Size", "", "warning");
                        return false;
                    }

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveProductOptionTitle",
                                productId: "<?php echo $productId;?>",
                                productSizeId: productSizeId,
                                title: productOptionTitle,
                                optionType: productOptionType
                            }
                        })
                        .done(function(response) {
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Product Option Title Added Successfully !", " ", "success");
                                setTimeout(
                                    function() {
                                        //                                        window.location.href = "product_size_management.php?userId=<?php echo $productId;?>";
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

            function fetchSubBranch() {
                var selectedCategoryId = $('#editProductBranchId option:selected').val();

                if (selectedCategoryId != "" && selectedCategoryId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllSubBranchDataFromBranchIdAsHtmlOption",
                                branchId: selectedCategoryId
                            }
                        })
                        .done(function(response) {

                            $('#editProductSubBranchId').html(response);
                            $('.loader-holder').hide();



                        });
                }
            }

            function fetchSubCategory() {
                $('.loader-holder').show();

                var selectedSizeId = $('#editProductCategoryId option:selected').val();

                if (selectedSizeId != "" && selectedSizeId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllSubCategoryDataFromCategoryIdAsHtmlOption",
                                categoryId: selectedSizeId,
                                scTable: "product_sub_category",
                                scTableColumn: "category_id",
                                rscTableColumn: "name",
                            }
                        })
                        .done(function(response) {

                            $('#editProductSubCategoryId').html(response);
                            $('.loader-holder').hide();



                        });
                }
            }

            function promtEditProduct(id, productName, productSizeName, productOptionTitle, productOptionType) {
                $('.loader-holder').show();

                $("#editProductOptionTitleId").val(id);

                $("#editProductName").val(productName);
                $("#editProductSizeName").val(productSizeName);
                $("#editProductOptionTitle").val(productOptionTitle);
                $("#editProductOptionType").val(productOptionType);


                $('#editProductModal').modal('show');
                $('.loader-holder').hide();
            }

            function saveEditProductOptionTitle() {
                $('.loader-holder').show();

                var id = $("#editProductOptionTitleId").val();

                var productOptionTitle = $("#editProductOptionTitle").val();
                var productOptionType = $("#editProductOptionType").val();

                var ingredientSizeIdForReload = $('#addProductSizeId option:selected').val();

                if (productOptionTitle != "" && productOptionType != "") {
                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveEditProductOptionTitle",

                                id: id,
                                title: productOptionTitle,
                                optionType: productOptionType
                            }
                        })
                        .done(function(response) {

                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                $('#addProductSizeId').val(ingredientSizeIdForReload);
                                reloadTable();
                                $('#editProductModal').modal('hide');

                                swal("Request Successful !", {
                                    icon: "success",
                                });



                            } else {
                                swal("Request Can't Be Processed !", {
                                    icon: "error",
                                });
                            }
                        });
                } else {
                    $('.loader-holder').hide();

                    swal("Please Fill All The Required Fields", "", "warning");
                    return false;
                }

            }



            function reloadTable() {
                var selectedSizeId = $('#addProductSizeId option:selected').val();
                var productSizeName = $('#addProductSizeId option:selected').text();

                if (selectedSizeId != "" && selectedSizeId != "null") {



                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllAddedProductOptionTitleFromProductSizeFromProductSizeIdAsDataTable",
                                productSizeId: selectedSizeId,
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
            }

        </script>


        </body>

        </html>
