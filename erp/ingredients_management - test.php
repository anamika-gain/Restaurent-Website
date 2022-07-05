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
                        <h1 class="m-0 text-dark">Ingredient Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                            <li class="breadcrumb-item active">Ingredient Management</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ingredient List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addIngredientModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Image</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Default Weight</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfIngredientTable(" ");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center">
                                        <div>
                                            <!-- <img src="images/<?php echo $result[$key]['image']; ?>" width="auto" height="100px"> -->
                                            <?php echo $id; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            <!-- <img src="images/<?php echo $result[$key]['image']; ?>" width="auto" height="100px"> -->
                                            <?php echo $result[$key]['default_weight_in']; ?>
                                        </div>
                                    </td>
                                    <!--                                    getWeightDetailsFromId-->
                                    <td class="text-center"><b><?php echo $result[$key]['ingredient_name']; ?></b></td>
                                    <td class="text-center"><b><?php $weight = getWeightDetailsFromId($result[$key]['default_weight_in']); echo $weight['name']; ?></b></td>
                                    <td class="text-center"><b><?php $cat = getIngredientCategoryDetailsFromId($result[$key]['ingredient_category_id']); echo $cat['name']; ?></b></td>
                                    <td class="text-center"><b><?php $sub_cat = getIngredientSubCategoryDetailsFromId($result[$key]['ingredient_sub_category_id']); echo $sub_cat['name']; ?></b></td>
                                    <td class="text-center"><?php $branchDetails = getbranchDetailsFromId($result[$key]['branch_id']); echo $branchDetails['name']; ?></td>
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

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditIngredient('<?php echo $id; ?>', '<?php echo $result[$key]['ingredient_name']; ?>', '<?php echo $result[$key]['image']; ?>', '<?php echo $result[$key]['branch_id']; ?>', '<?php echo $result[$key]['ingredient_category_id']; ?>', '<?php echo $result[$key]['ingredient_sub_category_id']; ?>')">Edit</a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Ingredient ?','ingredients','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                        } else {
                                                        ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Ingredient ?','ingredients','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                        }
                                                        ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Ingredient ? Once Done, It Can Not Be Undone !','ingredients','<?php echo $id; ?>','0')">Delete</a>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Default Weight</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Branch</th>
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



    <!-- add Ingredient Modal -->
    <div class="modal fade" id="addIngredientModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Ingredient</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Ingredient Name</label>
                                <input type="text" class="form-control" placeholder="Ingredient Name" name="addIngredientName" id="addIngredientName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ingredient Default Weight Unit</label>
                                <select id="addIngredientDefaultWeightUnit" class="form-control">

                                    <?php $result = getAllDataOfWeightTable("");
                                     foreach ($result as $key => $value) {?>
                                    <option value="<?php echo $result[$key]['id'];?>"><?php echo $result[$key]['name'];?></option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>

                        <?php $specialQuery = "";
                        $allBranch = getAllDataOfBranchTable("");
                        $allCategory = getAllDataOfIngredientCategoryTable($specialQuery);
                        ?>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Branch for the Ingredient </label>
                                <select id="addIngredientBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Sub Branch </label>
                                <select id="addIngredientSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Branch--</option>

                                </select>
                            </div>
                        </div> -->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Category for the Ingredients Sub Category </label>
                                <select id="addIngredientCategoryId" class="form-control">
                                    <option value="null" selected disabled>--Select A Category--</option>

                                    <?php foreach($allCategory as $categoryDetailsKey=>$categoryDetails){?>

                                    <option value="<?php echo intval($allCategory[$categoryDetailsKey]['id']);?>"><?php echo $allCategory[$categoryDetailsKey]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Sub Category </label>
                                <select id="addIngredientSubCategoryId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Category--</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-8 text-center">
                            <div class="form-group">
                                <label>Ingredient Image Resize</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <div id="addIngredientLogo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom:300px;">
                            <div class="form-group">
                                <label>Ingredient Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="addIngredientLogo" id="addIngredientLogoButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addIngredientSaveButton" onclick="saveIngredient()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Ingredient Modal -->


    <!-- add Ingredient Modal -->
    <div class="modal fade" id="editIngredientModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Ingredient</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editIngredientId" value="0">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Ingredient Name</label>
                                <input type="text" class="form-control" placeholder="Ingredient Name" name="editIngredientName" id="editIngredientName" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ingredient Default Weight Unit</label>
                                <select id="editIngredientDefaultWeightUnit" class="form-control">

                                    <?php $result = getAllDataOfWeightTable("");
                                     foreach ($result as $key => $value) {?>
                                    <option value="<?php echo $result[$key]['id'];?>"><?php echo $result[$key]['name'];?></option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>


                        <?php $allBranch = getAllDataOfBranchTable("");?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Ingredient Branch</label>
                                <select id="editIngredientBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Ingredient Sub Branch </label>
                                <select id="editIngredientSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Branch--</option>

                                </select>
                            </div>
                        </div> -->


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Category for the Ingredients Sub Category </label>
                                <select id="editIngredientCategoryId" class="form-control">
                                    <option value="null" selected disabled>--Select A Category--</option>

                                    <?php foreach($allCategory as $categoryDetailsKey=>$categoryDetails){?>

                                    <option value="<?php echo intval($allCategory[$categoryDetailsKey]['id']);?>"><?php echo $allCategory[$categoryDetailsKey]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Sub Category </label>
                                <select id="editIngredientSubCategoryId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Category--</option>

                                </select>
                            </div>
                        </div>





                        <div class="col-md-8 text-center" id="editCurrentIngredientLogo">
                            <div class="form-group">
                                <label>Ingredient Current Image</label>
                                <div class="input-group">
                                    <div style="margin:auto;">
                                        <img src="" height="200px" width="200px" id="editIngredientCurrentLogo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 text-center" id="editIngredientLogo">
                            <div class="form-group">
                                <label>Ingredient Image Resize</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Choose Ingredient Image</label>
                                <div class="input-group">
                                    <!-- <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="editIngredientLogoButton" id="editIngredientLogoButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div> -->
                                    <input type="file" name="editIngredientLogoButton" id="editIngredientLogoButton">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editIngredientLogoButton')">Unselect Image</button> -->
                    <button type="button" class="btn btn-primary" id="editIngredientSaveButton" onclick="saveEditIngredient()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Ingredient Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });

            $('#editIngredientLogo').hide();

            // $('#addIngredientBranchId').change(function() {
            //     $('.loader-holder').show();

            //     var selectedBranchId = $('#addIngredientBranchId option:selected').val();

            //     if (selectedBranchId != "" && selectedBranchId != "null") {

            //         $.ajax({
            //                 method: "post",
            //                 url: 'ajaxfunctions.php',
            //                 data: {
            //                     funName: "getAllSubBranchDataFromBranchIdAsHtmlOption",
            //                     branchId: selectedBranchId
            //                 }
            //             })
            //             .done(function(response) {

            //                 $('#addIngredientSubBranchId').html(response);
            //                 $('.loader-holder').hide();



            //             });
            //     }



            // });

            $('#addIngredientCategoryId').change(function() {
                $('.loader-holder').show();

                var selectedBranchId = $('#addIngredientCategoryId option:selected').val();

                if (selectedBranchId != "" && selectedBranchId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "getAllSubCategoryDataFromCategoryIdAsHtmlOption",
                                categoryId: selectedBranchId,
                                scTable: "ingredient_sub_category",
                                scTableColumn: "category_id",
                                rscTableColumn: "name",
                            }
                        })
                        .done(function(response) {

                            $('#addIngredientSubCategoryId').html(response);
                            $('.loader-holder').hide();



                        });
                }



            });

            // $('#editIngredientBranchId').change(function() {
            //     $('.loader-holder').show();

            //     fetchSubBranch();



            // });


            $('#editIngredientCategoryId').change(function() {
                $('.loader-holder').show();
                fetchSubCategory();





            });


        });

        $addIngredientLogo = $('#addIngredientLogo').croppie({
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


        $('#addIngredientLogoButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $addIngredientLogo.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);
        });



        $editIngredientLogo = $('#editIngredientLogo').croppie({
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


        $('#editIngredientLogoButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $editIngredientLogo.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);
            $('#editCurrentIngredientLogo').hide();
            $('#editIngredientLogo').show();
        });





        function saveIngredient() {

            $('.loader-holder').show();

            var name = $("#addIngredientName").val();
            var defaultWeightIn = $("#addIngredientDefaultWeightUnit").val();
            // var subBranchId = $("#addIngredientSubBranchId").val();
            var branchId = $("#addIngredientBranchId").val();
            var category = $("#addIngredientCategoryId").val();
            var subCategory = $("#addIngredientSubCategoryId").val();

            if (name != "" && defaultWeightIn != ""  && branchId != "" && category != "" && subCategory != "") {
                $addIngredientLogo.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {



                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveIngredient",

                                name: name,
                                defaultWeightIn: defaultWeightIn,
                                // subBranchId: subBranchId,
                                branchId: branchId,
                                photo: resp,
                                category: category,
                                subCategory: subCategory
                            }
                        })
                        .done(function(response) {

                            //console.log(response);

                            $('.loader-holder').hide();

                            if (parseInt(response) == 1) {

                                swal("Request Successful !", {
                                    icon: "success",
                                });

                                setTimeout(
                                    function() {
                                        location.reload();
                                    }, 2000);

                            } else {
                                swal("Request Can't Be Processed !", {
                                    icon: "error",
                                });
                            }
                        });
                });
            }
        }

        // function fetchSubBranch() {
        //     var selectedCategoryId = $('#editIngredientBranchId option:selected').val();

        //     if (selectedCategoryId != "" && selectedCategoryId != "null") {

        //         $.ajax({
        //                 method: "post",
        //                 url: 'ajaxfunctions.php',
        //                 data: {
        //                     funName: "getAllSubBranchDataFromBranchIdAsHtmlOption",
        //                     branchId: selectedCategoryId
        //                 }
        //             })
        //             .done(function(response) {

        //                 $('#editIngredientSubBranchId').html(response);
        //                 $('.loader-holder').hide();



        //             });
        //     }
        // }

        function fetchSubCategory() {
            $('.loader-holder').show();

            var selectedBranchId = $('#editIngredientCategoryId option:selected').val();

            if (selectedBranchId != "" && selectedBranchId != "null") {

                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "getAllSubCategoryDataFromCategoryIdAsHtmlOption",
                            categoryId: selectedBranchId,
                            scTable: "ingredient_sub_category",
                            scTableColumn: "category_id",
                            rscTableColumn: "name",
                        }
                    })
                    .done(function(response) {

                        $('#editIngredientSubCategoryId').html(response);
                        $('.loader-holder').hide();



                    });
            }
        }

        function promtEditIngredient(id, name, logoName, branchId, categoryId, subCategoryId) {
            $('.loader-holder').show();

            $('#editCurrentIngredientLogo').show();
            $('#editIngredientLogo').hide();

            $("#editIngredientCurrentLogo").attr("src", "images/" + logoName);
            $("#editIngredientId").val(id);
            $("#editIngredientName").val(name);

            $("#editIngredientBranchId").val(branchId);
            // fetchSubBranch();
            // $("#editIngredientSubBranchId").val(subBranchId);

            $("#editIngredientCategoryId").val(categoryId);
            fetchSubCategory();
            $("#editIngredientSubCategoryId").val(subCategoryId);

            $('#editIngredientModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditIngredient() {
            $('.loader-holder').show();


            var id = $("#editIngredientId").val();

            var name = $("#editIngredientName").val();
            var defaultWeightIn = $("#editIngredientDefaultWeightUnit").val();
            // var subBranchId = $("#editIngredientSubBranchId").val();
            var branchId = $("#editIngredientBranchId").val();
            var category = $("#editIngredientCategoryId").val();
            fetchSubCategory();
            var subCategory = $("#editIngredientSubCategoryId").val();

            var currentLogoName = $('#editIngredientCurrentLogo').attr('src').slice(7);
            var logoChanged = $('#editIngredientLogoButton').get(0).files.length;
            //console.log(currentLogoName+" --> "+logoChanged);



            $editIngredientLogo.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {



                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveEditIngredient",

                            id: id,
                            name: name,
                            defaultWeightIn: defaultWeightIn,
                            // subBranchId: subBranchId,
                            branchId: branchId,
                            photo: resp,
                            imageChanged: logoChanged,
                            currentLogoName: currentLogoName,
                            category: category,
                            subCategory: subCategory
                        }
                    })
                    .done(function(response) {

                        //console.log(response);

                        $('.loader-holder').hide();

                        if (parseInt(response) == 1) {

                            swal("Request Successful !", {
                                icon: "success",
                            });
                            setTimeout(
                                function() {
                                    location.reload();
                                }, 2000);

                        } else {
                            swal("Request Can't Be Processed !", {
                                icon: "error",
                            });
                        }
                    });
            });
        }

    </script>


    </body>

    </html>
