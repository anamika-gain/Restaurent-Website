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
                        <h1 class="m-0 text-dark">Product Sub Category Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                            <li class="breadcrumb-item active">Product Sub Category Management</li>
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
                        <h3 class="card-title">Product Sub Category List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addProductModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfProductSubCategoryTable(" ");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>

                                    <td class="text-center"><b><?php echo $result[$key]['name']; ?></b></td>
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
                                    <td class="text-center"><?php $categoryDetails = getProductCategoryDetailsFromId($result[$key]['category_id']); echo $categoryDetails['name']; ?></td>
                                    <td class="text-center <?php echo $colorClass; ?>"><?php echo $statusValue; ?></td>

                                    <td class="text-center">
                                    <a class="btn btn-default" href="sub_category_add_on.php?subCategoryId=<?php echo $id; ?>">Addons Management</a>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                                <div class="dropdown-menu text-center" role="menu">

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditProductSubCategory('<?php echo $id; ?>', '<?php echo $result[$key]['name']; ?>', '<?php echo $result[$key]['branch_id']; ?>','<?php echo $result[$key]['category_id']; ?>')">Edit</a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Product Sub Category ?','product_sub_category','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                        } else {
                                                        ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Product Sub Category ?','product_sub_category','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                        }
                                                        ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product Sub Category ? Once Done, It Can Not Be Undone !','product_sub_category','<?php echo $id; ?>','0')">Delete</a>
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
                                    <th>Branch</th>
                                    <th>Category</th>
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


    <div class="modal fade" id="addProductModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Product Sub Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Sub Category Name</label>
                                <input type="text" class="form-control" placeholder="Product Sub Category Name" name="addProductSubCategoryName" id="addProductName" required><br>
                            </div>
                        </div>


                        <?php 
                        $specialQuery = "";
                        $allBranch = getAllDataOfBranchTable($specialQuery);
                        $allCategory = getAllDataOfProductCategoryTable($specialQuery);
                        ?>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Category for the Product Sub Category </label>
                                <select id="addProductCategoryId" class="form-control">
                                    <option value="null" selected disabled>--Select A Category--</option>

                                    <?php foreach($allCategory as $categoryDetailsKey=>$categoryDetails){?>

                                    <option value="<?php echo intval($allCategory[$categoryDetailsKey]['id']);?>"><?php echo $allCategory[$categoryDetailsKey]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Branch for the Product Sub Category </label>
                                <select id="addProductBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Select A Sub Branch for Product Sub Category </label>
                                <select id="addProductSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Branch--</option>

                                </select>
                            </div>
                        </div> -->





                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addProductSubCategorySaveButton" onclick="saveProductSubCategory()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- edit Product Sub Category Modal -->
    <div class="modal fade" id="editProductModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product Sub Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editProductId" value="0">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Sub Category Name</label>
                                <input type="text" class="form-control" placeholder="Product Sub Category Name" name="editProductName" id="editProductName" required><br>
                            </div>
                        </div>


                        <?php
                         $specialQuery = "";
                        $allBranch = getAllDataOfBranchTable($specialQuery);
                        $allCategory = getAllDataOfProductCategoryTable($specialQuery);
                        ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Category for the Product Sub Category </label>
                                <select id="editProductCategoryId" class="form-control">
                                    <option value="null" selected disabled>--Select A Category--</option>

                                    <?php foreach($allCategory as $categoryDetailsKey=>$categoryDetails){?>

                                    <option value="<?php echo intval($allCategory[$categoryDetailsKey]['id']);?>"><?php echo $allCategory[$categoryDetailsKey]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Branch for the Product Sub Category </label>
                                <select id="editProductBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Edit Sub Branch for Product Sub Category </label>
                                <select id="editProductSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Branch--</option>

                                </select>
                            </div>
                        </div> -->



                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editProductLogoButton')">Unselect Image</button> -->
                    <button type="button" class="btn btn-primary" id="editProductSaveButton" onclick="saveEditProductSubCategory()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- edit Product Sub Category Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });


            // $('#addProductBranchId').change(function() {
            //     $('.loader-holder').show();

            //     var selectedBranchId = $('#addProductBranchId option:selected').val();

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

            //                 $('#addProductSubBranchId').html(response);
            //                 $('.loader-holder').hide();



            //             });
            //     }



            // });



            // $('#editProductBranchId').change(function() {
            //     $('.loader-holder').show();

            //     var selectedBranchId = $('#editProductBranchId option:selected').val();

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

            //                 $('#editProductSubBranchId').html(response);
            //                 $('.loader-holder').hide();



            //             });
            //     }



            // });



        });




        function saveProductSubCategory() {

            $('.loader-holder').show();

            var name = $("#addProductName").val();
            var subBranchId = $("#addProductSubBranchId option:selected").val();
            var branchId = $("#addProductBranchId option:selected").val();
            var categoryId = $("#addProductCategoryId option:selected").val();


            if (name != ""  && branchId != "") {
                if (branchId != "null" || categoryId != "null") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveProductSubCategory",

                                name: name,

                                // subBranchId: subBranchId,
                                branchId: branchId,
                                categoryId: categoryId

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

                } else {
                    $('.loader-holder').hide();
                    swal("Please Fill Everything", "", "warning");
                    return false;
                }
            } else {
                $('.loader-holder').hide();

                swal("Please Fill Everything", "", "warning");
                return false;
            }
        }





        function promtEditProductSubCategory(id, name, branchId,  categoryId) {
            //            alert(id + name + branchId + subBranchId + categoryId);

            //            alert(branchId);
            $('.loader-holder').show();


            $("#editProductId").val(id);
            $("#editProductName").val(name);

            $("#editProductCategoryId").val(categoryId);
            $("#editProductBranchId").val(branchId);
            //            alert($("#editProductBranchId").val());
            // fetchSubBranch();
            //$("#editProductSubBranchId").val(subBranchId);



            $('#editProductModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditProductSubCategory() {
            $('.loader-holder').show();


            var id = $("#editProductId").val();

            var name = $("#editProductName").val();

            // var subBranchId = $("#editProductSubBranchId").val();
            var branchId = $("#editProductBranchId").val();
            var categoryId = $("#editProductCategoryId").val();


            if (name != "" && branchId != "") {
                if (name != "null"  && branchId != "null") {}
                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveEditProductSubCategory",

                            id: id,
                            name: name,

                            // subBranchId: subBranchId,
                            branchId: branchId,
                            categoryId: categoryId

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
            } else {
                swal("PLease Fill Everything", "", "Warning");
            }

        }

        // function fetchSubBranch() {
        //     var selectedCategoryId = $('#editProductBranchId option:selected').val();

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

        //                 $('#editProductSubBranchId').html(response);
        //                 $('.loader-holder').hide();



        //             });
        //     }
        // }

    </script>


    </body>

    </html>
