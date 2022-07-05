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
                        <h1 class="m-0 text-dark">Branch Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Branch Management</li>
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
                        <h3 class="card-title">Branch List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addBranchModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfBranchTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center">
                                        <div>
                                            <img src="images/<?php echo $result[$key]['logo']; ?>" width="auto" height="100px">
                                        </div>
                                    </td>
                                    <td class="text-center"><b><?php echo $result[$key]['name']; ?></b></td>
                                    <td class="text-center"><?php echo $result[$key]['created_at']; ?></td>
                                    <td class="text-center"><?php echo getUserFullNameFromId($result[$key]['created_by']); ?></td>
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

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditBranch('<?php echo $id; ?>', '<?php echo $result[$key]['name']; ?>', '<?php echo $result[$key]['logo']; ?>')">Edit</a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Branch ?','branch','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                        } else {
                                                        ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Branch ?','branch','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                        }
                                                        ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Branch ? Once Done, It Can Not Be Undone !','branch','<?php echo $id; ?>','0')">Delete</a>
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
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
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



    <!-- add Branch Modal -->
    <div class="modal fade" id="addBranchModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Branch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" placeholder="Branch Name" name="addBranchName" id="addBranchName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Logo Resize</label>
                                <div class="input-group">
                                    <div class="custom-file" style="padding-bottom: 330px;">
                                        <div id="addBranchLogo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="addBranchLogo" id="addBranchLogoButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addBranchSaveButton" onclick="saveBranch()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Branch Modal -->


    <!-- add Branch Modal -->
    <div class="modal fade" id="editBranchModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Branch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editBranchId" value="0">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" placeholder="Branch Name" name="editBranchName" id="editBranchName" required><br>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Branch Current Logo</label>
                                <div class="input-group">
                                    <div>
                                        <img src="" height="200px" width="200px" id="editBranchCurrentLogo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Logo Resize</label>
                                <div class="input-group">
                                    <div class="custom-file" style="padding-bottom: 330px;">
                                        <div id="editBranchLogo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Branch Logo</label>
                                <div class="input-group">
                                    <!-- <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="editBranchLogoButton" id="editBranchLogoButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div> -->
                                    <input type="file" name="editBranchLogoButton" id="editBranchLogoButton">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editBranchLogoButton')">Unselect Image</button> -->
                    <button type="button" class="btn btn-primary" id="editBranchSaveButton" onclick="saveEditBranch()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Branch Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });

        });

        $addBranchLogo = $('#addBranchLogo').croppie({
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


        $('#addBranchLogoButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $addBranchLogo.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);
        });



        $editBranchLogo = $('#editBranchLogo').croppie({
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


        $('#editBranchLogoButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $editBranchLogo.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);
        });





        function saveBranch() {

            $('.loader-holder').show();

            var branchName = $("#addBranchName").val();


            $addBranchLogo.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {



                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveBranch",
                            "branchLogo": resp,
                            branchName: branchName
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

        function promtEditBranch(id, name, logoName) {
            $('.loader-holder').show();

            $("#editBranchCurrentLogo").attr("src", "images/" + logoName);
            $("#editBranchId").val(id);
            $("#editBranchName").val(name);

            $('#editBranchModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditBranch() {
            $('.loader-holder').show();


            var id = $("#editBranchId").val();
            var name = $("#editBranchName").val();
            var currentLogoName = $('#editBranchCurrentLogo').attr('src').slice(7);
            var logoChanged = $('#editBranchLogoButton').get(0).files.length;
            //console.log(currentLogoName+" --> "+logoChanged);



            $editBranchLogo.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {



                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveEditBranch",
                            branchId: id,
                            "branchLogo": resp,
                            branchName: name,
                            currentLogoName: currentLogoName,
                            logoChanged: logoChanged
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
