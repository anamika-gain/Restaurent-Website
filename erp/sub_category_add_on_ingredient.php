    <?php require 'includes/header.php';
        if(!isset($_REQUEST['subCategoryId'])){
                echo "<script>window.location.href='404.php';</script>";
            }
            if(empty($_REQUEST['subCategoryId'])){
                    echo "<script>window.location.href='404.php';</script>";

            }
        $subCategoryId = $_REQUEST['subCategoryId'];
        //$count = mysqli_num_rows($con->query("select * from sub_category_addons_ingredients where status > 0 AND sub_category_id = '$subCategoryId'"));
        
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
                            <h1 class="m-0 text-dark">Sub Category Addon Ingredients</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Sub Category Addon Ingredients</li>
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
                                    <h3 class="card-title">Add Sub Category Addon Ingredients</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?php 
                            $subCategoryDetails = getProductSubCategoryDetailsFromId($subCategoryId);
                            ?>
                                <div class="card-body row">
                                    <div class="form-group col-md-6">
                                        <label for="">subCategory Name</label>
                                        <input type="text" readonly disabled class="form-control" id="subCategoryName" value="<?php echo $subCategoryDetails['name'];?>">
                                    </div>

                                    <?php $specialQuery = "";
                                    $addonTableDetails = getAllDataOfSubCategoryAddonTableFromSubCategoryId($subCategoryId);
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select A Sub Category Addon </label>
                                            <select id="addSubCategoryAddonId" class="form-control select2">
                                                <option value="null" selected disabled>--Select A SubCategory Addon--</option>

                                                <?php foreach($addonTableDetails as $addonKey=>$subCategorySizeDetails){?>

                                                <option value="<?php echo intval($addonTableDetails[$addonKey]['id']);?>"><?php echo $addonTableDetails[$addonKey]['name'];?></option>

                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select An Ingredient </label>
                                            <select id="addSubCategoryIngredientId" class="form-control select2">
                                                <option value="null" selected disabled>--Select An Ingredient--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Ingredient Amount</label>
                                        <input type="text" class="form-control" value="" id="addSubCategoryIngredientAmount" placeholder="Enter Ingredient Amount">
                                    </div>




                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button class="btn btn-primary btn-block" onclick="addSubCategoryIngredient();">Add</button>
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
                                <a href="sub_category_management.php" class="btn btn-warning btn-lg" style="margin:auto 10px"><b>Done</b></a>


                            </div>
                        </div>

                    </div>
                    <!--/.col (left) -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of SubCategory Ingredient(s) Added</h3>
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




        <!-- add SubCategory Modal -->
        <div class="modal fade" id="editSubCategoryModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit SubCategory Ingredient</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="editSubCategoryIngredientId" value="">

                            <div class="form-group col-md-4">
                                <label for="">SubCategory Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editSubCategoryName" class="form-control" value="">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Edit SubCategory Size Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editSubCategorySizeName" class="form-control" value="">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="">Edit SubCategory Ingredient Name (Not Editable)</label>
                                <input type="text" readonly disabled id="editSubCategoryIngredientName" class="form-control" value="">
                            </div>



                            <div class="form-group col-md-6">
                                <label>Ingredient Default Weight In (Not Editable)</label>
                                <input type="text" readonly disabled value="" id="editDefaultWeightIn" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Edit SubCategory Ingredient Amount**</label>
                                <input type="text" class="form-control" autofocus id="editSubCategoryIngredientAmount" value="" placeholder="Enter Ingredient Name">
                            </div>








                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editSubCategoryLogoButton')">Unselect Image</button> -->
                        <button type="button" class="btn btn-primary" id="editSubCategorySaveButton" onclick="saveEditSubCategoryIngredient()">Save</button>
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


                // var countOptions = <?php //echo $count;?>;
                // var subCategoryName = '<?php //echo $subCategoryName; ?>';
                // if (countOptions < 1) {
                //     swal("No Ingredient Added Yet!", "", "warning");
                // }else{
                //     swal("Total "+countOptions+" ingredints Found for "+subCategoryName+" !", "", "info");
                // }

                $('.select2').select2();

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


                $('#addSubCategoryAddonId').change(function() {
                    $('.loader-holder').show();

                    var selectedSizeId = $('#addSubCategoryAddonId option:selected').val();
                    var SubCategorySizeName = $('#addSubCategoryAddonId option:selected').text();

                    if (selectedSizeId != "" && selectedSizeId != "null") {

                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllUnaddedIngredientDetailsForAddingFromSubCategoryAddonIdAsHtmlOptions",
                                    subCategoryAddonId: selectedSizeId
                                }
                            })
                            .done(function(response) {
                                if (response != "") {
                                    $('#addSubCategoryIngredientId').html(response);
                                    $('.loader-holder').hide();

                                } else {
                                    $('#addSubCategoryIngredientId').html("<option value ='null' selected disabled >--Nothing To Show--</option>");

                                    $('.loader-holder').hide();

                                }

                            });


                        $.ajax({
                                method: "post",
                                url: 'ajaxfunctions.php',
                                data: {
                                    funName: "getAllAddedIngredientFromSubCategoryAddonIdAsDataTable",
                                    subCategoryAddonId: selectedSizeId
                                }
                            })
                            .done(function(response) {
                                //alert(response);
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
                                    $('#addSubCategoryIngredientId').html("<option value ='null' selected disabled >--No Ingredient Added--</option>");

                                    $('.loader-holder').hide();

                                }

                            });

                    }

                });




            });


            function addSubCategoryIngredient() {

                $('.loader-holder').show();

                var subCategoryAddonId = $("#addSubCategoryAddonId option:selected").val();
                var subCategoryAddonIngredientId = $("#addSubCategoryIngredientId option:selected").val();
                var subCategoryAddonIngredientAmount = $("#addSubCategoryIngredientAmount").val();

                var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                if (!float.test(subCategoryAddonIngredientAmount)) {
                    $('.loader-holder').hide();

                    swal("Addon Ingredient Amount Must be Decimal or Floating Digits", "", "warning");
                    return false;
                }

                if (subCategoryAddonId != "" && subCategoryAddonIngredientId != "" && subCategoryAddonIngredientAmount != "") {
                    if (subCategoryAddonIngredientId === "null" || subCategoryAddonIngredientAmount === "null") {
                        $('.loader-holder').hide();

                        swal("Please Select an Ingredient", "", "warning");
                        return false;
                    }

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveSubCategoryAddonIngredients",

                                subCategoryId: "<?php echo $subCategoryId;?>",
                                subCategoryAddonId: subCategoryAddonId,
                                subCategoryAddonIngredientId: subCategoryAddonIngredientId,
                                subCategoryAddonIngredientAmount: subCategoryAddonIngredientAmount
                            }
                        })
                        .done(function(response) {
                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("subCategory Addon Ingredient Added Successfully !", " ", "success");
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
