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
                        <h1 class="m-0 text-dark">Expense Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Expense Management</a></li>
                            <li class="breadcrumb-item active">Expense Type Management</li>
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
                        <h3 class="card-title">Expense Type List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addExpenseType">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="expenseTypeTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfExpenseNameTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id'];
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><b><?php echo $result[$key]['name']; ?></b></td>
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

                                                        <a class="dropdown-item bg-default" href="#" onclick="promtEditExpenseType('<?php echo $id; ?>', '<?php echo $result[$key]['name']; ?>')">Edit</a>


                                                        <?php if ($result[$key]['status'] == 1) { ?>
                                                            <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate ?','expense_name','<?php echo $id; ?>','2')">Deactivate</a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate ?','expense_name','<?php echo $id; ?>','1')">Activate</a>
                                                        <?php
                                                        }
                                                        ?>
                                                        <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete ? Once Done, It Can Not Be Undone !','expense_name','<?php echo $id; ?>','0')">Delete</a>
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



    <!-- add Expense Type Modal -->
    <div class="modal fade" id="addExpenseType">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Expense Type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Expense Type Name" name="addExpenseTypeName" id="addExpenseTypeName" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addExpenseTypeSaveButton" onclick="saveExpenseType()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Expense Type Modal -->


    <!-- add ExpenseType Modal -->
    <div class="modal fade" id="editExpenseTypeModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit ExpenseType</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="editExpenseTypeId" value="0">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>ExpenseType Name</label>
                                <input type="text" class="form-control" placeholder="ExpenseType Name" name="editExpenseTypeName" id="editExpenseTypeName" required><br>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editExpenseTypeSaveButton" onclick="saveEditExpenseType()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add ExpenseType Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            $("#expenseTypeTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });

        });







        function saveExpenseType() {

            $('.loader-holder').show();

            var expenseTypeName = $("#addExpenseTypeName").val();
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "saveExpenseType",
                        expenseTypeName: expenseTypeName
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

        function promtEditExpenseType(id, name) {
            $('.loader-holder').show();

            $("#editExpenseTypeId").val(id);
            $("#editExpenseTypeName").val(name);

            $('#editExpenseTypeModal').modal('show');
            $('.loader-holder').hide();
        }

        function saveEditExpenseType() {
            $('.loader-holder').show();


            var id = $("#editExpenseTypeId").val();
            var name = $("#editExpenseTypeName").val();

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "saveEditExpenseType",
                        expenseTypeId: id,
                        expenseTypeName: name
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
    </script>


    </body>

    </html>