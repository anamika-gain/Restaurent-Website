<?php require 'includes/header.php'; 

    if(!isset($_REQUEST['userId'])){
                echo "<script>window.location.href='guard_requisition_list.php';</script>";
            }
            if(empty($_REQUEST['userId'])){
                    echo "<script>window.location.href='guard_requisition_list.php';</script>";

            }
        $uniqueId = $_REQUEST['userId'];
        $count = mysqli_num_rows($con->query("select * from requisition_process where unique_requisition_id = '$uniqueId' AND status = '3'"));

        if($count<1){
                echo "<script>window.location.href='guard_requisition_list.php';</script>";
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
                        <h1 class="m-0 text-dark">Guard Requisition Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Guard Requisition Management</li>
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
                        <h3 class="card-title">Requisition Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="requisitionTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Image</th>
                                    <th>Ingredient Name</th>
                                    <th>Default Weight In</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfRequisitionItemTableFromRequisitionUniqueId($uniqueId);
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id']; 
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center">
                                            <?php 

                                            $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);?>
                                            <img height="200px" width="auto" src="<?php echo 'images/'.$ingredientDetails['image'];?>">
                                            

                                         </td>

                                        <td class="text-center"><b><?php echo $ingredientDetails['ingredient_name']; ?></b></td>
                                        <td class="text-center"><?php echo getDefaultWeightInNameFromIngredientId($ingredientDetails['id']); ?></td>
                                        
                                        <td class="text-center">
                                            <input type="hidden" value="<?php echo $id;?>" name="itemId[]">
                                            <input class="form-control" placeholder="Enter Amount" type="number" name="amount[]">
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
                                    <th>Ingredient Name</th>
                                    <th>Default Weight In</th>
                                    <th>Amount</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>
                <button class="btn btn-block btn-primary btn-lg mt-5 col-md-10" onclick="submitGuardRequisition();" style="margin: auto;">Submit (জমা দিন)</button>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  




    <?php require 'includes/footer.php'; ?>

    <script>
       
       function submitGuardRequisition(){
        $('.loader-holder').show();
        

        var itemId = $('input[name="itemId[]"]').map(function() {
                return this.value;
            }).get();

        var amount = $('input[name="amount[]"]').map(function() {
                return this.value;
            }).get();

        if(jQuery.inArray('0', amount)>=0){
                swal("Ingredient Amount Can't be Zero ", "", "warning");
                $('.loader-holder').hide();
                return false;
        }
        if(jQuery.inArray('', amount)>=0){
            swal("Ingredient Amount Can't be Empty ", "", "warning");
            $('.loader-holder').hide();
            return false;
        }
        if(jQuery.inArray('null', amount)>=0){
            swal("Ingredient Amount Can't be Nothing! ", "", "warning");
            $('.loader-holder').hide();
            return false;
        }

        if(itemId != "" && amount!=""){


             $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveGuardRequisition",
                            
                            requisitionUniqueId: "<?php echo $uniqueId;?>",
                            requisitionItemsTableId: itemId,
                            guardRecivedAmount: amount
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
                                    window.location.href="guard_requisition_list.php";
                                }, 1500);

                        } else {
                            swal("Request Can't Be Processed !", {
                                icon: "error",
                            });
                        }
                    });

        }else{
            swal("Please Enter Everything","","warning");
            $('.loader-holder').hide();
            return false;
        }

       }


        
    </script>


    </body>

    </html>