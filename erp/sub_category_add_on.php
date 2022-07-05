    <?php require 'includes/header.php';
        if(!isset($_REQUEST['subCategoryId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['subCategoryId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $subCategoryId = $_REQUEST['subCategoryId'];
//        $titleId=$_REQUEST['title'];
        $count = mysqli_num_rows($con->query("select * from sub_category_addons where status > 0 AND sub_category_id = '$subCategoryId'"));
       
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
                            <h1 class="m-0 text-dark">Sub Category Add On</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Sub Category Add On</li>
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
                                    <h3 class="card-title">Add Sub Category Addon</h3>
                                </div>


                                <?php 
                            $subCategoryDetails = getProductSubCategoryDetailsFromId($subCategoryId);
                            $subCategoryName = $subCategoryDetails['name'];
                            ?>

                                <div class="card-body row">
                                    <div class="form-group col-md-4">
                                        <label for="">Sub Category Name</label>
                                        <input type="text" readonly disabled class="form-control" id="subCategoryName" value="<?php echo $subCategoryDetails['name'];?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Sub Category Addon Name**</label>
                                        <input type="text" class="form-control" id="addSubCategoryOptionName" placeholder="Enter Addon Name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Extra Price Added</label>
                                        <input type="text" class="form-control" id="addExtraPrice" placeholder="enter extra added price">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Offer Price Added</label>
                                        <input type="text" class="form-control" id="addOfferPrice" placeholder="Enter SubCategory Size Name">
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
                                            <label>Sub Category Addon Image Resize</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <div id="addSubCategoryLogo"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-bottom:300px;">
                                        <div class="form-group">
                                            <label>Select Sub Category Addon Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input form-control" name="addSubCategoryLogo" id="addSubCategoryLogoButton">
                                                    <label class="custom-file-label">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addSubCategoryAddon();">Add</button>
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
                                <a href="sub_category_add_on_ingredient.php?subCategoryId=<?php echo $subCategoryDetails['id'];?>" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>NEXT</b></a>

                            </div>
                        </div>

                    </div>
                    <!--/.col (left) -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Sub Category Size(s) Added</h3>
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
                                    $subCategoryId = $subCategoryDetails['id'];
                                    $result = getAllDataOfSubCategoryAddonTableFromSubCategoryId($subCategoryId);
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

                                                        <a class="dropdown-item bg-default" href="#" onclick="promtEditSubCategoryAddon('<?php echo $id; ?>', '<?php echo $result[$key]['extra_money_added']; ?>', '<?php echo $result[$key]['offer_money_added']; ?>', '<?php echo $result[$key]['offer_money_from']; ?>','<?php echo $result[$key]['offer_money_to']; ?>')">Edit</a>

                                                        <?php if ($result[$key]['status'] == 1) { ?>
                                                        <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Sub Category Addon ?','sub_category_addons','<?php echo $id; ?>','2')">Deactivate</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                        <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Sub Category Addon ?','sub_category_addons','<?php echo $id; ?>','1')">Activate</a>
                                                        <?php
                                                        }
                                                        ?>

                                                        <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Addon ? Once Done, It Can Not Be Undone !','sub_category_addons','<?php echo $id; ?>','0')">Delete</a>
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




        <!-- add subCategory Modal -->
        <div class="modal fade" id="editSubCategoryModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit SubCategory Addon</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="editSubCategoryAddonId" value="">



                            <div class="form-group col-md-6">
                                <label>Edit Addon Extra Price</label>
                                <input type="text" class="form-control" id="editAddonExtraPrice" placeholder="Enter SubCategory Size Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Edit Addon Offer Price</label>
                                <input type="text" class="form-control" id="editAddonOfferPrice" placeholder="Enter SubCategory Size Name">
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
                        <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editSubCategoryLogoButton')">Unselect Image</button> -->
                        <button type="button" class="btn btn-primary" id="editSubCategorySaveButton" onclick="saveEditSubCategoryAddon()">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- add SubCategory Modal -->




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
                var subCategoryName = '<?php echo $subCategoryName; ?>';
                if (countOptions < 1) {
                    swal("No subCategory Addon Added Yet!", "", "warning");
                }else{
                    swal("Total "+countOptions+" Addons Found for "+subCategoryName+" !", "", "info");
                }


            });

            function promtEditSubCategoryAddon(id, extra_money_added, offer_money_added, offer_money_from, offer_money_to) {
                $('.loader-holder').show();

                $("#editSubCategoryAddonId").val(id);

                $("#editAddonExtraPrice").val(extra_money_added);
                $("#editAddonOfferPrice").val(offer_money_added);
                $("#editAddonOfferPriceStartDate").val(offer_money_from);
                $("#editAddonOfferPriceEndDate").val(offer_money_to);


                $('#editSubCategoryModal').modal('show');
                $('.loader-holder').hide();
            }

            function subCategoryTitleChange() {
                $('.loader-holder').show();

                var titleId = $('#addSubCategoryOptionTitle option:selected').val();

                if (titleId != "" && titleId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllAddedSubCategoryOptionFromSubCategoryTitleAsDataTable",
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




            $addSubCategoryLogo = $('#addSubCategoryLogo').croppie({
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


            $('#addSubCategoryLogoButton').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $addSubCategoryLogo.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('Picture Binding Complete !');
                    });

                }
                reader.readAsDataURL(this.files[0]);
            });

            function addSubCategoryAddon() {

                $('.loader-holder').show();

                var subCategoryId = <?php echo $subCategoryId;?>;

                var subCategoryAddonName = $("#addSubCategoryOptionName").val();
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

                if (subCategoryId != "" && subCategoryAddonName != "" && extraPrice != "" && offerPrice != "" && offerPriceStartDate != "" && offerPriceEndDate != "") {

                    $addSubCategoryLogo.croppie('result', {
                        type: 'canvas',
                        size: 'viewport'
                    }).then(function(resp) {

                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "saveSubCategoryAddon",


                                    subCategoryId: subCategoryId,

                                    subCategoryAddonName: subCategoryAddonName,
                                    subCategoryAddonImage: resp,
                                    subCategoryAddonExtraMoneyAdded: extraPrice,
                                    subCategoryAddonOfferMoneyAdded: offerPrice,
                                    subCategoryAddonOfferMoneyFrom: offerPriceStartDate,
                                    subCategoryAddonOfferMoneyTo: offerPriceEndDate

                                }
                            })
                            .done(function(response) {
                                $('.loader-holder').hide();

                                if (parseInt(response) == 1) {

                                    swal("SubCategory Addon Added Successfully !", " ", "success");
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

            function saveEditSubCategoryAddon() {

                $('.loader-holder').show();

                var editSubCategoryAddonId = $("#editSubCategoryAddonId").val();
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

                if (editSubCategoryAddonId != "" && editAddonExtraPrice != "" && editAddonOfferPrice != "" && editAddonOfferPriceStartDate != "" && editAddonOfferPriceEndDate != "") {


                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveEditSubCategoryAddon",

                                subCategoryAddonId: editSubCategoryAddonId,
                                subCategoryAddonExtraMoneyAdded: editAddonExtraPrice,
                                subCategoryAddonOfferMoneyAdded: editAddonOfferPrice,
                                subCategoryAddonOfferMoneyFrom: editAddonOfferPriceStartDate,
                                subCategoryAddonOfferMoneyTo: editAddonOfferPriceEndDate

                            }
                        })
                        .done(function(response) { 
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("subCategory Addon Edited Successfully !", " ", "success");
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
