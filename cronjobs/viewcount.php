<?php
require '../erp/includes/easyfunctions.php';

$queryViewCountArray = getViewCountOfProduct();

$blankViewCountArray = getViewCountOfPage();

$queryViewCount = serialize($queryViewCountArray);

$blankViewCount = serialize($blankViewCountArray);

$currentTime = date("Y-m-d H:i:s");

$sql = "UPDATE `cronjobs` SET `value` = '$blankViewCount', `last_updated` = '$currentTime' WHERE `cronjobs`.`id` = 2";

$con->query($sql);

$sql = "UPDATE `cronjobs` SET `value` = '$queryViewCount', `last_updated` = '$currentTime' WHERE `cronjobs`.`id` = 3";

$con->query($sql);
?>