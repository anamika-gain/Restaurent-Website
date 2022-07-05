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
                        <h1 class="m-0 text-dark">Sub Branch Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Sub Branch Management</li>
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
                        <h3 class="card-title">Sub Branch List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addBranchModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-center">
                        <table id="subBranchTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Logo</th>
                                    <th>Branch Name</th>
                                    <th>Sub Branch Name</th>
                                    <th>Address</th>
                                    <th>Mobile<br>Telephone<br>Email</th>
                                    <th>Assigned Manager</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfSubBranchTable("");
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
                                    <td class="text-center"><b><?php $branchDetails = getBranchDetailsFromId($result[$key]['branch_id']); echo $branchDetails['name']; ?></b></td>
                                    <td class="text-center"><b><?php echo $result[$key]['name']; ?></b></td>
                                    <td class="text-center"><?php echo $result[$key]['address']; ?></td>

                                    <td class="text-center">
                                        <?php echo $result[$key]['mobile_number']; ?>
                                        <br>
                                        <?php echo $result[$key]['phone_number']; ?>
                                        <br>
                                        <?php echo $result[$key]['email']; ?>
                                    </td>

                                    <td class="text-center">
                                        <?php  $subBranchManager = getManagerDetailsFromSubBranchId($result[$key]['id']); 
                                        foreach ($subBranchManager as $key2 => $value2) {
                                    ?>

                                        <?php echo $subBranchManager[$key2]['full_name'];?> - <?php echo $subBranchManager[$key2]['mobile_number'];?><br>

                                        <?php }?>
                                    </td>

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

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditSubBranch('<?php echo $id; ?>', '<?php echo $result[$key]['name']; ?>', '<?php echo $result[$key]['branch_id']; ?>', '<?php echo $result[$key]['logo']; ?>', '<?php echo $result[$key]['address']; ?>', '<?php echo $result[$key]['mobile_number']; ?>', '<?php echo $result[$key]['phone_number']; ?>', '<?php echo $result[$key]['email']; ?>', '<?php echo $result[$key]['area']; ?>')">Edit</a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Sub Branch ?','sub_branch','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                } else {
                                                ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Sub Branch ?','sub_branch','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                }
                                                ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Sub Branch ? Once Done, It Can Not Be Undone !','sub_branch','<?php echo $id; ?>','0')">Delete</a>
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
                                    <th>Branch Name</th>
                                    <th>Sub Branch Name</th>
                                    <th>Address</th>
                                    <th>Mobile<br>Telephone<br>Email</th>
                                    <th>Assigned Manager</th>
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
                    <h4 class="modal-title">Add Sub Branch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Branch Name</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Name" name="addSubBranchName" id="addSubBranchName" required><br>
                            </div>
                        </div>

                        <?php $allBranch = getAllDataOfBranchTable(" AND status=1");?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Branch </label>
                                <select id="addSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Branch Address</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Address" name="addSubBranchAddress" id="addSubBranchAddress" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Branch Area</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Area" name="addSubBranchArea" id="addSubBranchArea" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Branch Telephone</label>
                                <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" placeholder="Sub Branch Telephone" name="addSubBranchTelephone" id="addSubBranchTelephone" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Branch Mobile</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Mobile" name="addSubBranchMobile" id="addSubBranchMobile" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Branch Email</label>
                                <input type="email" class="form-control" placeholder="Sub Branch Email" name="addSubBranchEmail" id="addSubBranchEmail" required><br>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Adjust sSub Branch Logo</label>
                                <div class="input-group">
                                    <div class="custom-file" style="padding-bottom: 330px;">
                                        <div id="addSubBranchLogo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Choose a Logo For Sub Branch</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="addSubBranchLogo" id="addSubBranchLogoButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addSubBranchSaveButton" onclick="saveSubBranch()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Branch Modal -->


    <!-- add Branch Modal -->
    <div class="modal fade" id="editSubBranchModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Sub Branch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editSubBranchId" value="0">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Edit Sub Branch Name</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Name" name="editSubBranchName" id="editSubBranchName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Branch </label>

                                <?php $allBranch = getAllDataOfBranchTable(" AND status=1");?>

                                <select id="editSubBranchBranchId" class="form-control">

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Sub Branch Address</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Address" name="editSubBranchAddress" id="editSubBranchAddress" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Sub Branch Area</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Area" name="editSubBranchArea" id="editSubBranchArea" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Sub Branch Telephone</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Telephone" name="editSubBranchTelephone" id="editSubBranchTelephone" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Sub Branch Mobile</label>
                                <input type="text" class="form-control" placeholder="Sub Branch Mobile" name="editSubBranchMobile" id="editSubBranchMobile" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Sub Branch Email</label>
                                <input type="email" class="form-control" placeholder="Sub Branch Email" name="editSubBranchEmail" id="editSubBranchEmail" required><br>
                            </div>
                        </div>
                        <div class="col-md-4" id="editSubBranchCurrentLogoDiv">
                            <div class="form-group text-center">
                                <label>Sub Branch Current Logo</label>
                                <div class="input-group">
                                    <div style="margin:auto;">
                                        <img src="" height="200px" width="200px" id="editSubBranchCurrentLogo">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="editSubBranchLogoDiv">
                            <div class="form-group">
                                <label>Adjust Logo Size</label>
                                <div class="input-group">
                                    <div class="custom-file" style="padding-bottom: 330px;">
                                        <div id="editSubBranchLogo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Change Sub Branch Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="editSubBranchLogoButton" id="editSubBranchLogoButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <!--<input type="file" class="custom-file-input" name="editSubBranchLogoButton" id="editSubBranchLogoButton">-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editSubBranchLogoButton')">Unselect Image</button> -->
                    <button type="button" class="btn btn-primary" id="editSubBranchSaveButton" onclick="saveEditSubBranch()">Save</button>
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

            $("#subBranchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });

        });

        $('#editSubBranchLogoDiv').hide();

        $addSubBranchLogo = $('#addSubBranchLogo').croppie({
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


        $('#addSubBranchLogoButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $addSubBranchLogo.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);
        });



        $editSubBranchLogo = $('#editSubBranchLogo').croppie({
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


        $('#editSubBranchLogoButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $editSubBranchLogo.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);

            $('#editSubBranchCurrentLogoDiv').hide();
            $('#editSubBranchLogoDiv').show();
        });





        function saveSubBranch() {



            var fullName = $("#addSubBranchName").val();
            var branchId = $("#addSubBranchId option:selected").val();
            var address = $("#addSubBranchAddress").val();
            var area = $("#addSubBranchArea").val();
            var phone = $("#addSubBranchTelephone").val();
            var mobile = $("#addSubBranchMobile").val();
            var email = $("#addSubBranchEmail").val();

            if (branchId == 'null') {
                swal("Please Select a Branch for the Sub Branch", "", "warning");
                return false;
            }

            var intRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
            if (!mobile.match(intRegex)) {
                swal('Enter a Valid Mobile Number', '', 'warning');
                return false;
            }



            if (fullName != "" && address != "" && area != "" && phone != "" && mobile != "" && email != "") {

                $addSubBranchLogo.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {

                    $('.loader-holder').show();

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveSubBranch",
                                logo: resp,
                                fullName: fullName,
                                branchId: branchId,
                                address: address,
                                area: area,
                                phone: phone,
                                mobile: mobile,
                                email: email,
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
            } else {
                swal("Please Fill All the Infomation for the Sub Branch", "", "error");
                return false;
            }
        }

        function promtEditSubBranch(id, name, branchId, logoName, address, mobile, telephone, email, area) {
            $('.loader-holder').show();

            $('#editSubBranchCurrentLogoDiv').show();
            $('#editSubBranchLogoDiv').hide();

            $("#editSubBranchCurrentLogo").attr("src", "images/" + logoName);
            $("#editSubBranchId").val(id);
            $("#editSubBranchBranchId").val(branchId);
            $("#editSubBranchName").val(name);
            $("#editSubBranchAddress").val(address);
            $("#editSubBranchArea").val(area);
            $("#editSubBranchTelephone").val(telephone);
            $("#editSubBranchMobile").val(mobile);
            $("#editSubBranchEmail").val(email);

            $('#editSubBranchModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditSubBranch() {
            $('.loader-holder').show();


            var id = $("#editSubBranchId").val();
            var fullName = $("#editSubBranchName").val();
            var branchId = $("#editSubBranchBranchId option:selected").val();
            var address = $("#editSubBranchAddress").val();
            var area = $("#editSubBranchArea").val();
            var phone = $("#editSubBranchTelephone").val();
            var mobile = $("#editSubBranchMobile").val();
            var email = $("#editSubBranchEmail").val();

            var currentLogoName = $('#editSubBranchCurrentLogo').attr('src').slice(7);
            var logoChanged = $('#editSubBranchLogoButton').get(0).files.length;
            //console.log(currentLogoName+" --> "+logoChanged);

            var intRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
            if (!mobile.match(intRegex)) {
                swal('Enter a Valid Mobile Number', '', 'warning');
                $('.loader-holder').hide();

                return false;
            }


            if (fullName != "" && address != "" && area != "" && phone != "" && mobile != "" && email != "") {
                $editSubBranchLogo.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {



                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveEditSubBranch",
                                fullName: fullName,
                                branchId: branchId,
                                logoUpdated: resp,
                                logoName: currentLogoName,
                                address: address,
                                area: area,
                                phone: phone,
                                mobile: mobile,
                                email: email,
                                id: id,
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
            } else {
                $('.loader-holder').hide();
                swal("Please Fill All the Infomation for the Sub Branch", "", "error");
                return false;
            }
        }

    </script>


    </body>

    </html>
