    <?php require 'includes/header.php';
        if(!isset($_REQUEST['userId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['userId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $productId = $_REQUEST['userId'];
//        $titleId=$_REQUEST['title'];
        $count = mysqli_num_rows($con->query("select * from product_addons where product_id = '$productId'"));
       
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
                            <h1 class="m-0 text-dark">Product Add On</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Product Add On</li>
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
                                    <h3 class="card-title">Add Product Addon</h3>
                                </div>


                                <?php 
                            $productDetails = getProductDetailsFromId($productId);
                            $productName = $productDetails['name'];
                            ?>

                                <div class="card-body row">
                                    <div class="form-group col-md-4">
                                        <label for="">Product Name</label>
                                        <input type="text" readonly disabled class="form-control" id="productName" value="<?php echo $productDetails['name'];?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Product Addon Name**</label>
                                        <input type="text" class="form-control" id="addProductOptionName" placeholder="Enter Product Size Name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Extra Price Added</label>
                                        <input type="text" class="form-control" id="addExtraPrice" placeholder="Enter Product Size Name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Offer Price Added</label>
                                        <input type="text" class="form-control" id="addOfferPrice" placeholder="Enter Product Size Name">
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Offer Price Start Date</label>
                                            <input type="text" class="form-control" placeholder="Select Special Price Start Date & Time" id="addOfferPriceStartDate"><br>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Offer Price End Date</label>
                                            <input type="text" class="form-control" placeholder="Select Special Price End Date & Time" id="addOfferPriceEndDate"><br>

                                        </div>
                                    </div>

                                    <div class="col-md-8 text-center">
                                        <div class="form-group">
                                            <label>Product Addon Image Resize</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <div id="addProductLogo"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom:300px;">
                                        <div class="form-group">
                                            <label>Select Product Addon Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-control" name="addProductLogo" id="addProductLogoButton">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addProductAddon();">Add</button>
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
                                <a href="product_add_on_ingredient.php?userId=<?php echo $productDetails['id'];?>" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>NEXT</b></a>

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
                                        <th>Image</th>
                                        <th>Addon Name</th>
                                        <th>Extra Price</th>
                                        <th>Offer Price</th>
                                        <th>Offer Price Starts</th>
                                        <th>Offer Price Ends</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $productId = $productDetails['id'];
                                    $result = getAllDataOfProductAddonTableFromProductId($productId);
                                    $i = 1;
                                    foreach ($result as $key => $value) {
                                    $id = $result[$key]['id'];
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i;?></td>
                                        <td class="text-center">
                                            <div>
                                                <img src="images/<?php echo $result[$key]['image']; ?>" width="auto" height="100px">
                                            </div>
                                        </td>
                                        <td class="text-center"><b> <?php echo $result[$key]['name']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['extra_money_added']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['offer_money_added']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['offer_money_from']; ?></b></td>
                                        <td class="text-center"><b><?php echo $result[$key]['offer_money_to']; ?></b></td>

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

                                                        <a class="dropdown-item bg-default" href="#" onclick="promtEditProductAddon('<?php echo $id; ?>', '<?php echo $result[$key]['extra_money_added']; ?>', '<?php echo $result[$key]['offer_money_added']; ?>', '<?php echo $result[$key]['offer_money_from']; ?>','<?php echo $result[$key]['offer_money_to']; ?>')">Edit</a>

                                                        <?php if ($result[$key]['status'] == 1) { ?>
                                                        <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Product ?','product_addons','<?php echo $id; ?>','2')">Deactivate</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Product ?','product_addons','<?php echo $id; ?>','1')">Activate</a>
                                                        <?php
                                                        }
                                                        ?>

                                                        <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product ? Once Done, It Can Not Be Undone !','product_addons','<?php echo $id; ?>','0')">Delete</a>
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
                                        <th>Image</th>
                                        <th>Addon Name</th>
                                        <th>Extra Price</th>
                                        <th>Offer Price</th>
                                        <th>Offer Price Starts</th>
                                        <th>Offer Price Ends</th>
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
                        <h4 class="modal-title">Edit Product Addon</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="editProductAddonId" value="">



                            <div class="form-group col-md-6">
                                <label>Edit Addon Extra Price</label>
                                <input type="text" class="form-control" id="editAddonExtraPrice" placeholder="Enter Product Size Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Edit Addon Offer Price</label>
                                <input type="text" class="form-control" id="editAddonOfferPrice" placeholder="Enter Product Size Name">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Edit Addon Offer Price Start Date</label>
                                    <input type="text" class="form-control" placeholder="Select Special Price Start Date & Time" id="editAddonOfferPriceStartDate"><br>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Edit Addon Offer Price End Date</label>
                                    <input type="text" class="form-control" placeholder="Select Special Price End Date & Time" id="editAddonOfferPriceEndDate"><br>

                                </div>
                            </div>






                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editProductLogoButton')">Unselect Image</button> -->
                        <button type="button" class="btn btn-primary" id="editProductSaveButton" onclick="saveEditProductAddon()">Save</button>
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


                $('#editAddonOfferPriceStartDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });

                $('#editAddonOfferPriceEndDate').dateTimePicker({
                    mode: 'dateTime',
                    format: 'yyyy-MM-dd HH:mm:ss'
                });


                var countOptions = <?php echo $count;?>;
                var productName = '<?php echo $productName; ?>';
                if (countOptions < 1) {
                    swal("No Product Addon Added Yet!", "", "warning");
                    // setTimeout(
                    //     function() {
                    //         window.location.href = "products.php";
                    //     }, 1000);
                }else{
                    swal("Total "+countOptions+" Addons Found for "+productName+" !", "", "info");
                }


            });

            function promtEditProductAddon(id, extra_money_added, offer_money_added, offer_money_from, offer_money_to) {
                $('.loader-holder').show();

                $("#editProductAddonId").val(id);

                $("#editAddonExtraPrice").val(extra_money_added);
                $("#editAddonOfferPrice").val(offer_money_added);
                $("#editAddonOfferPriceStartDate").val(offer_money_from);
                $("#editAddonOfferPriceEndDate").val(offer_money_to);


                $('#editProductModal').modal('show');
                $('.loader-holder').hide();
            }

            function productTitleChange() {
                $('.loader-holder').show();

                var titleId = $('#addProductOptionTitle option:selected').val();

                if (titleId != "" && titleId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllAddedProductOptionFromProductTitleAsDataTable",
                                titleId: titleId
                            }
                        })
                        .done(function(response) {

                            $('#branchTable').html(response);
                            if ($.fn.DataTable.isDataTable("#branchTable")) {
                                $('#branchTable').DataTable().clear().destroy();

                            }
                            $("#branchTable").DataTable({
                                "responsive": true,
                                "autoWidth": true
                            });
                            $('.loader-holder').hide();



                        });
                }



            }




            $addProductLogo = $('#addProductLogo').croppie({
                enableExif: true,
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 300,
                    height: 300
                }
            });


            $('#addProductLogoButton').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $addProductLogo.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('Picture Binding Complete !');
                    });

                }
                reader.readAsDataURL(this.files[0]);
            });

            function addProductAddon() {

                $('.loader-holder').show();

                var productId = <?php echo $productId;?>;

                var productAddonName = $("#addProductOptionName").val();
                var extraPrice = $("#addExtraPrice").val();
                var offerPrice = $("#addOfferPrice").val();
                var offerPriceStartDate = $("#addOfferPriceStartDate").val();
                var offerPriceEndDate = $("#addOfferPriceEndDate").val();



                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                if (!float.test(extraPrice)) {
                    $('.loader-holder').hide();

                    swal("Selling Price Must be Valid Digits", "", "warning");
                    return false;
                }
                if (!float.test(offerPrice)) {
                    $('.loader-holder').hide();

                    swal("Special Price Must be Valid Digits", "", "warning");
                    return false;
                }

                var date = (Date.parse(offerPriceEndDate) - Date.parse(offerPriceStartDate)) / 86400000;
                if (date < 0) {
                    $('.loader-holder').hide();

                    swal("Please Check the date", "Offer Price Start Date Cannot be Smaller Than End Date", "warning");
                    return false
                }

                if (productId != "" && productAddonName != "" && extraPrice != "" && offerPrice != "" && offerPriceStartDate != "" && offerPriceEndDate != "") {

                    $addProductLogo.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(resp) {

                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "saveProductAddon",


                                    productId: productId,

                                    productAddonName: productAddonName,
                                    productAddonImage: resp,
                                    productAddonExtraMoneyAdded: extraPrice,
                                    productAddonOfferMoneyAdded: offerPrice,
                                    productAddonOfferMoneyFrom: offerPriceStartDate,
                                    productAddonOfferMoneyTo: offerPriceEndDate

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
                    });

                } else {
                    $('.loader-holder').hide();

                    swal("Please Fill All the Required Fields", "", "warning");
                    return false;
                }
            }

            function saveEditProductAddon() {

                $('.loader-holder').show();

                var editProductAddonId = $("#editProductAddonId").val();
                var editAddonExtraPrice = $("#editAddonExtraPrice").val();
                var editAddonOfferPrice = $("#editAddonOfferPrice").val();
                var editAddonOfferPriceStartDate = $("#editAddonOfferPriceStartDate").val();
                var editAddonOfferPriceEndDate = $("#editAddonOfferPriceEndDate").val();



                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                if (!float.test(editAddonExtraPrice)) {
                    $('.loader-holder').hide();

                    swal("Selling Price Must be Valid Digits", "", "warning");
                    return false;
                }
                if (!float.test(editAddonOfferPrice)) {
                    $('.loader-holder').hide();

                    swal("Special Price Must be Valid Digits", "", "warning");
                    return false;
                }

                var date = (Date.parse(editAddonOfferPriceEndDate) - Date.parse(editAddonOfferPriceStartDate)) / 86400000;
                if (date < 0) {
                    $('.loader-holder').hide();

                    swal("Please Check the date", "Offer Price Start Date Cannot be Smaller Than End Date", "warning");
                    return false
                }

                if (editProductAddonId != "" && editAddonExtraPrice != "" && editAddonOfferPrice != "" && editAddonOfferPriceStartDate != "" && editAddonOfferPriceEndDate != "") {


                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveEditProductAddon",

                                productAddonId: editProductAddonId,
                                productAddonExtraMoneyAdded: editAddonExtraPrice,
                                productAddonOfferMoneyAdded: editAddonOfferPrice,
                                productAddonOfferMoneyFrom: editAddonOfferPriceStartDate,
                                productAddonOfferMoneyTo: editAddonOfferPriceEndDate

                            }
                        })
                        .done(function(response) { 
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Product Addon Edited Successfully !", " ", "success");
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
