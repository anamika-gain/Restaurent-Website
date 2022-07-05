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
                        <h1 class="m-0 text-dark"><?php echo $_SESSION["user_sub_branch_name"]; ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><?php echo $_SESSION["user_sub_branch_name"]; ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <?php
        //count function
        // $time_start = microtime(true);
        // $all_time_start = microtime(true);

        $viewCountDetails = getViewCountDetails();

        $viewProductCountDetails = getViewCountDetails(" where identifer_name != ('home' or 'menu' or 'checkout' or 'events')");

        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done fetching Viewcount from db in " . $time . " seconds";
        // $time_start = microtime(true);



        // print_r($viewProductCountDetails);
        $homeViewCount = 0;
        $menuViewCount = 0;
        $checkoutViewCount = 0;
        $mostViewedProduct = 0;
        $mostViewedProductName = "";

        $salesUptopCurrentDay = json_decode(getSalesDataFromMonthCount(1));
        $averageDailySales = round(floatval($salesUptopCurrentDay[0]) / intval(date('j')), 2);
        $complementaryItems = getComplementaryItemsPerDay(date("Y-m-d", strtotime("-7 days")), date("Y-m-d"));
        $discountItems = getDiscountItemsPerDay(date("Y-m-d", strtotime("-7 days")), date("Y-m-d"));
        $discountAmount = getDiscountItemsPerDay(date("Y-m-d"), date("Y-m-d"));

        $salesDataLast14Days = json_decode(getSalesDataFromDaysCount(13));

        $salesDataLast14Days = array_reverse($salesDataLast14Days);


        $complementaryItemsDate = array();
        $complementaryItemsAmount = array();
        $complementaryItemsNumber = array();

        $discountItemsDate = array();
        $discountItemsAmount = array();
        $discountItemsNumber = array();


        $last7DaysSalesData = array();
        $last7to14DaysSalesData = array();
        $j = count($salesDataLast14Days) / 2;

        $thisWeekTotalSale = 0;
        $lastWeekTotalSale = 0;
        $comparativePercentage = 0;

        for ($i = 0; $i < count($salesDataLast14Days) / 2; $i++) {
            array_push($last7DaysSalesData, $salesDataLast14Days[$i]);
            $thisWeekTotalSale += floatval($salesDataLast14Days[$i]);
            array_push($last7to14DaysSalesData, $salesDataLast14Days[$j + $i]);
            $lastWeekTotalSale += floatval($salesDataLast14Days[$j + $i]);
        }

        if ($lastWeekTotalSale > $thisWeekTotalSale) {
            $comparativePercentage = round(100 - (($thisWeekTotalSale / $lastWeekTotalSale) * 100), 2);
        } else {
            $comparativePercentage = round(100 - (($lastWeekTotalSale / $thisWeekTotalSale) * 100), 2);
        }



        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done fetching avergare sales,complementary,discount items from db in " . $time . " seconds";
        // $time_start = microtime(true);



        foreach ($complementaryItems as $complementaryItemKey => $value) {
            array_push($complementaryItemsDate, $complementaryItems[$complementaryItemKey]['date']);
            array_push($complementaryItemsAmount, $complementaryItems[$complementaryItemKey]['total_amount']);
            array_push($complementaryItemsNumber, $complementaryItems[$complementaryItemKey]['total_orders']);
        }

        foreach ($discountItems as $discountItemsKey => $value) {
            array_push($discountItemsDate, $discountItems[$discountItemsKey]['date']);
            array_push($discountItemsAmount, $discountItems[$discountItemsKey]['total_amount']);
            array_push($discountItemsNumber, $discountItems[$discountItemsKey]['total_orders']);
        }

        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done pushing arrays from db in " . $time . " seconds";
        // $time_start = microtime(true);


        // $discountAmount = intval(end($complementaryItemsAmount));
        // print_r($discountAmount);

        $extraPackaging = 0;
        $approximateSales = 0;

        foreach ($viewCountDetails as $vcdKey => $value) {
            if ($viewCountDetails[$vcdKey]['identifer_name'] == "home") {
                $homeViewCount = $viewCountDetails[$vcdKey]['views'];
            } elseif ($viewCountDetails[$vcdKey]['identifer_name'] == "menu") {
                $menuViewCount = $viewCountDetails[$vcdKey]['views'];
            } elseif ($viewCountDetails[$vcdKey]['identifer_name'] == "checkout") {
                $checkoutViewCount = $viewCountDetails[$vcdKey]['views'];
            } elseif ($viewCountDetails[$vcdKey]['identifer_name'] == "events") {
                $checkoutViewCount = $viewCountDetails[$vcdKey]['views'];
            } else {
                if ($mostViewedProduct < $viewCountDetails[$vcdKey]['views']) {
                    $mostViewedProductDetails = getProductDetailsFromId($viewCountDetails[$vcdKey]['identifer_name']);
                    $mostViewedProductName = $mostViewedProductDetails['name'];
                    $mostViewedProduct = $viewCountDetails[$vcdKey]['views'];
                }
            }
        }


        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done calculating viewcount arrays from db in " . $time . " seconds";
        // $time_start = microtime(true);



        $totalOrderCount = count(getAllDataOFOrderProcessTable(" AND status < 7"));

        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done calculating ORDERCOUNT from db in " . $time . " seconds";
        // $time_start = microtime(true);


        $i = 0;
        $productNameArray = [];
        $productViewCountArray = [];
        $totalProductViewCount = count($viewProductCountDetails);

        while ($i < 6) {
            // if($totalProductViewCount<6 && $i<$totalProductViewCount){


            $productDetails = getProductDetailsFromId($viewProductCountDetails[$i]['identifer_name']);
            $productName = $productDetails['name'];
            array_push($productNameArray, $productName);
            array_push($productViewCountArray, $viewProductCountDetails[$i]['views']);
            // }



            $i++;
        }
        $encodedProductNameArray  = json_encode($productNameArray);
        $encodedProductViewCountArray = json_encode($productViewCountArray);

        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done calculating TOP 6 VIWED arrays from db in " . $time . " seconds";
        // $time_start = microtime(true);


        $soldProductListArray = topSoldItemList();
        $soldProductCount = count($soldProductListArray);
        // print_r($soldProductListArray);

        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done calculating TOP 6 SOLD  arrays from db in " . $time . " seconds";
        // $time_start = microtime(true);

        $j = 0;
        $soldProductNameArray = [];
        $soldProductCountArray = [];

        while ($j < 6) {
            // if($soldProductCount<6 && $j<$soldProductCount){
            array_push($soldProductNameArray, $soldProductListArray[$j]['product_name']);
            array_push($soldProductCountArray, $soldProductListArray[$j]['ordered_quantity']);
            // }
            $j++;
        }
        // $time_end = microtime(true);
        // $time = $time_end - $time_start;
        // echo "<br>Done Initial Calculations within " . $time . " seconds";
        // $time_start = microtime(true);



        $encodedSoldProductNameArray = json_encode($soldProductNameArray);
        $encodedSoldProductCountArray = json_encode($soldProductCountArray);

        // $time_end = microtime(true);
        // $time = $time_end - $all_time_start;
        // echo "<br>Done total Calculations within " . $time . " seconds";
        // $time_start = microtime(true);


        ?>

        <!-- Main content -->

        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>৳ <?php echo getTodaysSalesDataFromSubBranchId(1); ?></h3>

                                <h4>Kona - Gulshan</h4>
                                <p>Sold Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $startTime = date('Y-m-d 00:00:00');
                                    $endTime = date('Y-m-d H:i:s');
                                    echo count(getAllDataOFOrderProcessTable(" AND status < 7 AND sub_branch_id = 1 AND order_time between '$startTime' and '$endTime'"));
                                    ?>
                                </h3>
                                <h4>Kona - Gulshan</h4>
                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>৳ <?php echo getTodaysSalesDataFromSubBranchId(2); ?></h3>

                                <h4>Kona - Satarkul</h4>
                                <p>Sold Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $startTime = date('Y-m-d 00:00:00');
                                    $endTime = date('Y-m-d H:i:s');
                                    echo count(getAllDataOFOrderProcessTable(" AND status < 7 AND sub_branch_id = 2 AND order_time between '$startTime' and '$endTime'"));
                                    ?>
                                </h3>
                                <h4>Kona - Satarkul</h4>
                                <p>Sold Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <h5 class="card-title">Monthly Recap Report</h5>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="text-center">
                                            <strong>Sales Report: <?php echo date('M Y', strtotime('-5 month')) . " - " . date("M Y"); ?></strong>
                                        </p>

                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" height="200" style="height: 250px;"></canvas>
                                        </div>
                                        <!-- /.chart-responsive -->
                                    </div>
                                    <!-- /.col -->

                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span> -->
                                            <h5 class="description-header">৳ <?php $lastMonthSale = json_decode(getSalesDataFromMonthCount(1));
                                                                                echo $lastMonthSale['0']; ?></h5>
                                            <span class="description-text">TOTAL SALE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <!-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span> -->
                                            <h5 class="description-header">৳ <?php $lastMonthPurchase = json_decode(getPurchaseDataFromMonthCount(1));
                                                                                echo $lastMonthPurchase['0']; ?></h5>
                                            <span class="description-text">TOTAL PURCHASE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block border-right">
                                            <!-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> -->
                                            <h5 class="description-header">৳ <?php $lastMonthExpense = json_decode(getExpenseDataFromMonthCount(1));
                                                                                echo $lastMonthExpense['0']; ?></h5>
                                            <span class="description-text">TOTAL EXPENSE</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        <div class="description-block">
                                            <!-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> -->
                                            <h5 class="description-header">৳ <?php echo $lastMonthProfit = floatval($lastMonthSale['0']) - (floatval($lastMonthPurchase['0']) + floatval($lastMonthExpense['0'])); ?></h5>
                                            <span class="description-text">TOTAL PROFIT</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Main row -->

                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> <?php echo $menuViewCount; ?></h3>

                                <p>Menu View</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $checkoutViewCount; ?></h3>

                                <p>Went to Checkout</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $totalOrderCount; ?></h3>

                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $mostViewedProduct; ?></h3>

                                <p>Highest Viewed Product: <?php echo $mostViewedProductName; ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <!-- /.row -->

                <!-- Main row -->

                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>


        <!-- /.content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-md-6">



                        <!-- STACKED BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Daily Sales Report: KONA Gulshan </h3>


                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="col-md-6">

                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Monthly report: Purchase | Sales | Expense </h3>


                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3> <?php echo $averageDailySales; ?></h3>

                                <p>Average daily sales of this month</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $extraPackaging; ?></h3>

                                <p>Extra Packaging Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo intval($discountAmount[0]['total_amount']); ?></h3>

                                <p>Discount Amount Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?php echo $extraPackaging; ?></h3>

                                <p>Approximate Sales Today</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <!-- complementary -->
                    <div class="col-md-12">
                        <!-- solid sales graph -->
                        <div class="card bg-gradient-info">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Complementary Last 7 Days
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- comparative weekly chart data -->
                    <div class="col-lg-12">
                        <div class="card bg-gradient-yellow">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h2 class="card-title"><i class="fas fa-chart-bar"></i> Weekly Comparision of Sales Data</h2>
                                    <!-- <a href="javascript:void(0);">View Report</a> -->
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-primary text-lg">BDT <?php echo round(floatval($lastWeekTotalSale), 2); ?></span>
                                        <span class="text-bold text-primary">Sales Last Week </span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-center">
                                        <span class="text-bold text-lg text-success">BDT <?php echo round(floatval($thisWeekTotalSale), 2); ?></span>
                                        <span class="text-bold text-success">Sales This Week </span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class=" text-lg text-bold text-<?php echo $thisWeekTotalSale > $lastWeekTotalSale ? 'success' : 'danger'; ?>">
                                            Overall
                                            <i class="fas fa-arrow-<?php echo $thisWeekTotalSale > $lastWeekTotalSale ? 'up' : 'down'; ?>"></i>
                                            <?php echo $comparativePercentage; ?>%
                                        </span>
                                        <span class="text-bold">Than Last Week</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-center">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> Last Week
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-success"></i> This Week
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <!-- discount data  -->
                    <div class="col-md-12">
                        <!-- solid sales graph -->
                        <div class="card bg-gradient-success">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-th mr-1"></i>
                                    Discount Last 7 Days
                                </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">
                                <canvas class="Discount chart" id="discount-line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <!-- PIE CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Top Six Sold Items</h3>


                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>



                    <!-- /.card -->
                    <div class="col-md-6">
                        <!-- DONUT CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Top 6 Viewed Products</h3>


                            </div>
                            <div class="card-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->



                    </div>

                    <!-- <div class="col-md-1"></div> -->

                    <div class="col-md-12">
                        <div class="card card-parimary">
                            <div class="card-header">
                                <h3 class="card-title">Upcoming Birthdays of KONA Clients</h3>
                            </div>
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- <div class="col-md-1"></div> -->



                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->
    <?php $monthWiseSalesData = getSalesDataFromMonthCount(6); ?>
    <input type="hidden" id="monthSalesData" name="" value="<?php echo $monthWiseSalesData; ?>">

    <?php
    $clientBrithdayDetailsfromPHP = array();

    $birthdayClients = sortClientsByBirthday(365);
    // print_r($birthdayClients);
    // echo "<script> var clientBrithdayDetails =" . json_encode($birthdayClients) . "</script>";

    foreach ($birthdayClients as $key => $value) {

        $newItem = array(
            "title" => $birthdayClients[$key]['customer_name'] . "\n" . $birthdayClients[$key]['customer_mobile'] . "\nTotal Orders: " . $birthdayClients[$key]['total_orders'],
            "start" =>  $birthdayClients[$key]['customer_birthday_left'],

        );

        array_push($clientBrithdayDetailsfromPHP, $newItem);
    }

    echo "<script> var clientBrithdayDetails =" . json_encode($clientBrithdayDetailsfromPHP) . "</script>";

    ?>

    <?php require 'includes/footer.php'; ?>
    <script src="plugins/chart.js/Chart.min.js"></script>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- fullCalendar 2.2.5 -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/fullcalendar/main.min.js"></script>
    <script src="plugins/fullcalendar-daygrid/main.min.js"></script>
    <script src="plugins/fullcalendar-timegrid/main.min.js"></script>
    <script src="plugins/fullcalendar-interaction/main.min.js"></script>
    <script src="plugins/fullcalendar-bootstrap/main.min.js"></script>



    <script type="application/javascript">
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";

        var currentDate = new Date();
        var currentMonth = currentDate.getMonth();
        var currentMonthName = month[currentMonth];

        function getLast6MonthsName() {
            var i = 0;
            var last6MonthsName = [];
            while (i != 6) {
                if (currentMonth < 0) {

                    currentMonth = 11;
                    last6MonthsName.push(month[currentMonth]);
                } else {

                    last6MonthsName.push(month[currentMonth]);
                }
                currentMonth--;
                i++;
            }

            return last6MonthsName.reverse();
        }





        function getSalesDataFromMonthCount() {
            <?php echo "var currentMonthData = " . getSalesDataFromMonthCount(6) . ";\n"; ?>
            // alert(currentMonthData);

            return currentMonthData.reverse();
        }

        function getPurchaseDataFromMonthCount() {
            <?php echo "var purchaseData = " . getPurchaseDataFromMonthCount(6) . ";\n"; ?>
            // alert(currentMonthData);

            return purchaseData.reverse();
        }

        function getExpenseDataFromMonthCount() {
            <?php echo "var expenseData = " . getExpenseDataFromMonthCount(6) . ";\n"; ?>
            // alert(currentMonthData);

            return expenseData.reverse();
        }


        function getSellDataFromDayCount() {
            <?php echo "var lastDays = " . getSalesDataFromDaysCount(7) . ";\n"; ?>
            //alert(lastDays);
            return lastDays;
        }


        function getLastDate() {
            <?php echo "var lastDays = " . getLastDate(7) . ";\n"; ?>
            //alert(lastDays);
            return lastDays;
        }




        var monthsName = getLast6MonthsName();

        var salesData = getSalesDataFromMonthCount();
        var purchaseData = getPurchaseDataFromMonthCount();
        var expenseData = getExpenseDataFromMonthCount();
        var salesDataDays = getSellDataFromDayCount();
        var daysName = getLastDate();

        var pseData = {
            labels: monthsName,
            datasets: [{
                    label: 'Purchase',
                    backgroundColor: 'rgba(255,193,7,1)',
                    borderColor: 'rgba(255,193,7,1)',
                    pointRadius: false,
                    pointColor: '#ffc107',
                    pointStrokeColor: 'rgba(255,193,7,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(255,193,7,1)',
                    data: purchaseData
                },
                {
                    label: 'Sales',
                    backgroundColor: 'rgba(40,167,69,1)',
                    borderColor: 'rgba(40,167,69,1)',
                    pointRadius: false,
                    pointColor: 'rgba(40,167,69,1)',
                    pointStrokeColor: '#28a745',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(40,167,69,1)',
                    data: salesData
                },
                {
                    label: 'Expense',
                    backgroundColor: 'rgba(220, 53, 69, 1)',
                    borderColor: 'rgba(220, 53, 69, 1)',
                    pointRadius: false,
                    pointColor: 'rgba(220, 53, 69, 1)',
                    pointStrokeColor: '#dc3545',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220, 53, 69, 1)',
                    data: expenseData
                },
            ]
        }





        $(function() {

            'use strict'

            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //-----------------------
            //- MONTHLY SALES CHART -
            //-----------------------

            // Get context with jQuery - using jQuery's .get() method.
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
            var salesData = getSalesDataFromMonthCount();
            // alert("");
            // var getSalesDataFromMonthCount();


            var salesChartData = {

                labels: monthsName,
                datasets: [{
                    label: 'Total Sales ৳ ',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    // data: salesData
                    data: salesData
                }, ]
            }

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            })


            <?php echo "var productNameArray = " . $encodedProductNameArray . ";\n"; ?>
            <?php echo "var productViewCountArray = " . $encodedProductViewCountArray . ";\n"; ?>

            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: productNameArray,
                datasets: [{
                    data: productViewCountArray,
                    backgroundColor: ['#00c0ef', '#f56954', '#00a65a', '#f39c12', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.

            <?php echo "var soldProductNameList = " . $encodedSoldProductNameArray . ";\n"; ?>
            <?php echo "var soldProductCount = " . $encodedSoldProductCountArray . ";\n"; ?>

            var pieData = {
                labels: soldProductNameList,
                datasets: [{
                    data: soldProductCount,
                    backgroundColor: ['#f56954', '#00c0ef', '#f39c12', '#00a65a', '#3c8dbc', '#d2d6de'],
                }]
            }

            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = pieData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartData = {
                labels: daysName,
                datasets: [{
                    label: 'Kona Cafe Gulshan Sales',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: salesDataDays
                }]
            }

            //var temp0 = areaChartData.datasets[0];
            var temp1 = barChartData.datasets[0];
            // var temp2 = areaChartData.datasets[2]

            // barChartData.datasets[0] = temp2
            barChartData.datasets[0] = temp1
            //barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: pseData,
                options: barChartOptions
            })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = jQuery.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            var stackedBarChart = new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })



        });

        $(function() {

            function ini_events(ele) {
                ele.each(function() {


                    var eventObject = {
                        title: $.trim($(this).text())
                    }

                    $(this).data('eventObject', eventObject)



                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()
            // alert(new Date(y, m, 1));
            var Calendar = FullCalendar.Calendar;

            var calendarEl = document.getElementById('calendar');

            var clientBrithdayDetailsToJS = new Array();

            var title = [""];
            var start = [""];
            var backgroundColor = [""];
            var borderColor = [""];
            var allDay = [""];



            for (var i = 1; i < clientBrithdayDetails.length; i++) {

                var mergedSingleArray = new Array();

                mergedSingleArray['title'] = clientBrithdayDetails[i].title;
                mergedSingleArray['start'] = new Date(y, m, d + 1 + clientBrithdayDetails[i].start);
                mergedSingleArray['backgroundColor'] = "red";
                mergedSingleArray['borderColor'] = "red";
                mergedSingleArray['allDay'] = true;

                clientBrithdayDetailsToJS.push(mergedSingleArray);
            }

            var calendar = new Calendar(calendarEl, {
                plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                'themeSystem': 'bootstrap',
                //Random default events
                events: clientBrithdayDetailsToJS,

                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();

        })


        // Complementary graph chart
        var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');

        var complementaryItemsAmount = <?php echo json_encode($complementaryItemsAmount); ?>;

        var salesGraphChartData = {
            labels: <?php echo json_encode($complementaryItemsDate); ?>,
            datasets: [{
                label: 'Complementary Amount BDT',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#efefef',
                pointRadius: 6,
                pointHoverRadius: 12,
                pointColor: '#efefef',
                pointBackgroundColor: '#efefef',
                data: complementaryItemsAmount
            }]
        }

        var salesGraphChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#efefef',
                    },
                    gridLines: {
                        display: false,
                        color: '#efefef',
                        drawBorder: false,
                    }
                }],
                yAxes: [{
                    ticks: {
                        // stepSize: 1000,
                        fontColor: '#efefef',
                    },
                    gridLines: {
                        display: true,
                        color: '#efefef',
                        drawBorder: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesGraphChart = new Chart(salesGraphChartCanvas, {
            type: 'line',
            data: salesGraphChartData,
            options: salesGraphChartOptions
        })


        // Discount graph chart
        var salesGraphChartCanvas = $('#discount-line-chart').get(0).getContext('2d');

        var discountItemsAmount = <?php echo json_encode($discountItemsAmount); ?>;

        var discountGraphChartData = {
            labels: <?php echo json_encode($discountItemsDate); ?>,
            datasets: [{
                label: 'Discount Amount BDT',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#efefef',
                pointRadius: 6,
                pointHoverRadius: 12,
                pointColor: '#efefef',
                pointBackgroundColor: '#efefef',
                data: discountItemsAmount
            }]
        }

        var discountGraphChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
            scales: {
                xAxes: [{
                    ticks: {
                        fontColor: '#efefef',
                    },
                    gridLines: {
                        display: false,
                        color: '#efefef',
                        drawBorder: false,
                    }
                }],
                yAxes: [{
                    ticks: {
                        // stepSize: 1000,
                        fontColor: '#efefef',
                    },
                    gridLines: {
                        display: true,
                        color: '#efefef',
                        drawBorder: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesGraphChart = new Chart(salesGraphChartCanvas, {
            type: 'line',
            data: discountGraphChartData,
            options: discountGraphChartOptions
        })




        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index';
        var intersect = true;

        var $salesChart2 = $('#sales-chart')
        var dayNames = [];

        for (i = 1; i <= 7; i++) {
            let day = moment().add(i, 'days');
            dayNames.push(day.format('dddd'));
        }

        var thisWeekData = <?php echo json_encode($last7DaysSalesData); ?>;
        var previousWeekData = <?php echo json_encode($last7to14DaysSalesData); ?>;

        var salesChart2 = new Chart($salesChart2, {
            type: 'bar',
            data: {
                labels: dayNames,
                datasets: [
                    
                    {
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        data: previousWeekData.reverse()
                    },
                    {
                        backgroundColor: '#28a745',
                        borderColor: '#28a745',
                        data: thisWeekData.reverse()
                    }

                ]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true,

                        },
                        ticks: $.extend({
                            beginAtZero: true,

                            //Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                if (value >= 1000) {
                                    value /= 1000
                                    value += 'k'
                                }
                                return 'BDT ' + value
                            }
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: true,

                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    </script>



    </body>

    </html>