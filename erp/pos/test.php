<?php
session_start();
include '../includes/easyfunctions.php';


print_r($_SESSION);

// //unset($_SESSION['table05'])


// $tableId = "table".$_REQUEST['tableId'];
// $arrayName = $_REQUEST['arrayName'];
// $outereArrayIndex = $_REQUEST['outereArrayIndex'];
// $innerArrayIndex = $_REQUEST['innerArrayIndex'];


// $arrayName1 = $arrayName."_ids";
// $arrayName2 = $arrayName."_prices";


// $a = $_SESSION[$tableId][$outereArrayIndex][$arrayName1];
// $array = array_diff_key($a, [$innerArrayIndex]);
// $_SESSION[$tableId][$outereArrayIndex][$arrayName1] = array();
// foreach ($array as $key => $value) {
//     array_push($_SESSION[$tableId][$outereArrayIndex][$arrayName1], $array[$key]);
// }


// $a = $_SESSION[$tableId][$outereArrayIndex][$arrayName2];
// $array = array_diff_key($a, [$innerArrayIndex]);
// $_SESSION[$tableId][$outereArrayIndex][$arrayName2] = array();
// foreach ($array as $key => $value) {
//     array_push($_SESSION[$tableId][$outereArrayIndex][$arrayName2], $array[$key]);
// }



?>