    <?php require 'includes/header.php';
        if(!isset($_REQUEST['userId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['userId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $uniqueId = $_REQUEST['userId'];
        $count = mysqli_num_rows($con->query("select * from products where unique_id = '$uniqueId'"));
            if($count<1){
                    echo "<script>window.location.href='404.php';</script>";

    }
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
                            <h1 class="m-0 text-dark">Products</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Products</li>
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
                                    <h3 class="card-title">Add Product Size</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?php 
                            $productDetails = getProductDetailsFromUniqueId($uniqueId);
                            ?>
                                <div class="card-body row">
                                    <div class="form-group col-md-4">
                                        <label for="">Product Name</label>
                                        <input type="text" readonly disabled class="form-control" id="productName" value="<?php echo $productDetails['name'];?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Product Size Name</label>
                                        <input type="text" class="form-control" id="addProductSizeName" placeholder="Enter Product Size Name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Product Selling Price</label>
                                        <input type="text" class="form-control" id="addProductSellingPrice" placeholder="Enter Product Size Name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Product Special Price</label>
                                        <input type="text" class="form-control" id="addProductSpecialPrice" placeholder="Enter Product Size Name">
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Special Price Start Date</label>
                                            <input type="text" class="form-control" placeholder="Select Special Price Start Date & Time" id="addSpecialPriceStartDate"><br>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Special Price End Date</label>
                                            <input type="text" class="form-control" placeholder="Select Special Price End Date & Time" id="addSpecialPriceEndDate"><br>

                                        </div>
                                    </div>



                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addProductSize();">Add</button>
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
                                <a href="product_ingredient_management.php?userId=<?php echo $productDetails['id'];?>" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>NEXT</b></a>

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
                                        <th>Name</th>
                                        <th>Selling Price</th>
                                        <th>Special Price</th>
                                        <th>Special Price Starts</th>
                                        <th>Special Price Ends</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productId = $productDetails['id'];
                                $result = getAllDataOfProductSizeTableFromProductId($productId);
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><b><?php echo $result[$key]['name']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['selling_price']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['special_price']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['special_price_from']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['special_price_to']; ?></b></td>

                                        <?php
                                        if ($result[$key]['status'] == 1) {
                                            $colorClass = "bg-success";
                                            $statusValue = "Active";
                                        } else {
                                            $colorClass = "bg-danger";
                                            $statusValue = "Deactive";
                                        }
                                        ?>
                                        <td class="text-center <?php echo $colorClass; ?>"><?php echo $statusValue; ?></td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Action</button>
                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    <div class="dropdown-menu text-center" role="menu">

                                                        <a class="dropdown-item bg-default" href="#" onclick="promtEditProduct('<?php echo $id; ?>', '<?php echo $result[$key]['name']; ?>', '<?php echo $result[$key]['selling_price']; ?>', '<?php echo $result[$key]['special_price']; ?>', '<?php echo $result[$key]['special_price_from']; ?>', '<?php echo $result[$key]['special_price_to']; ?>')">Edit</a>


                                                        <?php if ($result[$key]['status'] == 1) { ?>
                                                        <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Product ?','product_size','<?php echo $id; ?>','2')">Deactivate</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Product ?','product_size','<?php echo $id; ?>','1')">Activate</a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product ? Once Done, It Can Not Be Undone !','product_size','<?php echo $id; ?>','0')">Delete</a>
                                                    </div>
                                                </button>
                                            </div>
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
                                        <th>Name</th>
                                        <th>Selling Price</th>
                                        <th>Special Price</th>
                                        <th>Special Price Starts</th>
                                        <th>Special Price Ends</th>
                                        <th>Status</th>
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


                $('#addProductBranchId').change(function() {
                    $('.loader-holder').show();

                    var selectedBranchId = $('#addProductBranchId option:selected').val();

                    if (selectedBranchId != "" && selectedBranchId != "null") {

                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllSubBranchDataFromBranchIdAsHtmlOption",
                                    branchId: selectedBranchId
                                }
                            })
                            .done(function(response) {

                                $('#addProductSubBranchId').html(response);
                                $('.loader-holder').hide();



                            });
                    }



                });

                $('#addProductCategoryId').change(function() {
                    $('.loader-holder').show();

                    var selectedBranchId = $('#addProductCategoryId option:selected').val();

                    if (selectedBranchId != "" && selectedBranchId != "null") {

                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllSubCategoryDataFromCategoryIdAsHtmlOption",
                                    categoryId: selectedBranchId,
                                    scTable: "product_sub_category",
                                    scTableColumn: "category_id",
                                    rscTableColumn: "name",
                                }
                            })
                            .done(function(response) {

                                $('#addProductSubCategoryId').html(response);
                                $('.loader-holder').hide();



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


            function addProductSize() {

                $('.loader-holder').show();

                var name = $("#productName").val();
                var productSizeName = $("#addProductSizeName").val();


                var sellingPrice = $("#addProductSellingPrice").val();
                var specialPrice = $("#addProductSpecialPrice").val();
                var specialPriceStartDate = $("#addSpecialPriceStartDate").val();
                var specialPriceEndDate = $("#addSpecialPriceEndDate").val();



                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                if (!float.test(sellingPrice)) {
                    $('.loader-holder').hide();

                    swal("Selling Price Must be Valid Digits", "", "warning");
                    return false;
                }
                if (!float.test(specialPrice)) {
                    $('.loader-holder').hide();

                    swal("Special Price Must be Valid Digits", "", "warning");
                    return false;
                }

                var date = (Date.parse(specialPriceEndDate) - Date.parse(specialPriceStartDate)) / 86400000;
                if (date < 0) {
                    $('.loader-holder').hide();

                    swal("Please Check the date", "Special Price Start Date Cannot be Smaller Than End Date", "warning");
                    return false
                }

                if (productSizeName != "" && sellingPrice != "" && specialPrice != "" && specialPriceEndDate != "" && specialPriceEndDate != "") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveProductSize",

                                sizeName: productSizeName,
                                productId: "<?php echo $productDetails['id'];?>",
                                sellingPrice: sellingPrice,
                                specialPrice: specialPrice,
                                specialPriceFrom: specialPriceStartDate,
                                specialPriceTo: specialPriceEndDate
                            }
                        })
                        .done(function(response) {
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Product Size Added Successfully !", " ", "success");
                                setTimeout(
                                    function() {
                                        window.location.href = "product_size_management.php?userId=<?php echo $uniqueId;?>";
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

                var selectedBranchId = $('#editProductCategoryId option:selected').val();

                if (selectedBranchId != "" && selectedBranchId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllSubCategoryDataFromCategoryIdAsHtmlOption",
                                categoryId: selectedBranchId,
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

            function promtEditProduct(id, name, sellingPrice, specialPrice, specialPriceStartDate, specialPriceEndDate) {
                $('.loader-holder').show();

                $("#editProductSizeId").val(id);
                $("#editProductSizeName").val(name);
                $("#editProductSellingPrice").val(sellingPrice);
                $("#editProductSpecialPrice").val(specialPrice);
                $("#editSpecialPriceStartDate").val(specialPriceStartDate);
                $("#editSpecialPriceEndDate").val(specialPriceEndDate);

                $('#editProductModal').modal('show');
                $('.loader-holder').hide();
            }

            function saveEditProductSize() {
                $('.loader-holder').show();

                var id = $("#editProductSizeId").val();
                var name = $("#editProductSizeName").val();
                var sellingPrice = $("#editProductSellingPrice").val();
                var specialPrice = $("#editProductSpecialPrice").val();
                var specialPriceStartDate = $("#editSpecialPriceStartDate").val();
                var specialPriceEndDate = $("#editSpecialPriceEndDate").val();

                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveEditProductSize",

                            id: id,
                            name: name,
                            sellingPrice: sellingPrice,
                            specialPrice: specialPrice,
                            specialPriceFrom: specialPriceStartDate,
                            specialPriceTo: specialPriceEndDate
                        }
                    })
                    .done(function(response) {

                        $('.loader-holder').hide();

                        if (parseInt(response) == 1) {

                            swal("Request Successful !", {
                                icon: "success",
                            });
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

            }

        </script>


        </body>

        </html>
