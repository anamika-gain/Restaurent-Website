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
                        <h1 class="m-0 text-dark">Vendor Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Vendor Management</a></li>
                            <li class="breadcrumb-item active">Vendor Management</li>
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
                        <h3 class="card-title">Vendor List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addVendorModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="branchTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Mobile</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>Contact Person Mobile</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfVendorTable(" ");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center">
                                        <?php echo $result[$key]['company_name']; ?>
                                    </td>
                                    <td class="text-center"><b>
                                        <?php $branchDetails = getbranchDetailsFromId($result[$key]['branch_id']); echo $branchDetails['name']; ?>
                                        
                                    </b>
                                </td>
                                    <td class="text-center"><?php echo $result[$key]['mobile']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['phone']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['email']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['address']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['contact_person']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['contact_person_mobile']; ?></td>
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

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditVendor('<?php echo $id; ?>', '<?php echo $result[$key]['branch_id']; ?>', '<?php echo $result[$key]['company_name']; ?>', '<?php echo $result[$key]['mobile']; ?>', '<?php echo $result[$key]['phone']; ?>', '<?php echo $result[$key]['email']; ?>', '<?php echo $result[$key]['address']; ?>', '<?php echo $result[$key]['contact_person']; ?>', '<?php echo $result[$key]['contact_person_mobile']; ?>')">Edit</a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Vendor ?','vendor','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                        } else {
                                                        ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Vendor ?','vendor','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                        }
                                                        ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Vendor ? Once Done, It Can Not Be Undone !','vendor','<?php echo $id; ?>','0')">Delete</a>
                                                </div>
                                            </button>
                                        </div>
                                        <div class="btn-group mt-1">
                                            <button type="button" class="btn btn-primary " onclick="window.location.href='vendor_category_management.php?userId=<?php echo $id;?>'">Add Category</button>
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Mobile</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Contact Person</th>
                                    <th>Contact Person Mobile</th>
                                    <th>Status</th>
                                    <th>Options</th>
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



    <!-- add Vendor Modal -->
    <div class="modal fade" id="addVendorModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Vendor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Name" name="addVendorName" id="addVendorName" required><br>
                            </div>
                        </div>
                    
                        <?php $specialQuery = "";
                        $allBranch = getAllDataOfBranchTable("");
                        
                        ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Branch for the Vendor </label>
                                <select id="addVendorBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Mobile" name="addVendorMobile" id="addVendorMobile" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Phone</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Phone" name="addVendorPhone" id="addVendorPhone" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Email</label>
                                <input type="email" class="form-control" placeholder="Enter Vendor Email" name="addVendorEmail" id="addVendorEmail" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Address</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Address" name="addVendorAddress" id="addVendorAddress" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Contact Person</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Contact Person" name="addVendorContactPerson" id="addVendorContactPerson" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Contact Person Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Contact Person Mobile" name="addVendorContactPersonMobile" id="addVendorContactPersonMobile" required><br>
                            </div>
                        </div>

                        

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addVendorSaveButton" onclick="saveVendor()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Vendor Modal -->


    <!-- add Vendor Modal -->
    <div class="modal fade" id="editVendorModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Vendor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editVendorId" value="0">

                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Name" name="editVendorName" id="editVendorName" required><br>
                            </div>
                        </div>
                    
                        <?php $specialQuery = "";
                        $allBranch = getAllDataOfBranchTable("");
                        
                        ?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Branch for the Vendor </label>
                                <select id="editVendorBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Mobile" name="editVendorMobile" id="editVendorMobile" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Phone</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Phone" name="editVendorPhone" id="editVendorPhone" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Email</label>
                                <input type="email" class="form-control" placeholder="Enter Vendor Email" name="editVendorEmail" id="editVendorEmail" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Address</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Address" name="editVendorAddress" id="editVendorAddress" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Contact Person</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Contact Person" name="editVendorContactPerson" id="editVendorContactPerson" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Contact Person Mobile</label>
                                <input type="text" class="form-control" placeholder="Enter Vendor Contact Person Mobile" name="editVendorContactPersonMobile" id="editVendorContactPersonMobile" required><br>
                            </div>
                        </div>

                        

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-default" onclick="unselectImage('editVendorLogoButton')">Unselect Image</button> -->
                    <button type="button" class="btn btn-primary" id="editVendorSaveButton" onclick="saveEditVendor()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Vendor Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });

            $('#editVendorLogo').hide();

            // $('#addVendorBranchId').change(function() {
            //     $('.loader-holder').show();

            //     var selectedBranchId = $('#addVendorBranchId option:selected').val();

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

            //                 $('#addVendorSubBranchId').html(response);
            //                 $('.loader-holder').hide();



            //             });
            //     }



            // });

           

            // $('#editVendorBranchId').change(function() {
            //     $('.loader-holder').show();

            //     fetchSubBranch();



            // });


            $('#editVendorCategoryId').change(function() {
                $('.loader-holder').show();
                fetchSubCategory();





            });


        });


        function saveVendor() {

            $('.loader-holder').show();

            var branchId = $("#addVendorBranchId").val();
            // var subBranchId = $("#addVendorSubBranchId").val();
            var companyName = $("#addVendorName").val();
            var mobile = $("#addVendorMobile").val();
            var phone = $("#addVendorPhone").val();
            var email = $("#addVendorEmail").val();
            var address = $("#addVendorAddress").val();
            var contactPerson = $("#addVendorContactPerson").val();
            var contactPersonMobile = $("#addVendorContactPersonMobile").val();


            var intRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
            if (!mobile.match(intRegex)) {
                swal('Enter a Valid Mobile Number', '', 'warning');
                $('.loader-holder').hide();
                return false;
            }

            if (branchId != "" && companyName != "" && mobile != "" && phone != "" && email != "" &&address!= "" && contactPerson!= "" &&contactPersonMobile != "") {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveVendor",

                                branchId: branchId,
                                // subBranchId: subBranchId,
                                companyName: companyName,
                                mobile: mobile,
                                phone: phone,
                                email: email,
                                address: address,
                                contactPerson: contactPerson ,
                                contactPersonMobile: contactPersonMobile    
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
        //     var selectedCategoryId = $('#editVendorBranchId option:selected').val();

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

        //                 $('#editVendorSubBranchId').html(response);
        //                 $('.loader-holder').hide();



        //             });
        //     }
        // }

    

        function promtEditVendor(id, branchId,  companyName, mobile, phone, email,address,contactPerson,contactPersonMobile) {
            $('.loader-holder').show();

            $("#editVendorId").val(id);
            $("#editVendorBranchId").val(branchId);

            // $("#editVendorSubBranchId").val(subBranchId);
            // fetchSubBranch();
            $("#editVendorName").val(companyName);
            $("#editVendorMobile").val(mobile);
            $("#editVendorPhone").val(phone);
            $("#editVendorEmail").val(email);
            $("#editVendorAddress").val(address);
            $("#editVendorContactPerson").val(contactPerson);
            $("#editVendorContactPersonMobile").val(contactPersonMobile);

           

            $('#editVendorModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditVendor() {
            $('.loader-holder').show();


            var id = $("#editVendorId").val();
            var branchId = $("#editVendorBranchId").val();
            // var subBranchId = $("#editVendorSubBranchId").val();
            var companyName = $("#editVendorName").val();
            var mobile = $("#editVendorMobile").val();
            var phone = $("#editVendorPhone").val();
            var email = $("#editVendorEmail").val();
            var address = $("#editVendorAddress").val();
            var contactPerson = $("#editVendorContactPerson").val();
            var contactPersonMobile = $("#editVendorContactPersonMobile").val();
          
            var intRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
            if (!mobile.match(intRegex)) {
                swal('Enter a Valid Mobile Number', '', 'warning');
                $('.loader-holder').hide();
                return false;
            }

if (id!="" && branchId != "" && companyName != "" && mobile != "" && phone != "" && email != "" &&address!= "" && contactPerson!= "" &&contactPersonMobile != "") {

                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveEditVendor",

                            id: id,
                            branchId: branchId,
                            // subBranchId: subBranchId,
                            companyName: companyName,
                            mobile: mobile,
                            phone: phone,
                            email: email,
                            address: address,
                            contactPerson: contactPerson,
                            contactPersonMobile: contactPersonMobile
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

    </script>


    </body>

    </html>
