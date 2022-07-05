<?php
require 'includes/header.php';
if ($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4 || $_SESSION['user_type'] == 2) {
} else {
    echo "<script>window.location.href = 'requisition_list.php';</script>";
}
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
                        <h1 class="m-0 text-dark">Requisition Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Requisition Management</a></li>
                            <li class="breadcrumb-item active">Requisition Add</li>
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
                        <h3 class="card-title">Place A Requisition</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="rowHolder">
                        </div>
                        <div class="">
                            <button class="btn btn-success" onclick="addRow()">Add Row</button>
                        </div>
                        <br><br>
                        <div class="col-md-12" style="margin:auto;">
                            <label>Remarks</label>
                            <br>
                            <textarea class="form-control" rows="4" cols="auto" id="remarks"></textarea>
                            <br>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8" style="margin:auto;">
                <button class="btn btn-primary btn-block" onclick="addRequisition()">Add Requisition</button>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php require 'includes/footer.php'; ?>
    <script>
        $(function() {
            $("#branchTable").DataTable({
                "scrollX": true,
                "autoWidth": false
            });
        });

        function addRow() {
            $('.loader-holder').show();
            if ($('.classForRowAdding').length >= 1) {
                var a = ($(".classForRowAdding").get($('.classForRowAdding').length - 1).id).slice(1);
                var newId = parseInt(a) + 1;
            } else {
                var newId = 1;
            }
            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "getAllIngredientDetailsAsHtmlOptions",
                        newId: newId
                    }
                })
                .done(function(response) {
                    //console.log(response);
                    $('.loader-holder').hide();
                    if (response != "") {
                        $('.rowHolder').append(response);
                        $('.ingCount').select2({
                            theme: 'bootstrap4'
                        });
                    } else {
                        swal("Request Can't Be Processed !", {
                            icon: "error",
                        });
                    }
                });
        }

        function deleteRow(id) {
            if ($('.ingCount').length > 1) {
                $('#' + id).remove();
            } else {
                swal("That Is The Last Row !", {
                    icon: "error",
                });
            }
        }

        function getDuplicateArrayElements(arr) {
            var sorted_arr = arr.slice().sort();
            var results = [];
            for (var i = 0; i < sorted_arr.length - 1; i++) {
                if (sorted_arr[i + 1] === sorted_arr[i]) {
                    results.push(sorted_arr[i]);
                }
            }
            return results;
        }

        function addRequisition() {
            var ingredientId = $('select[name="ingredientName[]"]').map(function() {
                return this.value;
            }).get();

            var duplicateIngredients = getDuplicateArrayElements(ingredientId);
            if (duplicateIngredients.length > 0) {
                swal("Same Ingredients Can't be Added Twice ", "", "warning");
                return false;
            }

            var remarks = $('#remarks').val();

            var amount = $('input[name="ingredientAmount[]"]').map(function() {
                return this.value;
            }).get();

            if (jQuery.inArray('0', amount) >= 0) {
                swal("Ingredient Amount Can't be Zero ", "", "warning");
                return false;
            }
            if (jQuery.inArray('', amount) >= 0) {
                swal("Ingredient Amount Can't be Empty ", "", "warning");
                return false;
            }
            if (jQuery.inArray('null', amount) >= 0) {
                swal("Ingredient Amount Can't be Nothing! ", "", "warning");
                return false;
            }

            if (jQuery.inArray('', ingredientId) >= 0) {
                swal("PLease Select an Ingredient", "", "warning");
                return false;
            }
            if (jQuery.inArray('null', ingredientId) >= 0) {
                swal("PLease Select an Ingredient", "", "warning");
                return false;
            }

            $('.loader-holder').show();

            $.ajax({
                    method: "post",
                    url: 'ajaxfunctions.php',
                    data: {
                        funName: "saveRequisition",

                        ingredientId: ingredientId,
                        ingredientAmount: amount,
                        remarks: remarks
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