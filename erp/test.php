<?php

//error_reporting(0);

//for localhost
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "restauranterp";


//for kona cafe server
// $host = "localhost";
// $db_user = "konacafe_erpu";
// $db_pass = "konacafe_erpp";
// $db_name = "konacafe_erp";

require 'includes/easyfunctions.php';




?>

<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <?php
    $daysLeft = 20;
    $due_date = "20-06"."/2021";
    $due_date_ymd = date('d-m-Y', strtotime(str_replace('/', '-', $due_date)));
    $seconds_to_expire = strtotime($due_date_ymd) - time();
    if ($seconds_to_expire < $daysLeft * 86400) {
        echo $daysLeft;
    }

    ?>
</body>

</html>