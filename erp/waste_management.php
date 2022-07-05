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
                        <h1 class="m-0 text-dark">Wastage Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Property Management</a></li>
                            <li class="breadcrumb-item active">Wastage Management</li>
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
                        <h3 class="card-title">Stock Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="requisitionTable" class="table table-bordered table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Ingredient Name</th>
                                    <th>Current Stock</th>
                                    <th>Waste Amount</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $result = getAllDataOfStockTable("");
                                $i = 1;
                                foreach ($result as $key => $value) {

                                    $id = $result[$key]['id']; 
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center">
                                            <?php 

                                            $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);?>
                                            <input type="hidden" value="<?php echo $ingredientDetails['id'];?>" name="ingredientId[]">
                                            <b><?php echo $ingredientDetails['ingredient_name']; ?></b>
                                        </td>
                                        <td class="text-center">
                                            <input type="hidden" value="<?php echo $result[$key]['ingredient_amount']; ?>" name="stockAmount[]">
                                            <?php echo $result[$key]['ingredient_amount']; 
                                            echo " ".getDefaultWeightInNameFromIngredientId($ingredientDetails['id']); ?></td>
                                        
                                        <td class="text-center">
                                            <input type="hidden" value="<?php echo $id;?>" name="stockId[]">
                                            <input class="form-control" placeholder="Enter Amount" type="number" min="0" value="0" name="amount[]">
                                        </td>

                                        <td class="text-center">
                                            <input class="form-control" placeholder="Enter Reason" value="" type="text" name="reason[]">
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
                                    <th>Ingredient Name</th>
                                    <th>Current Stock</th>
                                    <th>Waste Amount</th>
                                    <th>Reason</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- /.card-body -->
                </div>
                <button class="btn btn-block btn-primary btn-lg mt-5 col-md-10" onclick="submitWastageReport();" style="margin: auto;">Submit</button>
            </div>
            <!--/. container-fluid -->
        </section>

        
    <!-- /.content-wrapper -->

  




    <?php require 'includes/footer.php'; ?>

    <script>

       
       function submitWastageReport(){
        $('.loader-holder').show();
        

        var stockId = $('input[name="stockId[]"]').map(function() {
                return this.value;
            }).get();

        var ingredientId = $('input[name="ingredientId[]"]').map(function() {
                return this.value;
            }).get();

        var stockAmount = $('input[name="stockAmount[]"]').map(function() {
                return this.value;
            }).get();

        var amount = $('input[name="amount[]"]').map(function() {
                return this.value;
            }).get();

        var reason = $('input[name="reason[]"]').map(function() {
                return this.value;
            }).get();

        var i = 0;
        var amountFlag = 0;

        $("input[name='stockAmount[]']").each(function() {
            // console.log(parseFloat(stockAmount[i])+", "+ parseFloat(amount[i]) );
               if(parseFloat(stockAmount[i]) < parseFloat(amount[i]) ){
                swal("Wastage Amount Cannot Be Higher than Current Stock Amount","","warning");
                $('.loader-holder').hide();
                throw new Error("Done");
               }

               if(parseFloat(amount[i]) > 0 && (reason[i] == "" || reason[i] == null)){
                swal("Must Enter a Reason for Wastage","","warning");
                $('.loader-holder').hide();
                throw new Error("Done");
               }

               if(parseFloat(amount[i])==0){
                amountFlag++;
               }

            i++;
        });

        if(amountFlag == amount.length){
             swal("Wastage Amount Empty!","","warning");
                $('.loader-holder').hide();
                return false;
        }

             $.ajax({
                        method: "post",
                        url: 'ajaxfunctions.php',
                        data: {
                            funName: "saveWastage",
                            
                            stockIds: stockId,
                            ingredientIds: ingredientId,
                            stockWastageAmount: amount,
                            reason: reason
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
                                }, 1500);

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