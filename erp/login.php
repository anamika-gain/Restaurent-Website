<?php

session_start();

$functionToCall = $_REQUEST['function'];
//print_r($_REQUEST);
if ($functionToCall == "login") {
    
    require 'includes/easyfunctions.php';

    $user_name = $_REQUEST['user_name'];
    $passwordGiven = hash('sha256', $_REQUEST['password']);


    $query = $con->query("select * from user WHERE status = 1 AND user_name = '$user_name'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $passwordStored = strrev(substr($row['password'], 25));
        if ($passwordGiven == $passwordStored) {
            //print_r($row);
            session_unset();

            $_SESSION["user_id"] = $row['id'];
            $_SESSION["user_name"] = $row['user_name'];
            $_SESSION["user_full_name"] = $row['full_name'];
            $_SESSION["user_type"] = $row['user_type'];
            $_SESSION["user_photo"] = $row['photo'];
            $_SESSION["user_branch_id"] = $row['branch_id'];
            $_SESSION["user_sub_branch_id"] = $row['sub_branch_id'];
            
            

            $branchDetails = getBranchDetailsFromId($row['branch_id']);
            $_SESSION["user_branch_name"] = $branchDetails['name'];

            $SubBranchDetails = getSubBranchDetailsFromId($row['sub_branch_id']);
            $_SESSION["user_sub_branch_name"] = $SubBranchDetails['name'];

            echo "<script>window.location.href = 'home.php';</script>";
        } else {
            echo "<script>window.location.href = 'index.php?message=Invalid User Name or Password Provided';</script>";
        }
    }
} elseif ($functionToCall == "felogin") {
    require 'includes/connect.php';
    $returnUrl = $_REQUEST['returnUrl'];
    $mobileNumber = $_REQUEST['mobileNumber'];
    $passwordGiven = hash('sha256', $_REQUEST['password']);


    $query = $con->query("select * from client WHERE status = 1 AND mobile = '$mobileNumber'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        //print_r($row);

        $passwordStored = strrev(substr($row['password'], 25));

        $passwordGiven = preg_replace('/\s+/', '', $passwordGiven);
        $passwordStored =  preg_replace('/\s+/', '', $passwordStored);
        

        if ($passwordGiven == $passwordStored) {


            setcookie("client_id", $row['id'], time() + (86400 * 30 * 12), "/");
            setcookie("client_name", $row['name'], time() + (86400 * 30 * 12), "/");
            setcookie("client_email", $row['email'], time() + (86400 * 30 * 12), "/");
            setcookie("client_mobile", $row['mobile'], time() + (86400 * 30 * 12), "/");
            setcookie("client_dob", $row['dob'], time() + (86400 * 30 * 12), "/");
            setcookie("client_address", $row['address'], time() + (86400 * 30 * 12), "/");

            echo "<script>window.location.href = '" . $returnUrl . "';</script>";
        } else {
            
            echo "<script>window.location.href = '" . $returnUrl . "?message=Invalid User Name or Password Provided';</script>";
        
        }
    }
} elseif ($functionToCall == "register") {
    require 'includes/easyfunctions.php';
    global $con;
    $salt = generateSaltString();
    $returnResult = false;

    if (isset($_REQUEST['clientName']) || isset($_REQUEST['clientEmail']) || isset($_REQUEST['clientMobile']) || isset($_REQUEST['clientDOB']) || isset($_REQUEST['clientAddress']) || isset($_REQUEST['clientPassword'])) {
        $clientName = $_REQUEST['clientName'];
        $clientEmail = $_REQUEST['clientEmail'];
        $clientMobile = $_REQUEST['clientMobile'];
        $clientDOB = $_REQUEST['clientDOB'];
        $clientAddress = $_REQUEST['clientAddress'];
        $clientPassword = $salt . strrev(hash('sha256', $_REQUEST['clientPassword']));

        $returnResult = true;

        $sql = "INSERT INTO `client` (`name`, `email`, `mobile`, `dob`, `address`, `password`) VALUES ('$clientName', '$clientEmail', '$clientMobile', '$clientDOB', '$clientAddress', '$clientPassword')";

        if ($con->query($sql)) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $clientDetails = getClientDetailsFromMobileNumber($clientMobile);
            $clientId = $clientMobile; //$clientDetails['id'];

        }
    }

    echo "<script>window.location.href = 'set_cookie_client.php?clientId=$clientId';</script>";
} else {
    echo "Your PC will be infected with the VIRUS within 2 mins, please do not close the PC for a successfull VIRUS installation !";
}




// $salt = generateSaltString();
// $passwordNormal = strrev(hash('sha256', "123456")); 
// $passwordNormal2 = $salt.strrev(hash('sha256', "123456"));
// $passwordNormal3 = substr($passwordNormal2, 25);

// echo $salt."<br>".$passwordNormal."<br>".$passwordNormal2."<br>".$passwordNormal3;

// if($passwordNormal == $passwordNormal2){
//     echo "<br>Matched even with salt !";
// }


// if($passwordNormal == $passwordNormal3){
//     echo "<br>Matched without salt !";
// }
