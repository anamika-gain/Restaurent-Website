<?php

//date_default_timezone_set('Asia/Dhaka');
require 'includes/easyfunctions.php';

//echo date("Y-m-d H:i:s");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// $numberOfMonths = 6;
// $currentMonth = date("m");


// for ($i=1; $i <= $numberOfMonths; $i++) { 
//     echo date("Y-m-01 00:00:00", strtotime($changeTime))."<br>";
// }



// $count = 1;
// while ($count <= 12) {
//     $changeTime = "-".$count." months";

//     echo date("Y-m-01 00:00:00", strtotime($changeTime))."<br>";

//     $count++;
// }


// $count = 1;



// var_dump(getAllDataOfProductTable(" "));


$subBranchId = 0;
                    $nullSubBranchId = null;
                    $fromDate = "2021-06-01";
                    $toDate = date("Y-m-d");

$itemwiseReportDetails = getItemwiseSalesReport(0, $subBranchId, $fromDate, $toDate);
print_r($itemwiseReportDetails);


?>


