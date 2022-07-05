<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require '../includes/easyfunctions.php';


$products = getAllDataOfProductTable(" AND `photo` LIKE '%<br>%'");

print_r($products);

foreach($products as $product){
    //echo $product['photo'];
    // $imagePath = "../images/".$product['photo'];
    // $newPath = "images/";
    // $newName  = $newPath.$product['photo'];


    echo $photoName = substr($product['photo'],0,-4)."";
        $sql = "UPDATE `products` SET `photo`='$photoName' WHERE id = ".$product['id'];
        $con->query($sql); 


    // $copied = copy($imagePath , $newName);

    // if ((!$copied)) 
    // {
    //     echo "Error : Not Copied -- ".$product['name']."<br><br><br>";
    // }
    // else
    // {
        
    //     echo "Copied Successful -- ".$product['name']."<br>";
    // }
}
?>