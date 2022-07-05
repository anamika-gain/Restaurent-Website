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
                        <h1 class="m-0 text-dark">User Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">User Management</li>
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
                        <h3 class="card-title">User List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addUserModal">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-center">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Photo</th>
                                    <th>Full Name</th>
                                    <th>User Name</th>
                                    <th>Mobile<br>Email</th>
                                    <th>Address(Present)</th>
                                    <th>Branch</th>
                                    <th>Sub Branch</th>
                                    <th style="min-width:100px">-User Type<br>-Employee Type</th>
                                    <th style="min-width:150px">-Salary Type<br>-Basic Salary</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfUserTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center">
                                        <div>
                                            <img src="images/<?php echo $result[$key]['photo']; ?>" width="auto" height="100px">
                                        </div>
                                    </td>
                                    <td class="text-center"><b><?php echo $result[$key]['full_name']; ?></b></td>
                                    <td class="text-center"><?php echo $result[$key]['user_name']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['mobile_number']; ?><br><?php echo $result[$key]['email']; ?></td>
                                    <td class="text-center"><?php echo $result[$key]['present_address']; ?></td>

                                    <td class="text-center"> <?php $branchName = getBranchDetailsFromId($result[$key]['branch_id']); echo $branchName['name'];?> </td>

                                    <td class="text-center"><?php $subBranchName = getSubBranchDetailsFromId($result[$key]['sub_branch_id']); echo $subBranchName['name'];?></td>

                                    <td class="text-center"><?php $userTypeName = getUserTypeFromId($result[$key]['user_type']); echo $userTypeName['user_type_name']; ?><br><?php  $employeeTypeName = getEmployeeTypeDetailsFromId($result[$key]['employee_type']); echo $employeeTypeName['employee_type_name']; ?></td>

                                    <td class="text-center"><?php $salaryTypeName = getSalaryTypeDetailsFromId($result[$key]['salary_type']); echo $salaryTypeName['salary_type_name'];?><br><?php echo $result[$key]['basic_salary']; ?>/-</td>

                                    <td class="text-center"><?php echo $result[$key]['joining_date'];?></td>

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

                                                    <a class="dropdown-item bg-default" href="#" onclick="promtEditUser('<?php echo $id; ?>', 
                                                                '<?php echo $result[$key]['full_name']; ?>', 
                                                                '<?php echo $result[$key]['user_name']; ?>', 
                                                                '<?php echo $result[$key]['branch_id']; ?>', 
                                                                '<?php echo $result[$key]['sub_branch_id']; ?>', 
                                                                '<?php echo $result[$key]['present_address']; ?>', 
                                                                '<?php echo $result[$key]['permanent_address']; ?>', 
                                                                '<?php echo $result[$key]['mobile_number']; ?>', 
                                                                '<?php echo $result[$key]['email']; ?>', 
                                                                '<?php echo $result[$key]['user_type']; ?>',
                                                                '<?php echo $result[$key]['employee_type']; ?>',
                                                                '<?php echo $result[$key]['salary_type']; ?>',
                                                                '<?php echo $result[$key]['basic_salary']; ?>',
                                                                '<?php echo $result[$key]['joining_date']; ?>',
                                                                '<?php echo $result[$key]['photo']; ?>')">Edit

                                                    </a>


                                                    <?php if ($result[$key]['status'] == 1) { ?>
                                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The User ?','user','<?php echo $id; ?>','2')">Deactivate</a>
                                                    <?php
                                                } else {
                                                ?>
                                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The User ?','user','<?php echo $id; ?>','1')">Activate</a>
                                                    <?php
                                                }
                                                ?>
                                                    <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The User ? Once Done, It Can Not Be Undone !','user','<?php echo $id; ?>','0')">Delete</a>

                                                    <a class="dropdown-item bg-info" href="user_details.php?user=<?php echo $id; ?>">Full Details</a>

                                                    <a class="dropdown-item bg-gradient-danger" href="#" onclick="statusToggler('Do You Want To Delete The User ? Once Done, It Can Not Be Undone !','sub_branch','<?php echo $id; ?>','0')">Change Password</a>
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
                                    <th>Photo</th>
                                    <th>Full Name</th>
                                    <th>User Name</th>
                                    <th>Mobile<br>Email</th>
                                    <th>Address(Present)</th>
                                    <th>Branch</th>
                                    <th>Sub Branch</th>
                                    <th>-User Type<br>-Employee Type</th>
                                    <th>-Salary Type<br>-Basic Salary</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

                <!--
                <div class="col-12 col-sm-12 col-md-12 -flex lign-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            Digital Strategist
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>Nicole Pearson</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="../../dist/img/user1-128x128.jpg" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
-->

            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- add Branch Modal -->
    <div class="modal fade" id="addUserModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" name="addUserFullName" id="addUserFullName" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="User Name" name="addUserUserName" id="addUserUserName" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Password</label>
                                <input type="password" class="form-control" placeholder="User Password" name="addUserPassword" id="addUserPassword" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password" name="addUserConfirmPassword" id="addUserConfirmPassword" required><br>
                            </div>
                        </div>

                        <?php $allBranch = getAllDataOfBranchTable(" AND status=1");?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Branch </label>
                                <select id="addUserBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Branch--</option>

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select A Sub Branch </label>
                                <select id="addUserSubBranchId" class="form-control">
                                    <option value="null" selected disabled>--Select A Sub Branch--</option>

                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Present Address</label>
                                <input type="text" class="form-control" placeholder="User Address" name="addUserPresentAddress" id="addUserPresentAddress" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Permanent Address</label>
                                <input type="text" class="form-control" placeholder="User Address" name="addUserPremanentAddress" id="addUserPremanentAddress" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Mobile Number</label>
                                <input type="text" class="form-control" placeholder="User Mobile Number" name="addUserMobile" id="addUserMobile" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Email</label>
                                <input type="email" class="form-control" placeholder="User Email" name="addUserEmail" id="addUserEmail" required><br>
                            </div>
                        </div>

                        <?php $allUserType = getAllDataOfUserTypeTable("");?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select User Type </label>
                                <select id="addUserType" class="form-control">
                                    <option value="null" selected disabled>--Select A User Type--</option>

                                    <?php foreach($allUserType as $userTypeKey=>$userTypeData){?>

                                    <option value="<?php echo intval($allUserType[$userTypeKey]['id']);?>"><?php echo $allUserType[$userTypeKey]['user_type_name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <?php $allEmployeeType = getAllDataOfEmployeeTypeTable("");?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Employee Type </label>
                                <select id="addUserEmployeeType" class="form-control">
                                    <option value="null" selected disabled>--Select Employee Type--</option>

                                    <?php foreach($allEmployeeType as $employeeTypeKey=>$employeeTypeData){?>

                                    <option value="<?php echo intval($allEmployeeType[$employeeTypeKey]['id']);?>"><?php echo $allEmployeeType[$employeeTypeKey]['employee_type_name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <?php $allSalaryType = getAllDataOfSalaryTypeTable("");?>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Salary Type </label>
                                <select id="addUserSalaryType" class="form-control">
                                    <option value="null" selected disabled>--Select Salary Type--</option>

                                    <?php foreach($allSalaryType as $salaryTypeKey=>$salaryTypeData){?>

                                    <option value="<?php echo intval($allSalaryType[$salaryTypeKey]['id']);?>"><?php echo $allSalaryType[$salaryTypeKey]['salary_type_name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Basic Salary</label>
                                <input type="text" class="form-control" placeholder="User Basic Salary" name="addUserBasicSalary" id="addUserBasicSalary" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Add Joining Date</label>
                                <input type="text" class="form-control" placeholder="Select Date & Time" id="addUserJoiningDate"><br>

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Adjust User Logo</label>
                                <div class="input-group">
                                    <div class="custom-file" style="padding-bottom: 330px;">
                                        <div id="addUserImage"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Choose a Logo For User</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="addUserImage" id="addUserImageButton">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addSubBranchSaveButton" onclick="saveUser()">Save</button>
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
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editUserId" value="0">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Full Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" name="editUserFullName" id="editUserFullName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder="User Name" name="editUserUserName" id="editUserUserName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Branch </label>

                                <?php $allBranch = getAllDataOfBranchTable(" AND status=1");?>

                                <select id="editUserBranchId" class="form-control">

                                    <?php foreach($allBranch as $branchData=>$branchDetails){?>

                                    <option value="<?php echo intval($allBranch[$branchData]['id']);?>"><?php echo $allBranch[$branchData]['name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Sub Branch </label>

                                <?php $allBranch = getAllDataOfBranchTable(" AND status=1");?>

                                <select id="editUserSubBranchId" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Present Address</label>
                                <input type="text" class="form-control" placeholder="User Address" name="editUserPresentAddress" id="editUserPresentAddress" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Permanent Address</label>
                                <input type="text" class="form-control" placeholder="User Area" name="editUserPermanentAddress" id="editUserPermanentAddress" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Mobile</label>
                                <input type="text" class="form-control" placeholder="User Mobile" name="editUserMobile" id="editUserMobile" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Email</label>
                                <input type="email" class="form-control" placeholder="User Email" name="editUserEmail" id="editUserEmail" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Type </label>

                                <?php $allUserType = getAllDataOfUserTypeTable("");?>

                                <select id="editUserType" class="form-control">

                                    <?php foreach($allUserType as $userTypeKey=>$userTypeData){?>

                                    <option value="<?php echo intval($allUserType[$userTypeKey]['id']);?>"><?php echo $allUserType[$userTypeKey]['user_type_name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit Employee Type </label>

                                <?php $allEmployeeType = getAllDataOfEmployeeTypeTable("");?>

                                <select id="editUserEmployeeType" class="form-control">

                                    <?php foreach($allEmployeeType as $employeeTypeKey=>$employeeTypeData){?>

                                    <option value="<?php echo intval($allEmployeeType[$employeeTypeKey]['id']);?>"><?php echo $allEmployeeType[$employeeTypeKey]['employee_type_name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Salary Type </label>

                                <?php $userSalaryType = getAllDataOfSalaryTypeTable("");?>

                                <select id="editUserSalaryType" class="form-control">

                                    <?php foreach($userSalaryType as $userSalaryTypeKey=>$userSalaryData){?>

                                    <option value="<?php echo intval($userSalaryType[$userSalaryTypeKey]['id']);?>"><?php echo $userSalaryType[$userSalaryTypeKey]['salary_type_name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Basic Salary</label>
                                <input type="email" class="form-control" placeholder="User Email" name="editUserBasicSalary" id="editUserBasicSalary" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Edit User Joining Date</label>
                                <input type="text" class="form-control" value="" placeholder="Select Date & Time" id="editUserJoiningDate"><br>

                            </div>
                        </div>

                        <div class="col-md-4" id="editUserCurrentImageDiv">
                            <div class="form-group text-center">
                                <label>User Current Image</label>
                                <div class="input-group">
                                    <div style="margin:auto;">
                                        <img src="" height="200px" width="200px" id="editUserCurrentImage">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" id="editUserImageDiv">
                            <div class="form-group">
                                <label>Adjust Image Size</label>
                                <div class="input-group">
                                    <div class="custom-file" style="padding-bottom: 330px;">
                                        <div id="editUserImage"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Change User Logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="editUserImageButton" id="editUserImageButton">
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
                    <button type="button" class="btn btn-primary" id="editUserSaveButton" onclick="saveEditUser()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Branch Modal -->

    <!-- change password Modal -->
    <div class="modal fade" id="changeUserPasswordModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">User Password Change</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" placeholder="User Password" name="changeUserPassword" id="changeUserPassword" required><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password" name="changeUserConfirmPassword" id="changeUserConfirmPassword" required><br>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="ChangeUserPassword()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- change password Modal -->


    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#userTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });

            $('#addUserJoiningDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd HH:mm:ss'
            });

            $('#editUserJoiningDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd HH:mm:ss'
            });



        });

        $('#addUserBranchId').change(function() {
            $('.loader-holder').show();

            var selectedBranchId = $('#addUserBranchId option:selected').val();

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

                        $('#addUserSubBranchId').html(response);
                        $('.loader-holder').hide();



                    });
            }



        });

        $('#editUserBranchId').change(function() {
            $('.loader-holder').show();

            var selectedBranchId = $('#editUserBranchId option:selected').val();

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

                        $('#editUserSubBranchId').html(response);
                        $('.loader-holder').hide();



                    });
            }



        });

        $('#editUserImageDiv').hide();

        $addUserImage = $('#addUserImage').croppie({
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


        $('#addUserImageButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $addUserImage.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);
        });



        $editUserImage = $('#editUserImage').croppie({
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


        $('#editUserImageButton').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $editUserImage.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('Picture Binding Complete !');
                });

            }
            reader.readAsDataURL(this.files[0]);

            $('#editUserCurrentImageDiv').hide();
            $('#editUserImageDiv').show();
        });





        function saveUser() {

            var fullName = $("#addUserFullName").val();
            var userName = $("#addUserUserName").val();
            var branchId = $("#addUserBranchId option:selected").val();
            var subBranchId = $("#addUserSubBranchId option:selected").val();
            var presentAddress = $("#addUserPresentAddress").val();
            var permanentAddress = $("#addUserPremanentAddress").val();
            var mobile = $("#addUserMobile").val();
            var email = $("#addUserEmail").val();
            var userType = $("#addUserType option:selected").val();
            var employeeType = $("#addUserEmployeeType option:selected").val();
            var salaryType = $("#addUserSalaryType option:selected").val();
            var basicSalary = $("#addUserBasicSalary").val();
            var joiningDate = $("#addUserJoiningDate").val();
            var password = $("#addUserPassword").val();
            var confirmPassword = $("#addUserConfirmPassword").val();





            if (branchId == 'null') {
                swal("Please Select a Branch for the User", "", "warning");
                return false;
            }

            if (password != confirmPassword) {
                swal("Passwords don't Match", "", "error");
                return false;
            }

            var intRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
            if (!mobile.match(intRegex)) {
                swal('Enter a Valid Mobile Number', '', 'warning');
                return false;
            }



            if (fullName != "" && userName != "" && branchId != "" && subBranchId != "" && presentAddress != "" && permanentAddress != "" && mobile != "" && email != "" && email != "" && userType != "" && employeeType != "" && salaryType != "" && basicSalary != "" && joiningDate != "") {

                if (password.length < 6) {
                    swal("Minimum Password 6 Characters", "", "error");
                    return false;
                }

                $addUserImage.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {

                    $('.loader-holder').show();
                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveUser",
                                photo: resp,
                                fullName: fullName,
                                userName: userName,
                                password: password,
                                branchId: branchId,
                                subBranchId: subBranchId,
                                presentAddress: presentAddress,
                                permanentAddress: permanentAddress,
                                mobileNumber: mobile,
                                email: email,
                                userType: userType,
                                employeeType: employeeType,
                                salaryType: salaryType,
                                basicSalary: basicSalary,
                                joiningDate: joiningDate,
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
                swal("Please Fill All the Infomation for the User", "", "error");
                return false;
            }
        }

        function promtEditUser(id, fullName, userName, userBranchId, userSubBranchId, presentAddress, permanentAddress, mobile, email, userType, employeeType, salaryType, basicSalary, joiningDate, imageName) {
            $('.loader-holder').show();

            $('#editUserCurrentImageDiv').show();
            $('#editUserImageDiv').hide();

            $("#editUserCurrentImage").attr("src", "images/" + imageName);
            $("#editUserId").val(id);

            $("#editUserFullName").val(fullName);
            $("#editUserUserName").val(userName);
            $("#editUserBranchId").val(userBranchId);
            $("#editUserSubBranchId").val(userSubBranchId);
            $("#editUserPresentAddress").val(presentAddress);
            $("#editUserPermanentAddress").val(permanentAddress);
            $("#editUserMobile").val(mobile);
            $("#editUserEmail").val(email);
            $("#editUserType").val(userType);
            $("#editUserEmployeeType").val(employeeType);
            $("#editUserSalaryType").val(salaryType);
            $("#editUserBasicSalary").val(basicSalary);
            $("#editUserJoiningDate").val(joiningDate);




            var selectedBranchId = $('#editUserBranchId option:selected').val();

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
                        $('#editUserSubBranchId').html(response);
                        $('.loader-holder').hide();



                    });
            }

            $('#editSubBranchModal').modal('show');
            $('.loader-holder').hide();
        }

        function promtCHangeUserPassword(id, fullName) {
            $('.loader-holder').show();

            $("#editUserFullName").val(fullName);





            var selectedBranchId = $('#editUserBranchId option:selected').val();

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
                        $('#editUserSubBranchId').html(response);
                        $('.loader-holder').hide();



                    });
            }

            $('#editSubBranchModal').modal('show');
            $('.loader-holder').hide();
        }



        function saveEditUser() {
            $('.loader-holder').show();


            var id = $("#editUserId").val();

            var fullName = $("#editUserFullName").val();
            var userName = $("#editUserUserName").val();
            var branchId = $("#editUserBranchId option:selected").val();
            var subBranchId = $("#editUserSubBranchId option:selected").val();
            var presentAddress = $("#editUserPresentAddress").val();
            var permanentAddress = $("#editUserPermanentAddress").val();
            var mobile = $("#editUserMobile").val();
            var email = $("#editUserEmail").val();
            var userType = $("#editUserType option:selected").val();
            var employeeType = $("#editUserEmployeeType option:selected").val();
            var salaryType = $("#editUserSalaryType option:selected").val();
            var basicSalary = $("#editUserBasicSalary").val();
            var joiningDate = $("#editUserJoiningDate").val();

            var currentImageName = $('#editUserCurrentImage').attr('src').slice(7);
            var imageChanged = $('#editUserImageButton').get(0).files.length;

            var intRegex = /(^(\+8801|8801|01|008801))[1|3-9]{1}(\d){8}$/;
            if (!mobile.match(intRegex)) {
                swal('Enter a Valid Mobile Number', '', 'warning');
                $('.loader-holder').hide();

                return false;
            }


            if (fullName != "" && userName != "" && branchId != "" && subBranchId != "" && presentAddress != "" && permanentAddress != "" && mobile != "" && email != "" && userType != "" && employeeType != "" && salaryType != "" && basicSalary != "" && joiningDate != "") {

                $editUserImage.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(resp) {

                    $.ajax({
                            method: "post",
                            url: 'ajaxfunctions.php',
                            data: {
                                funName: "saveEditUser",

                                photo: resp,
                                fullName: fullName,
                                userName: userName,
                                branchId: branchId,
                                subBranchId: subBranchId,
                                presentAddress: presentAddress,
                                permanentAddress: permanentAddress,
                                mobileNumber: mobile,
                                email: email,
                                userType: userType,
                                employeeType: employeeType,
                                salaryType: salaryType,
                                basicSalary: basicSalary,
                                joiningDate: joiningDate,
                                photoName: currentImageName,


                                id: id,
                                photoChanged: imageChanged
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
                swal("Please Fill All the Infomation for the User", "", "error");
                return false;
            }
        }

    </script>


    </body>

    </html>
