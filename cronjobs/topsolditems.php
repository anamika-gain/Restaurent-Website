<?php
require '../erp/includes/easyfunctions.php';

$soldItemsArray = topSoldItemListMain();

$soldItems = serialize($soldItemsArray);

$currentTime = date("Y-m-d H:i:s");

$sql = "UPDATE `cronjobs` SET `value` = '$soldItems', `last_updated` = '$currentTime' WHERE `cronjobs`.`id` = 1";

$con->query($sql);
?>