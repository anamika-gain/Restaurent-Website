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
                        <h1 class="m-0 text-dark">Ingredient Category Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Product Management</a></li>
                            <li class="breadcrumb-item active">Ingredient Category Management</li>
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
                        <h3 class="card-title">Ingredient Category List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addIngredientModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfIngredientCategoryTable(" ");
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
                                    <td class="text-center <?php echo $colorClass; ?>"><?php echo $statusValue; ?></td>

                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                                <div class="dropdown-menu text-center" role="menu">

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditIngredientCategory('<?php echo $id; ?>', '<?php echo $result[$key]['name']; ?>', '<?php echo $result[$key]['branch_id']; ?>')">Edit</a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Ingredient Category ?','ingredient_category','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                        } else {
                                                        ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Ingredient Category ?','ingredient_category','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                        }
                                                        ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Ingredient Category ? Once Done, It Can Not Be Undone !','ingredient_category','<?php echo $id; ?>','0')">Delete</a>
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



    <!-- add Ingredient Category Modal -->
    <div class="modal fade" id="addIngredientModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Ingredient Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ingredient Category Name</label>
                                <input type="text" class="form-control" placeholder="Ingredient Category Name" name="addIngredientCategoryName" id="addIngredientName" required><br>
                            </div>
                        </div>


                        <?php 
                        $specialQuery = "";
                        $allBranch = getAllDataOfBranchTable($specialQuery);?>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select A Branch for the Ingredient Category </label>
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





                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addIngredientCategorySaveButton" onclick="saveIngredientCategory()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Ingredient Category Modal -->


    <!-- add Ingredient Category Modal -->
    <div class="modal fade" id="editIngredientModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Ingredient Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editIngredientId" value="0">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ingredient Category Name</label>
                                <input type="text" class="form-control" placeholder="Ingredient Category Name" name="editIngredientName" id="editIngredientName" required><br>
                            </div>
                        </div>



                        <?php $allBranch = getAllDataOfBranchTable("");?>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Edit Ingredient Category Branch</label>
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
                                <label>Edit Ingredient Category Sub Branch </label>
                                <select id="editIngredientSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Branch--</option>

                                </select>
                            </div>
                        </div> -->



                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editIngredientLogoButton')">Unselect Image</button> -->
                    <button type="button" class="btn btn-primary" id="editIngredientSaveButton" onclick="saveEditIngredientCategory()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Ingredient Category Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });


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



            // $('#editIngredientBranchId').change(function() {
            //     $('.loader-holder').show();

            //     fetchSubBranch();



            // });






        });




        function saveIngredientCategory() {

            $('.loader-holder').show();

            var name = $("#addIngredientName").val();
            // var subBranchId = $("#addIngredientSubBranchId").val();
            var branchId = $("#addIngredientBranchId").val();

            //            alert(name + subBranchId + branchId);
            // $('.loader-holder').hide();
            // return false;

            if (name != "" && branchId != "") {


                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveIngredientCategory",

                            name: name,

                            // subBranchId: subBranchId,
                            branchId: branchId,

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



        function promtEditIngredientCategory(id, name, branchId, ) {
            $('.loader-holder').show();


            $("#editIngredientId").val(id);
            $("#editIngredientName").val(name);

            $("#editIngredientBranchId").val(branchId);
            // fetchSubBranch();
            // $("#editIngredientSubBranchId").val(subBranchId);



            $('#editIngredientModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditIngredientCategory() {
            $('.loader-holder').show();


            var id = $("#editIngredientId").val();

            var name = $("#editIngredientName").val();

            // var subBranchId = $("#editIngredientSubBranchId").val();
            var branchId = $("#editIngredientBranchId").val();

            //            alert(name + subBranchId + branchId + id);
            // $('.loader-holder').hide();
            // return false;

            if (name != "" && branchId != "") {

                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveEditIngredientCategory",

                            id: id,
                            name: name,
                            // subBranchId: subBranchId,
                            branchId: branchId,

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

    </script>


    </body>

    </html>
