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
                            <li class="breadcrumb-item active">Expese Details</li>
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
                        <h3 class="card-title">Expense List</h3>
                        <span class="float-right"><button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addExpenseDetails">Add</button></span>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row text-center  d-flex justify-content-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select a Branch </label>
                                    <select id="subBranchId" class="form-control select2">
                                        <option value="0" selected>--All Sub Branch--</option>
                                        <?php
                                        $allSubBranchDetails = getAllDataOfSubBranchTable(" order by name");

                                        foreach ($allSubBranchDetails as $key => $value) {


                                            $subBranchDetails = getSubBranchDetailsFromId($allSubBranchDetails[$key]['id']);
                                        ?>
                                            <option value="<?php echo $subBranchDetails['id']; ?>">
                                                <?php echo $subBranchDetails['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="text" class="form-control" placeholder="Select From Date for Report" id="fromDate"><br>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="text" class="form-control" placeholder="Select From Till for Report" id="toDate"><br>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">

                                    <button class="btn btn-primary mx-auto d-block" onclick="generateExpenseReport()">View</button>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <table id="expenseTypeTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Branch Name</th>
                                    <th>Expense Type</th>
                                    <th>Expense Date</th>
                                    <th>Expense Amount</th>
                                    <th>Expense Remarks</th>
                                    <th>Edit Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subBranchId = 0; //means all
                                $fromDate = date("Y-m-d");
                                $toDate = date("Y-m-d");
                                $totalAmount = 0;
                                if ($subBranchId == 0) {
                                    $subBranchQuery = "";
                                } else {
                                    $subBranchQuery = " AND sub_branch_id = " . $subBranchId;
                                }


                                $result = getAllDataOfExpenseDetailsTable($subBranchQuery . " AND expense_time BETWEEN '$fromDate' AND '$toDate'");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $expenseTypeDetails = getExpenseNameTableDetailsFromId($result[$key]['expense_name_id']);
                                    $subBranchDetails = getSubBranchDetailsFromId($result[$key]['sub_branch_id']);
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $subBranchDetails['name']; ?></td>
                                        <td class="text-center">
                                            <b>
                                                <?php echo $expenseTypeDetails['name']; ?>
                                            </b>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            $time = strtotime($result[$key]['expense_time']);
                                            $newformat = date('d-m-Y', $time);
                                            echo $newformat;
                                            ?>
                                        </td>
                                        <td class="text-center"><?php $totalAmount = $totalAmount + $result[$key]['amount']; echo $result[$key]['amount']; ?></td>
                                        <td class="text-center"><?php echo $result[$key]['remarks']; ?></td>

                                        <td class="text-center">
                                            <?php
                                            echo "sliated" . strtolower(numberTowords($result[$key]['id'])) . "esnepxe";
                                            ?>
                                        </td>
                                    </tr>

                                    <tr class="bg-info text-center">
                                        <td colspan="4">Total Amount</td>
                                        <td colspan="3"><?php echo $totalAmount; ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Branch Name</th>
                                    <th>Expense Type</th>
                                    <th>Expense Date</th>
                                    <th>Expense Amount</th>
                                    <th>Expense Remarks</th>
                                    <th>Edit Code</th>
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
    <div class="modal fade" id="addExpenseDetails">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Expense</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <select id="addExpenseSubBranch" class="form-control select2">
                                    <?php
                                    $allSubBranchDetails = getAllDataOfSubBranchTable(" order by name");

                                    foreach ($allSubBranchDetails as $key => $value) {


                                        $subBranchDetails = getSubBranchDetailsFromId($allSubBranchDetails[$key]['id']);
                                    ?>
                                        <option value="<?php echo $subBranchDetails['id']; ?>">
                                            <?php echo $subBranchDetails['name']; ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Expense Details</label>
                                <input type="text" class="form-control" placeholder="Expense Details" name="addExpenseRemarks" id="addExpenseRemarks" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expense Type Name</label>
                                <select id="addExpenseExpenseType" class="form-control select2">
                                    <?php
                                    $allExpenseTypeDetails = getAllDataOfExpenseNameTable(" order by name");

                                    foreach ($allExpenseTypeDetails as $key => $value) {

                                    ?>
                                        <option value="<?php echo $allExpenseTypeDetails[$key]['id']; ?>">
                                            <?php echo $allExpenseTypeDetails[$key]['name']; ?>
                                        </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expense Date</label>
                                <input type="text" class="form-control" placeholder="Select From Date of Expense" id="addExpenseDate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Expense Amount</label>
                                <input type="number" class="form-control" placeholder="Select From Date for Sales Report" id="addExpenseAmount">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addExpenseDetailsSaveButton" onclick="saveExpenseDetails()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Expense Type Modal -->


    <!-- edit ExpenseType Modal -->
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
    <!-- edit ExpenseType Modal -->




    <?php require 'includes/footer.php'; ?>

    <script>
        $(function() {

            // $("#expenseTypeTable").DataTable({
            //     "scrollX": true,
            //     "autoWidth": false
            // });

            $('#addExpenseDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd'
            });

            $('#fromDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd'
            });

            $('#toDate').dateTimePicker({
                mode: 'dateTime',
                format: 'yyyy-MM-dd'
            });

        });


        function saveExpenseDetails() {

            $('.loader-holder').show();

            var addExpenseSubBranch = $("#addExpenseSubBranch").val();
            var addExpenseRemarks = $("#addExpenseRemarks").val();
            var addExpenseExpenseType = $("#addExpenseExpenseType").val();
            var addExpenseDate = $("#addExpenseDate").val();
            var addExpenseAmount = $("#addExpenseAmount").val();


            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "saveExpenseDetails",
                        addExpenseSubBranch: addExpenseSubBranch,
                        addExpenseRemarks: addExpenseRemarks,
                        addExpenseExpenseType: addExpenseExpenseType,
                        addExpenseDate: addExpenseDate,
                        addExpenseAmount: addExpenseAmount
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


        function generateExpenseReport() {
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var subBranchId = $('#subBranchId option:selected').val();
            var date = (Date.parse(toDate) - Date.parse(fromDate)) / 86400000;
            if (date < 0) {

                swal("Please Check the date", "From Date Cannot be Smaller Than Till Date", "warning");
                return false;
            }

            if (fromDate != "" && toDate != "") {

                $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "expenseReport",
                            subBranchId: subBranchId,
                            fromDate: fromDate,
                            toDate: toDate
                        }
                    })
                    .done(function(response) {
                        if (response != "") {

                            $('#expenseTypeTable').html(response);

                            $('.loader-holder').hide();

                        } else {

                            swal("Issue with the Network, Please Solve It !", "warning");

                        }

                    });


            } else {
                swal("Date Not Selected Perfectly !", "error");
                return false;
            }
        }
    </script>


    </body>

    </html>