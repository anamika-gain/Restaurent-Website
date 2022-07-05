
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'connect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['table00'])) {
    $_SESSION['table00'] = array();
}
if (!isset($_SESSION['table01'])) {
    $_SESSION['table01'] = array();
}
if (!isset($_SESSION['table02'])) {
    $_SESSION['table02'] = array();
}
if (!isset($_SESSION['table03'])) {
    $_SESSION['table03'] = array();
}
if (!isset($_SESSION['table04'])) {
    $_SESSION['table04'] = array();
}
if (!isset($_SESSION['table05'])) {
    $_SESSION['table05'] = array();
}
if (!isset($_SESSION['table06'])) {
    $_SESSION['table06'] = array();
}
if (!isset($_SESSION['table07'])) {
    $_SESSION['table07'] = array();
}
if (!isset($_SESSION['table08'])) {
    $_SESSION['table08'] = array();
}
if (!isset($_SESSION['table08'])) {
    $_SESSION['table08'] = array();
}
if (!isset($_SESSION['table10'])) {
    $_SESSION['table10'] = array();
}
if (!isset($_SESSION['table11'])) {
    $_SESSION['table11'] = array();
}
if (!isset($_SESSION['table12'])) {
    $_SESSION['table12'] = array();
}
if (!isset($_SESSION['table13'])) {
    $_SESSION['table13'] = array();
}
if (!isset($_SESSION['table14'])) {
    $_SESSION['table14'] = array();
}
if (!isset($_SESSION['table15'])) {
    $_SESSION['table15'] = array();
}
if (!isset($_SESSION['table16'])) {
    $_SESSION['table16'] = array();
}
if (!isset($_SESSION['table17'])) {
    $_SESSION['table17'] = array();
}
if (!isset($_SESSION['table18'])) {
    $_SESSION['table18'] = array();
}
if (!isset($_SESSION['table19'])) {
    $_SESSION['table19'] = array();
}
if (!isset($_SESSION['table20'])) {
    $_SESSION['table20'] = array();
}



?>

<?php


// Some Functions Here 

function generateSaltString($length = 25)
{
    $characters = '0123456abcdef';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAllDataOfWeightTable($specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from weight WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


function getAllDataOfOrderProcessTable($specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from order_process WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getAllDataOfOrderItemsTable($specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from order_items WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getAllDataOfOrderItemTableFromUniqueOrderId($uniqueOrderId, $specialQuery = "")
{
    global $con;

    $result = array();

    $query = $con->query("select * from order_items WHERE status > 0 AND unique_order_id = '" . $uniqueOrderId . "'" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}



function getWeightDetailsFromId($id)
{
    global $con;
    $query = $con->query("select * from weight WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row;
}

function getWeightNameFromId($id)
{
    global $con;
    $query = $con->query("select * from weight WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row['name'];
}





// Branch Table Query

function getBranchDetailsFromId($id)
{
    global $con;
    $query = $con->query("select * from branch WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row;

    // $someVariable = getBranchDetailsFromId("1");

    // echo $someVariable['name'];
}

function getBranchStatusFromId($id)
{
    global $con;
    $query = $con->query("select * from branch WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row['status'];
}

function getAllDataOfBranchTable($specialQuery)
{
    global $con;


    $result = array();

    $query = $con->query("select * from branch WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}



// Sub Branch Table Query


function getManagerDetailsFromSubBranchId($subBranchId)
{
    global $con;

    $result = array();

    $query = $con->query("select * from user WHERE status > 0 AND user_type = 2 AND sub_branch_id = $subBranchId");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getAllDataOfSubBranchTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from sub_branch WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfSubBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}

function getAllDataOfSubBranchTableFromBranchIdForWebsite($branchId, $specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from sub_branch WHERE `branch_id` = '" . $branchId . "' AND status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfSubBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}

function getSubBranchDetailsFromId($id)
{
    global $con;
    $query = $con->query("select * from sub_branch WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row;

    // $someVariable = getSubBranchDetailsFromId("1");

    // echo $someVariable['name'];
}



// User Table Query

function getUserDetailsFromId($id)
{
    global $con;
    $query = $con->query("select * from user WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row;

    // $someVariable = getSubBranchDetailsFromId("1");

    // echo $someVariable['name'];
}

function getUserFullNameFromId($id)
{
    global $con;
    $query = $con->query("select * from user WHERE id=" . $id);
    $row = mysqli_fetch_array($query);
    return $row['full_name'];
}

function getAllDataOfUserTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from user WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}




// User Type Table Query


function getAllDataOfUserTypeTable($specialQuery)
{
    global $con;

    $result = array();



    $query = $con->query("select * from user_type WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


function getUserTypeFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from user_type WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}





// Employee Type Table Query


function getEmployeeTypeDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from employee_type WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfEmployeeTypeTable($specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from employee_type WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}



// Salary Type Table Query


function getSalaryTypeDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from salary_type WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfSalaryTypeTable($specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from salary_type WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


// Ingredient Table Query

function getIngredientDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from ingredients WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfIngredientTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND ";
    }

    $result = array();

    $query = $con->query("select * from ingredients WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}

function getAllUnaddedIngredientDetailsForAddingFromProductSizeId($id)
{
    global $con;

    $branchId = $_SESSION["user_branch_id"]; // session user sub branch id, 1 is for demo only 
    $subBranchId = $_SESSION["user_sub_branch_id"]; // session user sub branch id, 1 is for demo only 

    //generate ingredients ids that are not yet used.

    // $sql = "SELECT t1.id
    //         FROM ingredients t1
    //         LEFT JOIN product_ingredients t2 ON t2.ingredient_id = t1.id AND t2.product_size_id = $id 
    //         WHERE t2.id IS NULL AND t1.branch_id= $branchId AND t1.sub_branch_id= $subBranchId";

    $sql = "SELECT t1.id
    FROM ingredients t1
    LEFT JOIN product_ingredients t2 ON t2.ingredient_id = t1.id AND t2.product_size_id = $id 
    WHERE t2.id IS NULL AND t1.branch_id= $branchId";

    $query = $con->query($sql);

    $result = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $query2 = $con->query("select * from ingredients WHERE id = " . $row['id']);

        $row2 = mysqli_fetch_array($query2);

        array_push($result, $row2);
    }

    return $result;
}

function getDefaultWeightInNameFromIngredientId($id)
{
    global $con;

    $query = $con->query("select * from ingredients WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    $query2 = $con->query("select * from weight WHERE id = " . $row['default_weight_in']);

    $row2 = mysqli_fetch_array($query2);

    return $row2['name'];
}


// Product Category Table Query

function getProductCategoryDetailsFromId($id)
{
    global $con;

    // $branchId = $_SESSION['user_branch_id'];
    // $subBranchId = $_SESSION['user_sub_branch_id'];

    // if ($_SESSION['user_type'] == 1) {
    //     $sessionQuery = "";
    // } else {
    //     $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    // }

    $result = array();

    $query = $con->query("select * from product_category WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfProductCategoryTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from product_category WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}

function getAllDataOfProductCategoryTableForWebsite($branchId, $subBranchId, $specialQuery)
{
    global $con;

    //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    $sessionQuery = "branch_id = '$branchId' AND";


    $result = array();

    $query = $con->query("select * from product_category WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getAllDataOfProductSubCategoryTableForWebsite($branchId, $categoryId, $specialQuery = "")
{
    global $con;

    //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    $sessionQuery = "branch_id = '$branchId' AND category_id='$categoryId' AND ";


    $result = array();

    $query = $con->query("select * from product_sub_category WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


// Product Sub Category Table Query

function getProductSubCategoryDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_sub_category WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfProductSubCategoryTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from product_sub_category WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


// Ingredient Category Table Query

function getIngredientCategoryDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from ingredient_category WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfIngredientCategoryTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from ingredient_category WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


// Ingredient Sub Category Table Query

function getIngredientSubCategoryDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from ingredient_sub_category WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfIngredientSubCategoryTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from ingredient_sub_category WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


// Product Table Query

function getProductDetailsFromId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from products WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}

function getProductDetailsFromUniqueId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from products WHERE unique_id = '$id'");

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfProductTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from products WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


function getAllDataOfProductTableForWebsiteView($branchId = 0, $subBranchId = 0, $specialQuery)
{
    global $con;

    // $branchId = $_SESSION['user_branch_id'];
    // $subBranchId = $_SESSION['user_sub_branch_id'];

    // if ($_SESSION['user_type'] == 1) {
    //     $sessionQuery = "";
    // } else {
    //     $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    // }

    // if ($branchId == 0 && $subBranchId == 0) {
    //     $sessionQuery = "";
    // } elseif ($branchId == 0 && $subBranchId > 0) {
    //     $sessionQuery = "sub_branch_id = '$subBranchId' AND ";
    // } elseif ($branchId > 0 && $subBranchId == 0) {
    //     $sessionQuery = "branch_id = '$branchId' AND ";
    // } else {
    //     $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND ";
    // }

    if ($branchId == 0 && $subBranchId == 0) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND ";
    }

    $result = array();
    //echo "select * from products WHERE " . $sessionQuery . " status > 0 AND website_view = 1" . $specialQuery;
    $query = $con->query("select * from products WHERE " . $sessionQuery . " status > 0 AND website_view = 1" . $specialQuery . " ORDER BY name");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


function getAllDataOfProductSizeTableFromProductId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_size WHERE status > 0 AND product_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getAllDataOfProductIngredientTableFromProductSizeId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_ingredients WHERE status > 0 AND product_size_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getAllDataOfProductOptionTitleTableFromProductSizeId($productSizeId)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_option_title WHERE status > 0 AND product_size_id= '$productSizeId'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getProductSizeDetailsFromProductSizeId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_size WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getProductOptionTitleDetailsFromProductTitleId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_option_title WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}

function getAllDataOfProductOptionTableFromProductTitleId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_option WHERE status > 0 AND product_title_id=" . $id);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getDetailsOfProductOptionTableFromId($id)
{
    global $con;

    $query = $con->query("select * from product_option WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getDetailsOfProductTitleTableFromId($id)
{
    global $con;

    $query = $con->query("select * from product_option_title WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}

function getAllDataOfProductOptionTitleTable($specialQuery = "")
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_option_title WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getAllDataOfProductOptionIngredientTableFromProductOptionId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_option_ingredients WHERE status > 0 AND product_option_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getDetailsOfProductAddonIngredientTableFromProductAddonId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_addons_ingredients WHERE status > 0 AND product_addon_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getAllDataOfProductAddonTableFromProductId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from product_addons WHERE status > 0 AND product_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}





function getIngredientDetailsFromTableAndId($table_name, $id)
{
    global $con;

    $query = $con->query("select * from $table_name WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfRequisitionProcessTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from requisition_process WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $requisitionId = $row['unique_requisition_id'];

        $sql = "SELECT * FROM requisition_items WHERE status > 0 AND unique_requisition_id= '$requisitionId'";
        $query2 = $con->query($sql);
        $rowcount = mysqli_num_rows($query2);

        $row['total_item'] = $rowcount;
        array_push($result, $row);
    }

    return $result;

    //print_r($result);

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


function currentStatusOfRequisitionProcess($requisitionGivenBy, $requisitionStatus)
{
    global $con;
    $userDetails = getUserDetailsFromId($requisitionGivenBy);
    $userType = $userDetails['user_type'];
    if ($requisitionStatus == 1) {
        echo 'Requisition Submitted !<br><b class="bg-info">Not Yet Approved By Manager!</b>';
    } elseif ($requisitionStatus == 2) {
        if ($userType == 2) {
            echo 'Requisition Submitted !<br><b class="bg-danger">Not Yet Approved By Admin!</b>';
        } else {
            echo 'Requisition Submitted !<br><b class="bg-success">Approved By Manager!</b><br><b class="bg-danger">Not Yet Approved By Admin!</b>';
        }
    } elseif ($requisitionStatus == 3) {
        echo '<b class="bg-success">Approved By Manager & Admin !</b><br><b class="bg-danger">Not Yet Purchased!</b>';
    } elseif ($requisitionStatus == 4) {
        echo '<b class="bg-success">Requisition Ready To Be Delivered!</b>';
    } else {
        echo '<b class="bg-success">Requisition Delivered!</b>';
    }
}


function getAllDataOfRequisitionItemTableFromRequisitionUniqueId($id, $specialQuery = "")
{
    global $con;

    $result = array();

    $query = $con->query("select * from requisition_items WHERE status > 0 AND unique_requisition_id = '$id' $specialQuery");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

//getAllDataOfUnaddedRequisitionItemTableFromRequisitionUniqueId("16158737721232", $specialQuery = "");
function getAllDataOfUnaddedRequisitionItemTableFromRequisitionUniqueId($id, $specialQuery = "")
{
    global $con;

    $result = array();


    $query = $con->query("select * from requisition_items WHERE status > 0 AND unique_requisition_id = '$id' $specialQuery");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        //array_push($result, $row);
        $query2 = $con->query("select * from stock WHERE status > 0 AND unique_requisition_id = '$id' AND ingredient_id = '" . $row['ingredient_id'] . "'");
        $row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC);
        if (empty($row2)) {
            array_push($result, $row);
        }
    }

    return $result;
    //print_r($result);
}


//checkIfAllItemsArePurchased("16158737721232");
function checkIfAllItemsArePurchased($requisitionId, $specialQuery = "")
{
    global $con;
    $result = array();
    $result2 = array();
    $query = $con->query("select * from requisition_items WHERE status > 0 AND unique_requisition_id = '$requisitionId' $specialQuery");
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    $query2 = $con->query("select * from stock WHERE status > 0 AND unique_requisition_id = '$requisitionId'");
    while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
        array_push($result2, $row2);
    }

    // print_r($result2);




    if (count($result) == count($result2)) {
        return true;
        // echo "1 ----> ".count($result)."-->".count($result2);
    } else {
        return false;
        // echo "0 ----> ".count($result)."-->".count($result2);
    }
}

function getRequisitionApproveTimeDetailsFromRequisitionUniqueId($id)
{
    global $con;
    //$result = array();

    $query = $con->query("select * from requisition_items WHERE unique_requisition_id = '$id' LIMIT 1");

    $row = mysqli_fetch_array($query);

    if ($row['waiter_requisition_date'] == null || $row['waiter_requisition_date'] == "0000-00-00 00:00:00") {
        echo "Waiter: N/A<br>";
    } else {
        echo "Waiter: " . $row['waiter_requisition_date'] . "<br>";
    }

    if ($row['sub_manager_requisition_date'] == null || $row['sub_manager_requisition_date'] == "0000-00-00 00:00:00") {
        echo "Manager: N/A<br>";
    } else {
        echo "Manager: " . $row['sub_manager_requisition_date'] . "<br>";
    }

    if ($row['admin_requisition_date'] == null || $row['admin_requisition_date'] == "0000-00-00 00:00:00") {
        echo "Admin: N/A<br>";
    } else {
        echo "Admin: " . $row['admin_requisition_date'] . "<br>";
    }
}

//getAllDataOfRequisitionProcessTableForPurchaseList('');
function getAllDataOfRequisitionProcessTableForPurchaseList($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from requisition_process WHERE " . $sessionQuery . " status = 3" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $requisitionId = $row['unique_requisition_id'];

        $sql = "SELECT * FROM requisition_items WHERE status > 0 AND unique_requisition_id= '$requisitionId'";
        $query2 = $con->query($sql);
        $rowcount = mysqli_num_rows($query2);
        $row['total_item'] = $rowcount;

        $row2 = mysqli_fetch_array($query2);
        $row['requisition_approval_time'] = $row2['admin_requisition_date'];

        array_push($result, $row);
    }

    return $result;

    //print_r($result);
}


function getAllDataOfRequisitionProcessTableForPurchaseListSelect($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from requisition_process WHERE " . $sessionQuery . " status = 4" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $requisitionId = $row['unique_requisition_id'];

        $sql = "SELECT * FROM requisition_items WHERE status > 0 AND unique_requisition_id= '$requisitionId'";
        $query2 = $con->query($sql);
        $rowcount = mysqli_num_rows($query2);
        $row['total_item'] = $rowcount;

        $row2 = mysqli_fetch_array($query2);
        $row['requisition_approval_time'] = $row2['admin_requisition_date'];

        array_push($result, $row);
    }

    return $result;

    //print_r($result);
}


function getAllDataOfVendorTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $result = array();

    $query = $con->query("select * from vendor WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}

function getPaymentMethodDetailsFromId($id)
{
    global $con;

    $query = $con->query("select * from payment_method WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}

function getVendorDetailsFromId($id)
{
    global $con;

    $query = $con->query("select * from vendor WHERE id = " . $id);

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfStockTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from stock WHERE " . $sessionQuery . " ingredient_amount > 0 AND status > 0 $specialQuery  ORDER BY purchase_date ASC, ingredient_id ASC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}


//getIngredientStockDetailsFromIngredientId(5);
function getIngredientStockDetailsFromIngredientId($id, $specialQuery = "")
{
    global $con;
    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from stock WHERE " . $sessionQuery . " status > 0 AND ingredient_id = $id AND ingredient_amount > 0 $specialQuery ORDER BY purchase_date DESC");

    $ingredientAmount = 0;
    $lastStockIn = null;
    $lastBoughtPrice = null;

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        //array_push($result, $row);

        $ingredientAmount = floatval($ingredientAmount) + floatval($row['ingredient_amount']);

        if ($lastStockIn == null) {
            $lastStockIn = $row['purchase_date'];
        }

        if ($lastBoughtPrice == null) {
            $lastBoughtPrice = $row['ingredient_unit_price'];
        }
    }

    $ingredientDetails = getIngredientDetailsFromId($id);
    $ingredientWieghtInId = $ingredientDetails['default_weight_in'];
    $ingredientName = $ingredientDetails['ingredient_name'];
    $wieghtIn = getDefaultWeightInNameFromIngredientId($id);


    $result['ingredient_id'] = $id;
    $result['ingredient_name'] = $ingredientName;
    $result['ingredient_weight_in_id'] = $ingredientWieghtInId;
    $result['ingredient_weight_in'] = $wieghtIn;
    $result['ingredient_stock_amount'] = floatval($ingredientAmount);
    $result['ingredient_last_stock_in'] = $lastStockIn;
    $result['ingredient_last_bought_price'] = $lastBoughtPrice;



    //print_r($result);

    return $result;
}


function getAllDataOfPurchaseTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from purchase WHERE " . $sessionQuery . " status > 0 $specialQuery  ORDER BY id DESC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // $result = getAllDataOfBranchTable("");

    // foreach ($result as $key => $value) {

    //     echo $result[$key]['id'];
    // }
}

function getAllDataOfPurchaseDetailsTableFromPurchaseUniqueId($id, $specialQuery = "")
{
    global $con;

    $result = array();

    $query = $con->query("select * from purchase_details WHERE status > 0 AND unique_purchase_id = '$id' $specialQuery");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


//getAllDataOfRequisitionProcessTableForGuardEntry("");

function getAllDataOfRequisitionProcessTableForGuardEntry($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from requisition_process WHERE " . $sessionQuery . " status = 3 $specialQuery  ORDER BY id DESC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
    //print_r($result);
}


function getAllUnaddedIngredientCategoryForVendor($id, $specialQuery = "")
{
    global $con;
    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = " AND t1.branch_id = '$branchId' AND t1.sub_branch_id = '$subBranchId'";
        $sessionQuery = " AND t1.branch_id = '$branchId'";
    }


    $sql = "SELECT t1.id
            FROM ingredient_category t1
            LEFT JOIN vendor_ingredient_category t2 ON t2.category_id = t1.id AND t1.status > 0 AND t2.vendor_id = $id 
            WHERE t2.id IS NULL $sessionQuery $specialQuery";

    $query = $con->query($sql);

    $result = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $query2 = $con->query("select * from ingredient_category WHERE id = " . $row['id']);

        $row2 = mysqli_fetch_array($query2);

        array_push($result, $row2);
    }

    return $result;

    // print_r($result);
}



function getAllAddedIngredientCategoryForVendor($id, $specialQuery = "")
{
    global $con;
    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        //$sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
        $sessionQuery = "branch_id = '$branchId' AND";
    }


    $result = array();

    $query = $con->query("select * from vendor_ingredient_category WHERE status > 0 AND vendor_id = '$id' $specialQuery  ORDER BY id DESC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;

    // print_r($result);
}

function totalCartProduct($sessionName = "cart")
{
    return count($_SESSION[$sessionName]);
}

function totalCartItem($sessionName = "cart")
{
    $quantity = 0;
    foreach ($_SESSION[$sessionName] as $i => $value) {
        $quantity = $quantity + $_SESSION[$sessionName][$i]['quantity'];
    }
    return $quantity;
}

function totalCartPrice($sessionName = "cart")
{
    $totalPrice = 0;
    foreach ($_SESSION[$sessionName] as $i => $value) {
        $totalPrice = $totalPrice + $_SESSION[$sessionName][$i]['product_price'];
    }
    return $totalPrice;
}

function totalServiceCharge($basicAmount, $persentage)
{
    $serviceCharge = $basicAmount * ($persentage / 100);
    return round($serviceCharge, 3);
}

function totalTax($beforeTax, $persentage)
{
    $taxAmount = $beforeTax * ($persentage / 100);
    return round($taxAmount, 3);
}

function grandTotalFromBasicAmount($basicAmount, $servicePersentage, $taxPersentage)
{
    $serviceCharge = $basicAmount * ($servicePersentage / 100);
    $beforeTax = $basicAmount + $serviceCharge;
    $taxAmount = $beforeTax * ($taxPersentage / 100);
    $grandTotal = $basicAmount + $serviceCharge + $taxAmount;

    return round($grandTotal, 3);
}


function getAllDataOfWastageTable($specialQuery)
{
    global $con;

    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    }

    $result = array();

    $query = $con->query("select * from wastage WHERE " . $sessionQuery . " status > 0 $specialQuery  ORDER BY id DESC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
    //print_r($result);
}


function getClientDetailsFromMobileNumber($mobileNumber)
{
    global $con;

    $query = $con->query("select * from client WHERE mobile = '$mobileNumber'");

    $row = mysqli_fetch_array($query);

    return $row;
}


function getClientDetailsFromId($id)
{
    global $con;

    $query = $con->query("select * from client WHERE id = '$id'");

    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfClientTable($specialQuery)
{
    global $con;

    $result = array();

    $query = $con->query("select * from client WHERE status > 0 $specialQuery  ORDER BY id DESC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
    //print_r($result);
}


function getAllDataOfPaymentMethodTable($specialQuery = "")
{
    global $con;

    $result = array();

    $query = $con->query("select * from payment_method WHERE status > 0 $specialQuery");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
    //print_r($result);
}

function getPaymentMethodwiseReport($subBranchId = null, $paymentMethodId = null, $fromDate = null, $toDate = null)
{
    global $con;
    $result = array();
    $totalBill = 0;
    $totalPaidAmount = 0;

    if ($fromDate == null) {
        $fromDate = date("Y-m-d 00:00:00");
    } else {
        $fromDate = $fromDate . " 00:00:00";
    }

    if ($toDate == null) {
        $toDate = date("Y-m-d 23:59:59");
    } else {
        $toDate = $toDate . " 23:59:59";
    }

    if ($paymentMethodId == null) {
        $paymentMethodIdQuery = "";
    } else {
        $paymentMethodIdQuery = " AND id = '$paymentMethodId'";
    }


    if ($subBranchId == null) {
        $subBranchIdQuery = "";
    } else {
        $subBranchIdQuery = " AND sub_branch_id = '$subBranchId'";
    }

    $paymentMethodTableDetails = getAllDataOfPaymentMethodTable($paymentMethodIdQuery);


    foreach ($paymentMethodTableDetails as $key => $value) {

        $orderProcessTableDetails = getAllDataOfOrderProcessTable(" AND status <> 7 AND order_time BETWEEN '$fromDate' AND '$toDate' AND payment_method_id = " . $paymentMethodTableDetails[$key]['id'] . $subBranchIdQuery);

        foreach ($orderProcessTableDetails as $key2 => $value) {
            if ((($orderProcessTableDetails[$key2]['table_id'] == 0) && ($orderProcessTableDetails[$key2]['status'] == 6)) || (($orderProcessTableDetails[$key2]['table_id'] > 0) && ($orderProcessTableDetails[$key2]['status'] >= 4))) {

                $tempCurrentBill = $orderProcessTableDetails[$key2]['total_bill'];
                $tempCurrentPaid = $orderProcessTableDetails[$key2]['paid_amount'];

                if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
                    $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
                    $tempCurrentBill = ($percent * $tempCurrentBill) / 100;
                    $tempCurrentPaid = ($percent * $tempCurrentPaid) / 100;
                }


                $totalBill = $totalBill + $tempCurrentBill;
                if ($paymentMethodTableDetails[$key]['id'] == 1 || $paymentMethodTableDetails[$key]['id'] == 2) {
                    $totalPaidAmount = $totalPaidAmount + $tempCurrentBill;
                } else {
                    $totalPaidAmount = $totalPaidAmount + $tempCurrentPaid;
                }



                $addNew = 1;
                foreach ($result as $i => $value) {
                    if ($paymentMethodTableDetails[$key]['id'] == $result[$i]['payment_method_id']) {
                        $foundInArrayIndex = $i;
                        $addNew = 0;
                    }
                }

                if ($addNew == 1) {
                    $newItem = array(
                        "payment_method_id" => $paymentMethodTableDetails[$key]['id'],
                        "payment_method_name" => $paymentMethodTableDetails[$key]['name'],
                        "total_bill" => $tempCurrentBill,
                        "total_paid_amount" => $tempCurrentPaid,
                        "grand_total_bill" => 0,
                        "grand_paid_amount" => 0
                    );
                    array_push($result, $newItem);
                } else {
                    $result[$foundInArrayIndex]['total_bill'] = $result[$foundInArrayIndex]['total_bill'] + $tempCurrentBill;
                    $result[$foundInArrayIndex]['total_paid_amount'] = $result[$foundInArrayIndex]['total_paid_amount'] + $tempCurrentPaid;
                }
            }
        }
    }

    foreach ($result as $key => $value) {
        $result[$key]['grand_total_bill'] = $totalBill;
        $result[$key]['grand_paid_amount'] = $totalPaidAmount;
    }

    return $result;
}


function getCustomerwiseReport($subBranchId = null, $customerId = null, $fromDate = null, $toDate = null)
{
    global $con;
    $result = array();
    $totalBill = 0;
    $totalPaidAmount = 0;

    if ($fromDate == null) {
        $fromDate = date("Y-m-d 00:00:00");
    } else {
        $fromDate = $fromDate . " 00:00:00";
    }

    if ($toDate == null) {
        $toDate = date("Y-m-d 23:59:59");
    } else {
        $toDate = $toDate . " 23:59:59";
    }

    if ($customerId == null) {
        $customerIdQuery = "";
    } else {
        $customerIdQuery = " AND id = '$customerId'";
    }


    if ($subBranchId == null) {
        $subBranchIdQuery = "";
    } else {
        $subBranchIdQuery = " AND sub_branch_id = '$subBranchId'";
    }

    $customerTableDetails = getAllDataOfClientTable($customerIdQuery);


    foreach ($customerTableDetails as $key => $value) {

        $orderProcessTableDetails = getAllDataOfOrderProcessTable(" AND status <> 7 AND order_time BETWEEN '$fromDate' AND '$toDate' AND client_id = " . $customerTableDetails[$key]['id'] . $subBranchIdQuery);
        foreach ($orderProcessTableDetails as $key2 => $value) {
            if ((($orderProcessTableDetails[$key2]['table_id'] == 0) && ($orderProcessTableDetails[$key2]['status'] == 6)) || (($orderProcessTableDetails[$key2]['table_id'] > 0) && ($orderProcessTableDetails[$key2]['status'] >= 4))) {

                $totalBill = $totalBill + $orderProcessTableDetails[$key2]['total_bill'];
                if ($customerTableDetails[$key]['id'] == 1 || $customerTableDetails[$key]['id'] == 2) {
                    $totalPaidAmount = $totalPaidAmount + $orderProcessTableDetails[$key2]['total_bill'];
                } else {
                    $totalPaidAmount = $totalPaidAmount + $orderProcessTableDetails[$key2]['paid_amount'];
                }

                $addNew = 1;
                foreach ($result as $i => $value) {
                    if ($customerTableDetails[$key]['id'] == $result[$i]['customer_id']) {
                        $foundInArrayIndex = $i;
                        $addNew = 0;
                    }
                }

                if ($addNew == 1) {
                    $newItem = array(
                        "customer_id" => $customerTableDetails[$key]['id'],
                        "customer_name" => $customerTableDetails[$key]['name'],
                        "number_of_order" => 1,
                        "total_bill" => $orderProcessTableDetails[$key2]['total_bill'],
                        "total_paid_amount" => $orderProcessTableDetails[$key2]['paid_amount'],
                        "grand_total_bill" => 0,
                        "grand_paid_amount" => 0
                    );
                    array_push($result, $newItem);
                } else {
                    $result[$foundInArrayIndex]['number_of_order'] = $result[$foundInArrayIndex]['number_of_order'] + 1;
                    $result[$foundInArrayIndex]['total_bill'] = $result[$foundInArrayIndex]['total_bill'] + $orderProcessTableDetails[$key2]['total_bill'];
                    $result[$foundInArrayIndex]['total_paid_amount'] = $result[$foundInArrayIndex]['total_paid_amount'] + $orderProcessTableDetails[$key2]['paid_amount'];
                }
            }
        }
    }

    foreach ($result as $key => $value) {
        $result[$key]['grand_total_bill'] = $totalBill;
        $result[$key]['grand_paid_amount'] = $totalPaidAmount;
    }

    return $result;
    //var_dump($result);
}

function getItemwiseSalesReport($productId = 0, $subBranchId = 0, $fromDate = null, $toDate = null)
{
    global $con;
    // $productId = $_REQUEST['productId'];
    // $subBranchId = $_REQUEST['subBranchId']; //give zero if needed for all
    // $fromDate = $_REQUEST['fromDate'] . " 00:00:00";
    // $toDate = $_REQUEST['toDate'] . " 23:59:59";

    if ($fromDate == null) {
        $fromDate = date("Y-m-d 00:00:00");
    } else {
        $fromDate = $fromDate . " 00:00:00";
    }

    if ($toDate == null) {
        $toDate = date("Y-m-d 23:59:59");
    } else {
        $toDate = $toDate . " 23:59:59";
    }

    if ($subBranchId > 0) {
        $subBranchQuery =  "AND sub_branch_id = '$subBranchId'";
    } else {
        $subBranchQuery = "";
    }

    if ($productId > 0) {
        $productQuery = "AND product_id = '$productId'";
    } else {
        $productQuery = "";
    }

    $orderUniqueIdArray = array();
    $orderedItemArray = array();
    $finalProductsArray = array();
    $j = 1;

    $orderProcessTable = getAllDataOfOrderProcessTable(" AND status <> 7 AND order_time BETWEEN '$fromDate' AND '$toDate' $subBranchQuery");


    foreach ($orderProcessTable as $key => $value) {
        if (($orderProcessTable[$key]['table_id'] == 0 && $orderProcessTable[$key]['status'] == 6) || ($orderProcessTable[$key]['table_id'] > 0 && $orderProcessTable[$key]['status'] >= 4)) {
            array_push($orderUniqueIdArray, $orderProcessTable[$key]['unique_order_id']);
        }
    }

    foreach ($orderUniqueIdArray as $key => $value) {
        $query2 = $con->query("select * from order_items WHERE status > 0 AND unique_order_id = '" . $orderUniqueIdArray[$key] . "' $productQuery ORDER BY product_id");



        while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
            $productId = $row2['product_id'];
            $productSizeId = $row2['product_size_id'];
            $productQuantity = $row2['product_quantity'];
            $productTotalPrice = $row2['product_total_price'];

            if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
                $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
                $productTotalPrice = ($percent * $productTotalPrice) / 100;
            }


            $addNew = 1;


            foreach ($finalProductsArray as $i => $value) {
                if ($productId == $finalProductsArray[$i]['product_id']) {
                    if ($productSizeId == $finalProductsArray[$i]['product_size_id']) {
                        $foundInArrayIndex = $i;
                        $addNew = 0;
                    }
                }
            }

            if ($addNew == 1) {
                //echo "order N0: ".$row2['id']."<br>";
                $productDetails = getProductDetailsFromId($productId);
                $productName = $productDetails['name'];

                $productSizeDetails = getProductSizeDetailsFromProductSizeId($productSizeId);
                $productSizeName = $productSizeDetails['name'];


                $newItem = array(
                    "product_id" => "$productId",
                    "product_name" => "$productName",
                    "product_size_id" => "$productSizeId",
                    "product_size_name" => "$productSizeName",
                    "quantity" => "$productQuantity",
                    "product_price" => "$productTotalPrice"
                );

                array_push($finalProductsArray, $newItem);
            } else {
                $finalProductsArray[$foundInArrayIndex]['quantity'] = $finalProductsArray[$foundInArrayIndex]['quantity'] + $productQuantity;
                $finalProductsArray[$foundInArrayIndex]['product_price'] = $finalProductsArray[$foundInArrayIndex]['product_price'] + $productTotalPrice;
            }
        }
    }

    $indexKey = array_column($finalProductsArray, 'product_name');

    array_multisort($indexKey, SORT_ASC, $finalProductsArray);

    return $finalProductsArray;
}

function getItemwisePurchaseReport($ingredientId = 0, $subBranchId = 0, $fromDate = null, $toDate = null)
{

    global $con;
    $result = array();


    if ($fromDate == null) {
        $fromDate = date("Y-m-d 00:00:00");
    } else {
        $fromDate = $fromDate . " 00:00:00";
    }

    if ($toDate == null) {
        $toDate = date("Y-m-d 23:59:59");
    } else {
        $toDate = $toDate . " 23:59:59";
    }

    if ($subBranchId > 0) {
        $subBranchQuery =  "AND sub_branch_id = '$subBranchId'";
    } else {
        $subBranchQuery = "";
    }

    if ($ingredientId > 0) {
        $ingredientQuery = "AND ingredient_id = '$ingredientId'";
    } else {
        $ingredientQuery = "";
    }



    $stockTableData = getAllDataOfStockTable(" AND purchase_date BETWEEN '$fromDate' AND '$toDate' $ingredientQuery $subBranchQuery");




    foreach ($stockTableData as $key => $value) {
        $purchasedAmount = 0;
        $ingredientUnitPrice = 0;
        $productDetails = getAllDataOfPurchaseDetailsTableFromPurchaseUniqueId($stockTableData[$key]['unique_purchase_id'], " $ingredientQuery");
        $ingredientUnitPrice = $stockTableData[$key]['ingredient_unit_price'];

        if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
            $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
            $ingredientUnitPrice = ($percent * $ingredientUnitPrice) / 100;
        }

        foreach ($productDetails as $key2 => $value2) {
            $purchasedAmount = $purchasedAmount + $productDetails[$key2]['ingredient_amount'];
            $ingDetails = getIngredientDetailsFromId($stockTableData[$key]['ingredient_id']);

            $newItem = array(
                "ingredient_id" => $stockTableData[$key]['ingredient_id'],
                "ingredient_name" => $ingDetails['ingredient_name'],
                "purchase_date" => $stockTableData[$key]['purchase_date'],
                "purchase_amount" => $purchasedAmount . " " . getDefaultWeightInNameFromIngredientId($stockTableData[$key]['ingredient_id']),
                "ingredient_unit_price" => $ingredientUnitPrice,
                "ingredient_price" => round($purchasedAmount * $ingredientUnitPrice, 2),
                "current_stock" => $stockTableData[$key]['ingredient_amount'] . " " . getDefaultWeightInNameFromIngredientId($stockTableData[$key]['ingredient_id'])
            );
            array_push($result, $newItem);
        }
    }

    return $result;
}


//orderCountReport($subBranchId = null, '2021-06-01', '2021-06-15');
function orderCountReport($subBranchId = null, $fromDate = null, $toDate = null)
{
    global $con;


    $result = array();
    $totalBill = 0;
    $totalOrder = 0;

    if ($fromDate == null) {
        $fromDate = date("Y-m-d 00:00:00");
    } else {
        $fromDate = $fromDate . " 00:00:00";
    }

    if ($toDate == null) {
        $toDate = date("Y-m-d 23:59:59");
    } else {
        $toDate = $toDate . " 23:59:59";
    }

    if ($subBranchId == null) {
        $subBranchIdQuery = "";
    } else {
        $subBranchIdQuery = " AND id = '$subBranchId'";
    }

    $subBranchTableDetails = getAllDataOfSubBranchTable($subBranchIdQuery);




    foreach ($subBranchTableDetails as $key => $value) {
        $orderProcessTableDetails = getAllDataOfOrderProcessTable(" AND status <> 7 AND order_time BETWEEN '$fromDate' AND '$toDate' AND sub_branch_id = '" . $subBranchTableDetails[$key]['id'] . "'");

        foreach ($orderProcessTableDetails as $key2 => $value) {
            if ((($orderProcessTableDetails[$key2]['table_id'] == 0) && ($orderProcessTableDetails[$key2]['status'] == 6)) || (($orderProcessTableDetails[$key2]['table_id'] > 0) && ($orderProcessTableDetails[$key2]['status'] >= 4))) {
                $addNew = 1;
                foreach ($result as $i => $value) {
                    if ($subBranchTableDetails[$key]['id'] == $result[$i]['sub_branch_id']) {
                        $foundInArrayIndex = $i;
                        $addNew = 0;
                    }
                }
                $totalBill = $orderProcessTableDetails[$key2]['total_bill'];
                if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
                    $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
                    $totalBill = round(($percent * $totalBill) / 100);
                }
                if ($addNew == 1) {
                    $newItem = array(
                        "sub_branch_id" => $subBranchTableDetails[$key]['id'],
                        "sub_branch_name" => $subBranchTableDetails[$key]['name'],
                        "total_orders" => 1,
                        "total_bill" => $totalBill,
                    );
                    array_push($result, $newItem);
                } else {
                    $result[$foundInArrayIndex]['total_bill'] = $result[$foundInArrayIndex]['total_bill'] + $totalBill;
                    $result[$foundInArrayIndex]['total_orders'] = $result[$foundInArrayIndex]['total_orders'] + 1;
                }
            }
        }
    }
    //var_dump($result);
    return $result;
    //var_dump($result);


}


function getProductPriceFromSizeId($sizeId)
{
    global $con;

    $query = $con->query("select * from product_size WHERE id = '$sizeId'");

    $row = mysqli_fetch_array($query);

    $currentDate = date("Y-m-d H:i:s");

    if ($row['special_price_from'] < $currentDate && $row['special_price_to'] > $currentDate) {
        return $row['special_price'];
    } else {
        return $row['selling_price'];
    }
}


function getProductOptionPriceFromOptionId($optionId)
{
    global $con;

    $query = $con->query("select * from product_option WHERE id = '$optionId'");

    $row = mysqli_fetch_array($query);

    $currentDate = date("Y-m-d H:i:s");

    if ($row['offer_money_from'] < $currentDate && $row['offer_money_to'] > $currentDate) {
        return $row['offer_money_added'];
    } else {
        return $row['extra_money_added'];
    }
}


function getProductAddonPriceFromAddonId($addonId)
{
    global $con;

    $query = $con->query("select * from product_addons WHERE id = '$addonId'");

    $row = mysqli_fetch_array($query);

    $currentDate = date("Y-m-d H:i:s");

    if ($row['offer_money_from'] < $currentDate && $row['offer_money_to'] > $currentDate) {
        return $row['offer_money_added'];
    } else {
        return $row['extra_money_added'];
    }
}

function getUnitPriceFromIngredientId($ingredientId, $neededAmount = 0)
{
    global $con;
    $addedAmount = 0;
    $priceFound = 0;
    $query = $con->query("SELECT * from stock WHERE status > 0 AND ingredient_id = '$ingredientId' AND ingredient_amount > 0 ORDER BY purchase_date ASC");
    while ($row = mysqli_fetch_array($query)) {

        $remainingAmount = $neededAmount - $addedAmount;

        if ($addedAmount < $neededAmount) {
            if ($row['ingredient_amount'] >= $addedAmount) {
                //$neededAmount = $neededAmount - $neededAmount;
                $priceFound = $priceFound + ($remainingAmount * $row['ingredient_unit_price']);
                $remainingAmount = 0;
                $addedAmount = $neededAmount;
                break;
            } else {
                $priceFound = $priceFound + ($row['ingredient_amount'] * $row['ingredient_unit_price']);
                $remainingAmount = $neededAmount - $row['ingredient_amount'];
                $addedAmount = $row['ingredient_amount'];
            }
        }
    }

    return $priceFound;
}


function getProductionCostPerUnitOfSessionProductFromId($productId)
{
    global $con;
    $totalCost = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($productId == $_SESSION['cart'][$key]['product_id']) {
            $productIngredients = getAllDataOfProductIngredientTableFromProductSizeId($_SESSION['cart'][$key]['product_size_id']);
            $totalCost = 0;
            foreach ($productIngredients as $key2 => $value) {
                $neededAmount = $productIngredients[$key2]['ingredient_amount'];
                $unitPrice = getUnitPriceFromIngredientId($productIngredients[$key2]['ingredient_id'], $neededAmount);
                $totalCost = $totalCost + ($unitPrice * $neededAmount);
            }

            if (count($_SESSION['cart'][$key]['product_option_ids']) > 0) {
                $optionIds = $_SESSION['cart'][$key]['product_option_ids'];
                foreach ($optionIds as $key3 => $value) {
                    $optionDetails = getAllDataOfProductOptionIngredientTableFromProductOptionId($optionIds[$key3]);
                    foreach ($optionDetails as $key4 => $value) {
                        $neededAmount = $optionDetails[$key4]['ingredient_amount'];
                        $unitPrice = getUnitPriceFromIngredientId($optionDetails[$key4]['ingredient_id'], $neededAmount);
                        $totalCost = $totalCost + ($unitPrice * $neededAmount);
                    }
                }
            }

            if (count($_SESSION['cart'][$key]['product_addon_ids']) > 0) {
                $addonIds = $_SESSION['cart'][$key]['product_addon_ids'];
                foreach ($addonIds as $key5 => $value) {
                    $addonDetails = getDetailsOfProductAddonIngredientTableFromProductAddonId($addonIds[$key5]);
                    foreach ($addonDetails as $key6 => $value) {
                        $neededAmount = $addonDetails[$key6]['ingredient_amount'];
                        $unitPrice = getUnitPriceFromIngredientId($addonDetails[$key6]['ingredient_id'], $neededAmount);
                        $totalCost = $totalCost + ($unitPrice * $neededAmount);
                    }
                }
            }


            if (count($_SESSION['cart'][$key]['sub_category_addon_ids']) > 0) {
                $subCategoryAddonIds = $_SESSION['cart'][$key]['sub_category_addon_ids'];
                foreach ($subCategoryAddonIds as $key7 => $value) {
                    $subCategoryAddonDetails = getDetailsOfSubCategoryAddonIngredientTableFromSubCategoryAddonId($subCategoryAddonIds[$key7]);
                    foreach ($subCategoryAddonDetails as $key8 => $value) {
                        $neededAmount = $subCategoryAddonDetails[$key8]['ingredient_amount'];
                        $unitPrice = getUnitPriceFromIngredientId($subCategoryAddonDetails[$key8]['ingredient_id'], $neededAmount);
                        $totalCost = $totalCost + ($unitPrice * $neededAmount);
                    }
                }
            }

            break;
        }
    }

    return $totalCost;
}

function getProductionCostPerUnitOfSessionProductFromIdPos($productId, $sessionName)
{
    global $con;
    $totalCost = 0;
    foreach ($_SESSION[$sessionName] as $key => $value) {
        if ($productId == $_SESSION[$sessionName][$key]['product_id']) {
            $productIngredients = getAllDataOfProductIngredientTableFromProductSizeId($_SESSION[$sessionName][$key]['product_size_id']);
            $totalCost = 0;
            foreach ($productIngredients as $key2 => $value) {
                $neededAmount = $productIngredients[$key2]['ingredient_amount'];
                $unitPrice = getUnitPriceFromIngredientId($productIngredients[$key2]['ingredient_id'], $neededAmount);
                $totalCost = $totalCost + ($unitPrice * $neededAmount);
            }

            if (count($_SESSION[$sessionName][$key]['product_option_ids']) > 0) {
                $optionIds = $_SESSION[$sessionName][$key]['product_option_ids'];
                foreach ($optionIds as $key3 => $value) {
                    $optionDetails = getAllDataOfProductOptionIngredientTableFromProductOptionId($optionIds[$key3]);
                    foreach ($optionDetails as $key4 => $value) {
                        $neededAmount = $optionDetails[$key4]['ingredient_amount'];
                        $unitPrice = getUnitPriceFromIngredientId($optionDetails[$key4]['ingredient_id'], $neededAmount);
                        $totalCost = $totalCost + ($unitPrice * $neededAmount);
                    }
                }
            }

            if (count($_SESSION[$sessionName][$key]['product_addon_ids']) > 0) {
                $addonIds = $_SESSION[$sessionName][$key]['product_addon_ids'];
                foreach ($addonIds as $key5 => $value) {
                    $addonDetails = getDetailsOfProductAddonIngredientTableFromProductAddonId($addonIds[$key5]);
                    foreach ($addonDetails as $key6 => $value) {
                        $neededAmount = $addonDetails[$key6]['ingredient_amount'];
                        $unitPrice = getUnitPriceFromIngredientId($addonDetails[$key6]['ingredient_id'], $neededAmount);
                        $totalCost = $totalCost + ($unitPrice * $neededAmount);
                    }
                }
            }


            if (count($_SESSION[$sessionName][$key]['sub_category_addon_ids']) > 0) {
                $subCategoryAddonIds = $_SESSION[$sessionName][$key]['sub_category_addon_ids'];
                foreach ($subCategoryAddonIds as $key7 => $value) {
                    $subCategoryAddonDetails = getDetailsOfSubCategoryAddonIngredientTableFromSubCategoryAddonId($subCategoryAddonIds[$key7]);
                    foreach ($subCategoryAddonDetails as $key8 => $value) {
                        $neededAmount = $subCategoryAddonDetails[$key8]['ingredient_amount'];
                        $unitPrice = getUnitPriceFromIngredientId($subCategoryAddonDetails[$key8]['ingredient_id'], $neededAmount);
                        $totalCost = $totalCost + ($unitPrice * $neededAmount);
                    }
                }
            }

            break;
        }
    }

    return $totalCost;
}

function getStartingPriceFromProductId($productId)
{
    global $con;
    $priceFound = 0;
    $currentDate = date("Y-m-d H:i:s");
    $query = $con->query("SELECT * from product_size WHERE status > 0 AND product_id = '$productId' ORDER BY selling_price ASC");
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 1) {
            $priceFound = $row['selling_price'];
        }

        if ($row['special_price_from'] < $currentDate && $row['special_price_to'] > $currentDate) {
            if ($priceFound > $row['special_price']) {
                $priceFound = $row['special_price'];
            }
        } else {
            if ($priceFound > $row['selling_price']) {
                $priceFound = $row['selling_price'];
            }
        }

        $i++;
    }

    return $priceFound;
}

function getAllDataOfProductOptionTableFromProductTitleIdAndProductSizeId($titleId, $sizeId)
{
    global $con;
    $result = array();

    $query = $con->query("select * from product_option WHERE status > 0 AND product_size_id = '$sizeId' AND product_title_id = '$titleId' ORDER BY id DESC");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getAllDataOfProductOptionTableFromProductOptionId($id)
{
    global $con;

    $query = $con->query("select * from product_option WHERE status > 0 AND id= '$id'");


    $row = mysqli_fetch_array($query);

    return $row;
}


function getAllDataOfProductAddonTableFromProductAddonId($id)
{
    global $con;

    $query = $con->query("select * from product_addons WHERE status > 0 AND id= '$id'");


    $row = mysqli_fetch_array($query);

    return $row;
}


function deductIngredientsAmountFromStockFromUniqueOrderId($branchId, $subBranchId, $uniqueOrderId, $specialQuery)
{
    global $con;

    $query = $con->query("select * from order_items WHERE status > 0 AND unique_order_id = '$uniqueOrderId' '$specialQuery'");

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        for ($i = 1; $i <= intval($row['product_quantity']); $i++) {
            $productId =  $row['product_id'];
            $productSizeId =  $row['product_size_id'];
            $query2 = $con->query("select * from product_ingredients WHERE status > 0 AND product_id = '$productId' AND  product_size_id = '$productSizeId'");

            while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
                $ingredientId = $row2['ingredient_id'];
                $neededAmount = $row2['ingredient_amount'];

                $query3 = $con->query("select * from stock WHERE status > 0 AND branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND ingredient_id = '$ingredientId' AND ingredient_amount > 0 ORDER BY purchase_date DESC");

                $addedAmount = 0;
                $remainingAmount = $neededAmount - $addedAmount;

                while ($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
                    $rowId = $row3['id'];


                    if ($addedAmount < $neededAmount) {
                        if ($row3['ingredient_amount'] >= $remainingAmount) {
                            $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$remainingAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                            $con->query($sql);
                            $remainingAmount = 0;
                            $addedAmount = $neededAmount;
                            break;
                        } else {
                            $remainingAmount = $neededAmount - $row3['ingredient_amount'];
                            $addedAmount = $row3['ingredient_amount'];
                            $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$addedAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                            $con->query($sql);
                        }
                    }
                }
            }

            $productOptionIds = unserialize($row['product_option_ids']);
            $productAddonIds = unserialize($row['product_addon_ids']);
            $subCategoryAddonIds = unserialize($row['sub_category_addon_ids']);


            if (count($productOptionIds) > 0) {
                foreach ($productOptionIds as $key => $value) {
                    $query4 = $con->query("select * from product_option_ingredients WHERE status > 0 AND product_option_id = '$productOptionIds[$key]'");
                    while ($row4 = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
                        $ingredientId = $row4['ingredient_id'];
                        $neededAmount = $row4['ingredient_amount'];

                        $query3 = $con->query("select * from stock WHERE status > 0 AND branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND ingredient_id = '$ingredientId' AND ingredient_amount > 0 ORDER BY  purchase_date DESC");

                        $addedAmount = 0;
                        $remainingAmount = $neededAmount - $addedAmount;

                        while ($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
                            $rowId = $row3['id'];


                            if ($addedAmount < $neededAmount) {
                                if ($row3['ingredient_amount'] >= $remainingAmount) {
                                    $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$remainingAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                                    $con->query($sql);
                                    $remainingAmount = 0;
                                    $addedAmount = $neededAmount;
                                    break;
                                } else {
                                    $remainingAmount = $neededAmount - $row3['ingredient_amount'];
                                    $addedAmount = $row3['ingredient_amount'];
                                    $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$addedAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                                    $con->query($sql);
                                }
                            }
                        }
                    }
                }
            }
            if (count($productAddonIds) > 0) {
                foreach ($productAddonIds as $key2 => $value2) {

                    $query4 = $con->query("select * from product_addons_ingredients WHERE status > 0 AND product_addon_id = '$productOptionIds[$key2]'");
                    while ($row4 = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
                        $ingredientId = $row4['ingredient_id'];
                        $neededAmount = $row4['ingredient_amount'];

                        $query3 = $con->query("select * from stock WHERE status > 0 AND branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND ingredient_id = '$ingredientId' AND ingredient_amount > 0 ORDER BY  purchase_date DESC");

                        $addedAmount = 0;
                        $remainingAmount = $neededAmount - $addedAmount;

                        while ($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
                            $rowId = $row3['id'];


                            if ($addedAmount < $neededAmount) {
                                if ($row3['ingredient_amount'] >= $remainingAmount) {
                                    $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$remainingAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                                    $con->query($sql);
                                    $remainingAmount = 0;
                                    $addedAmount = $neededAmount;
                                    break;
                                } else {
                                    $remainingAmount = $neededAmount - $row3['ingredient_amount'];
                                    $addedAmount = $row3['ingredient_amount'];
                                    $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$addedAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                                    $con->query($sql);
                                }
                            }
                        }
                    }
                }
            }
            if (count($subCategoryAddonIds) > 0) {
                foreach ($subCategoryAddonIds as $key3 => $value2) {

                    $query4 = $con->query("select * from sub_category_addons_ingredients WHERE status > 0 AND sub_category_addon_id = '$productOptionIds[$key3]'");
                    while ($row4 = mysqli_fetch_array($query4, MYSQLI_ASSOC)) {
                        $ingredientId = $row4['ingredient_id'];
                        $neededAmount = $row4['ingredient_amount'];

                        $query3 = $con->query("select * from stock WHERE status > 0 AND branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND ingredient_id = '$ingredientId' AND ingredient_amount > 0 ORDER BY  purchase_date DESC");

                        $addedAmount = 0;
                        $remainingAmount = $neededAmount - $addedAmount;

                        while ($row3 = mysqli_fetch_array($query3, MYSQLI_ASSOC)) {
                            $rowId = $row3['id'];


                            if ($addedAmount < $neededAmount) {
                                if ($row3['ingredient_amount'] >= $remainingAmount) {
                                    $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$remainingAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                                    $con->query($sql);
                                    $remainingAmount = 0;
                                    $addedAmount = $neededAmount;
                                    break;
                                } else {
                                    $remainingAmount = $neededAmount - $row3['ingredient_amount'];
                                    $addedAmount = $row3['ingredient_amount'];
                                    $sql = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$addedAmount'), 3) WHERE `stock`.`id` = '$rowId'";
                                    $con->query($sql);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


function getValueFromExtraTableByItemName($itemName)
{
    global $con;
    $query = $con->query("select * from extra WHERE item_name = '$itemName'");


    $row = mysqli_fetch_array($query);

    return $row['item_value'];
}

//getClientDetailsFromUniqueOrderId("16098396214241");
function getClientDetailsFromUniqueOrderId($uniqueOrderId, $specialQuery = "")
{
    global $con;
    $query = $con->query("select * from order_process WHERE unique_order_id = '$uniqueOrderId' " . $specialQuery);
    $row = mysqli_fetch_array($query);

    $query2 = $con->query("select * from client WHERE id = " . $row['client_id']);
    $row2 = mysqli_fetch_array($query2);
    return $row2;
    //print_r($row2);
}

function getOrderProcessDetailsFromUniqueOrderId($uniqueOrderId)
{
    global $con;
    $query = $con->query("select * from order_process WHERE unique_order_id=" . $uniqueOrderId);
    $row = mysqli_fetch_array($query);
    return $row;

    // $someVariable = getSubBranchDetailsFromId("1");

    // echo $someVariable['name'];
}


function getProductAddonDetailsFromAddonId($addonId)
{
    global $con;
    $query = $con->query("select * from product_addons WHERE id=" . $addonId);
    $row = mysqli_fetch_array($query);
    return $row;

    // $someVariable = getSubBranchDetailsFromId("1");

    // echo $someVariable['name'];
}

function getSubCategoryAddonDetailsFromSubCategoryAddonId($addonId)
{
    global $con;
    $query = $con->query("select * from sub_category_addons WHERE id=" . $addonId);
    $row = mysqli_fetch_array($query);
    return $row;

    // $someVariable = getSubBranchDetailsFromId("1");

    // echo $someVariable['name'];
}


function checkIfAValueExistsInARowOfATable($value, $rowName, $tableName)
{
    global $con;

    $sql = "select * from `" . $tableName . "` WHERE `" . $rowName . "` = '" . $value . "'";

    if (mysqli_num_rows($con->query($sql)) > 0) {
        $row = mysqli_fetch_array($con->query($sql));
        return $row['id'];
    } else {
        return 0;
    }
}

function pageViewIncrement($identifierName)
{
    global $con;

    // Get IP address
    $ip_address = get_client_ip();

    $ip = $ip_address;
    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
    $city =  $details->city;
    $region = $details->region;
    $location = $details->loc;
    $country = $details->country;

    // $idToUpdate = checkIfAValueExistsInARowOfATable($identifierName, 'identifer_name', 'simplified_viewcount');

    // if ($idToUpdate > 0) {
    //     $sql = "UPDATE `simplified_viewcount` SET `view_count` = `view_count`+1 WHERE `simplified_viewcount`.`id` = '$idToUpdate'";
    //     $con->query($sql);
    // }else {
    //     $sql = "INSERT INTO `simplified_viewcount` (`identifer_name`) VALUES ('$identifierName')";
    //     $con->query($sql);
    // }


    $sql = "INSERT INTO `viewcount` (`identifer_name`, `visittime`, `ip`, `city`, `region`, `location`, `country`) VALUES ('$identifierName', current_timestamp(), '$ip_address', '$city', '$region', '$location', '$country')";

    $con->query($sql);
}

// Function to get the client IP address
// echo get_client_ip();
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';

    $ipaddress = $_SERVER['REMOTE_ADDR'];


    // if ($ipaddress == "::1") {
    //     $ipaddress = "163.53.183.217";
    // }
    return $ipaddress;
}

function getViewCountOfPage()
{
    global $con;
    $visitList = array();
    $j = 1;
    $query = $con->query("select * from viewcount WHERE char_length(identifer_name)<12 AND char_length(identifer_name)>0 AND identifer_name NOT REGEXP '[^a-zA-Z0-9]' ORDER BY id asc");
    $currentIdentifer = "";
    while ($row = mysqli_fetch_array($query)) {
        if ($row['identifer_name'] == "menu" || $row['identifer_name'] == "home" || $row['identifer_name'] == "events" || $row['identifer_name'] == "checkout" || (intval($row['identifer_name']) > 0 && intval($row['identifer_name']) < 500)) {
            if ($j == 1) {
                $currentIdentifer = $row['identifer_name'];
                $newItem = array(
                    "identifer_name" => $row['identifer_name'],
                    "views" => "1"
                );

                array_push($visitList, $newItem);
            } else {
                $foundNew = 1;
                $currentIdentifer = $row['identifer_name'];
                foreach ($visitList as $i => $value) {
                    if ($currentIdentifer == $visitList[$i]['identifer_name']) {
                        $foundInArrayIndex = $i;
                        $foundNew = 0;
                    }
                }

                if ($foundNew) {
                    $newItem = array(
                        "identifer_name" => $row['identifer_name'],
                        "views" => "1"
                    );
                    array_push($visitList, $newItem);
                } else {
                    $visitList[$foundInArrayIndex]['views'] = $visitList[$foundInArrayIndex]['views'] + 1;
                }
            }
            $j++;
        }
    }


    $keys = array_column($visitList, 'views');

    array_multisort($keys, SORT_DESC, $visitList);

    return $visitList;
}

function getViewCountOfProduct()
{
    global $con;
    $visitList = array();
    $j = 1;
    $specialQuery = "AND identifer_name != ('home' or 'menu' or 'checkout' or 'events')";
    $query = $con->query("select * from viewcount WHERE char_length(identifer_name)<12 AND char_length(identifer_name)>0 AND identifer_name NOT REGEXP '[^a-zA-Z0-9]' $specialQuery ORDER BY id asc");
    $currentIdentifer = "";
    while ($row = mysqli_fetch_array($query)) {
        if ($row['identifer_name'] == "menu" || $row['identifer_name'] == "home" || $row['identifer_name'] == "events" || $row['identifer_name'] == "checkout" || (intval($row['identifer_name']) > 0 && intval($row['identifer_name']) < 500)) {
            if ($j == 1) {
                $currentIdentifer = $row['identifer_name'];
                $newItem = array(
                    "identifer_name" => $row['identifer_name'],
                    "views" => "1"
                );

                array_push($visitList, $newItem);
            } else {
                $foundNew = 1;
                $currentIdentifer = $row['identifer_name'];
                foreach ($visitList as $i => $value) {
                    if ($currentIdentifer == $visitList[$i]['identifer_name']) {
                        $foundInArrayIndex = $i;
                        $foundNew = 0;
                    }
                }

                if ($foundNew) {
                    $newItem = array(
                        "identifer_name" => $row['identifer_name'],
                        "views" => "1"
                    );
                    array_push($visitList, $newItem);
                } else {
                    $visitList[$foundInArrayIndex]['views'] = $visitList[$foundInArrayIndex]['views'] + 1;
                }
            }
            $j++;
        }
    }


    $keys = array_column($visitList, 'views');

    array_multisort($keys, SORT_DESC, $visitList);

    return $visitList;
}



function getViewCountDetails($specialQuery = "")
{
    global $con;
    $query = "";
    if ($specialQuery == "") {
        $query = $con->query("select * from cronjobs WHERE status > 0 AND id= '2'");
    } else {
        $query = $con->query("select * from cronjobs WHERE status > 0 AND id= '3'");
    }
    $row = mysqli_fetch_array($query);
    $data = unserialize($row['value']);
    return $data;
}


function groupOptionNameByOptionTitleFromOptionIds($optionIds = array())
{
    global $con;
    $groupedOptionNames = array();
    $j = 1;
    foreach ($optionIds as $key => $value) {

        $optionDetails = getDetailsOfProductOptionTableFromId($optionIds[$key]);
        $titleId = $optionDetails['product_title_id'];
        $titleDetails = getProductOptionTitleDetailsFromProductTitleId($titleId);
        $titleName = $titleDetails['title'];

        if ($j == 1) {
            $foundNew = 1;
        } else {
            foreach ($groupedOptionNames as $i => $value) {
                if ($titleId == $groupedOptionNames[$i]['title_id']) {
                    $foundInArrayIndex = $i;
                    $foundNew = 0;
                } else {
                    $foundNew = 1;
                }
            }
        }



        if ($foundNew) {
            $newItem = array(
                "title_id" => $titleId,
                "title_name" => $titleName,
                "option_id" => $optionIds[$key],
                "option_name" => $optionDetails['name']
            );
            array_push($groupedOptionNames, $newItem);
        } else {
            $groupedOptionNames[$foundInArrayIndex]['option_id'] = $groupedOptionNames[$foundInArrayIndex]['option_id'] . ", " . $optionIds[$key];
            $groupedOptionNames[$foundInArrayIndex]['option_name'] = $groupedOptionNames[$foundInArrayIndex]['option_name'] . ", " . $optionDetails['name'];
        }

        $j++;
    }

    return $groupedOptionNames;
    //print_r($groupedOptionNames);
}


function getFreeOptionLimitFromProductOptionTitleId($id, $specialQuery = "")
{
    global $con;
    $query = $con->query("select * from product_option_title WHERE id = '$id'" . $specialQuery);
    $row = mysqli_fetch_array($query);
    return $row['free_option_limit'];
}



function getTodaysSalesDataFromSubBranchId($subBranchId, $specialQuery = "")
{
    global $con;
    $todaysDate = date('Y-m-d 00:00:00');
    $currentDate = date('Y-m-d H:i:s');
    $totalSales = 0;

    $orderTableDetails = getAllDataOfOrderProcessTable(" AND status < 7 and order_time between '$todaysDate' and '$currentDate' and sub_branch_id = '$subBranchId'" . $specialQuery);
    foreach ($orderTableDetails as $key => $value) {

        if ((($orderTableDetails[$key]['table_id'] == 0) && ($orderTableDetails[$key]['status'] == 6)) || (($orderTableDetails[$key]['table_id'] > 0) && ($orderTableDetails[$key]['status'] >= 4))) {
            $sales = floatval($orderTableDetails[$key]['total_bill']);
            $totalSales += $sales;
        } else {
            // $totalSales ="bullshit";
        }
    }

    return $totalSales;
}

function getLastDate($dayCount)
{
    $now = new DateTime($dayCount . " days ago");
    $interval = new DateInterval('P1D'); // 1 Day interval
    $period = new DatePeriod($now, $interval, 7); // 7 Days

    $datesHere = array();
    foreach ($period as $day) {
        // $key = $day->format('Y-m-d');
        // $datesHere[$key] = 0;
        array_push($datesHere, $day->format('Y-m-d'));
    }

    return json_encode($datesHere);
}



function getSalesDataFromDaysCount($dayCount, $specialQuery = "")
{

    $now = new DateTime($dayCount . " days ago");
    $interval = new DateInterval('P1D'); // 1 Day interval
    $period = new DatePeriod($now, $interval, $dayCount); // 7 Days

    $datesHere = array();
    foreach ($period as $day) {
        // $key = $day->format('Y-m-d');
        // $datesHere[$key] = 0;
        array_push($datesHere, $day->format('Y-m-d'));
    }


    $totalSales = 0;
    $salesData = array();

    foreach ($datesHere as $sdk => $value) {
        $changedDateFrom =  $datesHere[$sdk] . " 00:00:00";
        $changeDateTo = $datesHere[$sdk] . " 23:59:59";

        $result = getAllDataOfOrderProcessTable(" AND status < 7 and order_time between '$changedDateFrom' AND '$changeDateTo' " . $specialQuery);
        foreach ($result as $key => $value) {

            if ((($result[$key]['table_id'] == 0) && ($result[$key]['status'] == 6)) || (($result[$key]['table_id'] > 0) && ($result[$key]['status'] >= 4))) {
                $sales = floatval($result[$key]['total_bill']);
                $totalSales += $sales;
            } else {
                // $totalSales ="bullshit";
            }
        }
        //echo $changedDateFrom . "->" . $changeDateTo . "->" . $totalSales . "<br><br><br>";
        if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
            $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
            $totalSales = ($percent * $totalSales) / 100;
        }
        array_push($salesData, round($totalSales, 3));
        $totalSales = 0;
    }

    //print_r($salesData);

    return json_encode($salesData);
}



function getSalesDataFromMonthCount($monthCount)
{
    // $monthCount =6;
    $i = 0;
    $monthsData = [];
    $salesData = [];
    $currentMonth = date("m");

    $totalSales = 0;
    $changedDate = "";



    while ($i < $monthCount) {



        $changedMonthString = "-" . $i . " months";
        $changedDateFrom =  date("Y-m-01 00:00:00", strtotime($changedMonthString));
        $changeDateTo = date("Y-m-t 00:00:00", strtotime($changedMonthString));

        $result = getAllDataOfOrderProcessTable(" AND status < 7 and order_time between '$changedDateFrom' and '$changeDateTo'");
        foreach ($result as $key => $value) {

            if ((($result[$key]['table_id'] == 0) && ($result[$key]['status'] == 6)) || (($result[$key]['table_id'] > 0) && ($result[$key]['status'] >= 4))) {
                $sales = floatval($result[$key]['total_bill']);
                $totalSales += $sales;
            } else {
                // $totalSales ="bullshit";
            }
        }

        if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
            $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
            $totalSales = ($percent * $totalSales) / 100;
        }

        array_push($salesData, round($totalSales, 3));

        $totalSales = 0;



        $i++;
    }
    return json_encode($salesData);
}


function getPurchaseDataFromMonthCount($monthCount)
{
    // $monthCount =6;
    $i = 0;
    $monthsData = [];
    $purchaseData = [];
    $currentMonth = date("m");

    $totalPurchase = 0;
    $changedDate = "";



    while ($i < $monthCount) {



        $changedMonthString = "-" . $i . " months";
        $changedDateFrom =  date("Y-m-01 00:00:00", strtotime($changedMonthString));
        $changeDateTo = date("Y-m-t 00:00:00", strtotime($changedMonthString));

        $result = getAllDataOfPurchaseTable(" and created_at between '$changedDateFrom' and '$changeDateTo'");
        foreach ($result as $key => $value) {

            $purchase = floatval($result[$key]['total_purchased_amount']);
            $totalPurchase += $purchase;
        }
        if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
            $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
            $totalPurchase = ($percent * $totalPurchase) / 100;
        }
        array_push($purchaseData, round($totalPurchase, 3));
        $totalPurchase = 0;



        $i++;
    }
    return json_encode($purchaseData);
}


function getExpenseDataFromMonthCount($monthCount)
{
    // $monthCount =6;
    $i = 0;
    $monthsData = [];
    $expenseData = [];
    $currentMonth = date("m");

    $totalExpense = 0;
    $changedDate = "";



    while ($i < $monthCount) {



        $changedMonthString = "-" . $i . " months";
        $changedDateFrom =  date("Y-m-01 00:00:00", strtotime($changedMonthString));
        $changeDateTo = date("Y-m-t 00:00:00", strtotime($changedMonthString));

        $result = getAllDataOfExpenseDetailsTable(" and expense_time between '$changedDateFrom' and '$changeDateTo'");
        foreach ($result as $key => $value) {

            $expense = floatval($result[$key]['amount']);
            $totalExpense += $expense;
        }

        if ($_SESSION['user_type'] != 1 && $_SESSION['user_type'] != 6) {
            $percent = intval(getValueFromExtraTableByItemName('hiddenPercentage'));
            $totalExpense = ($percent * $totalExpense) / 100;
        }

        array_push($expenseData, round($totalExpense, 3));
        $totalExpense = 0;



        $i++;
    }
    return json_encode($expenseData);
}


function getAllDataOfExpenseNameTable($specialQuery)
{
    global $con;
    $result = array();

    $query = $con->query("select * from expense_name WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getExpenseNameTableDetailsFromId($id, $specialQuery = "")
{
    global $con;
    $query = $con->query("select * from expense_name WHERE id=" . $id . $specialQuery);
    $row = mysqli_fetch_array($query);
    return $row;
}

function getAllDataOfExpenseDetailsTable($specialQuery)
{
    global $con;
    $result = array();

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $query = $con->query("select * from expense_details WHERE " . $sessionQuery . " status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getExpenseDetailsTableDetailsFromId($id, $specialQuery = "")
{
    global $con;
    $query = $con->query("select * from expense_details WHERE id=" . $id . $specialQuery);
    $row = mysqli_fetch_array($query);
    return $row;
}

function getAllDataOfExpenseDetailsTableFromExpenseNameId($expenseNameId, $specialQuery = "")
{
    global $con;

    $result = array();

    $branchId = $_SESSION['user_branch_id'];
    //$subBranchId = $_SESSION['user_sub_branch_id'];

    if ($_SESSION['user_type'] == 1) {
        $sessionQuery = "";
    } else {
        $sessionQuery = "branch_id = '$branchId' AND";
    }

    $query = $con->query("select * from expense_details WHERE " . $sessionQuery . " status > 0 AND expense_name_id = '$expenseNameId'" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getDetailsOfSubCategoryAddonIngredientTableFromSubCategoryAddonId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from sub_category_addons_ingredients WHERE status > 0 AND sub_category_addon_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getAllDataOfSubCategoryAddonTableFromSubCategoryId($id)
{
    global $con;

    $result = array();

    $query = $con->query("select * from sub_category_addons WHERE status > 0 AND sub_category_id= '$id'");


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}


function getSubCategoryAddonPriceFromSubCategoryAddonId($addonId)
{
    global $con;

    $query = $con->query("select * from sub_category_addons WHERE id = '$addonId'");

    $row = mysqli_fetch_array($query);

    $currentDate = date("Y-m-d H:i:s");

    if ($row['offer_money_from'] < $currentDate && $row['offer_money_to'] > $currentDate) {
        return $row['offer_money_added'];
    } else {
        return $row['extra_money_added'];
    }
}

function getAllDataOfSubCategoryAddonTableFromSubCategoryAddonId($id)
{
    global $con;

    $query = $con->query("select * from sub_category_addons WHERE status > 0 AND id= '$id'");


    $row = mysqli_fetch_array($query);

    return $row;
}


function topSoldItemListMain($startingDate = "", $finishingDate = "", $specialQuery = "", $subBranchValue = false)
{
    global $con;
    $orderUniqueIdArray = array();
    $orderedItemArray = array();
    $j = 1;


    if ($subBranchValue) {
        $branchId = $_SESSION['user_branch_id'];
        $subBranchId = $_SESSION['user_sub_branch_id'];
        $sessionQuery = "branch_id = '$branchId' AND sub_branch_id = '$subBranchId' AND";
    } else {
        $sessionQuery = "";
    }

    if ($startingDate != "" && $finishingDate != "") {
        $timingQuery = " AND order_time BETWEEN '$startingDate' AND '$finishingDate'";
    } else {
        $timingQuery = "";
    }

    $query = $con->query("select * from order_process WHERE " . $sessionQuery . " status > 0 AND status < 7" . $timingQuery . $specialQuery);

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        //array_push($result, $row);
        if (($row['table_id'] == 0 && $row['status'] == 6) || ($row['table_id'] > 0 && $row['status'] >= 4)) {
            array_push($orderUniqueIdArray, $row['unique_order_id']);
        }
    }


    foreach ($orderUniqueIdArray as $key => $value) {
        $query2 = $con->query("select * from order_items WHERE status > 0 AND unique_order_id = '" . $orderUniqueIdArray[$key] . "' ORDER BY product_id ASC");

        while ($row2 = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
            if ($j == 1) {
                $currentProductId = $row2['product_id'];
                $productDetails = getProductDetailsFromId($row2['product_id']);
                $newItem = array(
                    "product_id" => $row2['product_id'],
                    "product_name" => $productDetails['name'],
                    "ordered_quantity" => $row2['product_quantity']
                );

                array_push($orderedItemArray, $newItem);
            } else {

                $foundNew = 1;
                $currentProductId = $row2['product_id'];
                foreach ($orderedItemArray as $i => $value) {
                    if ($currentProductId == $orderedItemArray[$i]['product_id']) {
                        $foundInArrayIndex = $i;
                        $foundNew = 0;
                    }
                }


                if ($foundNew) {
                    $currentProductId = $row2['product_id'];
                    $productDetails = getProductDetailsFromId($row2['product_id']);
                    if (!empty($productDetails) && $currentProductId != 0) {
                        $newItem = array(
                            "product_id" => $row2['product_id'],
                            "product_name" => $productDetails['name'],
                            "ordered_quantity" => $row2['product_quantity']
                        );

                        array_push($orderedItemArray, $newItem);
                    } else {
                    }
                } else {
                    $orderedItemArray[$foundInArrayIndex]['ordered_quantity'] = $orderedItemArray[$foundInArrayIndex]['ordered_quantity'] + $row2['product_quantity'];
                }
            }
            $j++;
        }
    }

    $indexKey = array_column($orderedItemArray, 'ordered_quantity');

    array_multisort($indexKey, SORT_DESC, $orderedItemArray);

    //print_r($orderedItemArray);
    return $orderedItemArray;
}


function topSoldItemList()
{
    global $con;

    $query = $con->query("select * from cronjobs WHERE status > 0 AND id= '1'");


    $row = mysqli_fetch_array($query);

    $data = unserialize($row['value']);

    return $data;
}


function totalServiceChargeFromFinalBill($totalBill, $servicePersentage, $taxPersentage)
{
    $withOutTax = ($totalBill / (1 + ($taxPersentage / 100)));
    $base = ($withOutTax / (1 + ($servicePersentage / 100)));
    $serviceCharge = $base * ($servicePersentage / 100);

    return $serviceCharge;
}

function totalVatFromFinalBill($totalBill, $taxPersentage)
{
    $withOutTax = ($totalBill / (1 + ($taxPersentage / 100)));
    $vat = $totalBill - $withOutTax;

    return $vat;
}

function basePriceFromFinalBill($totalBill, $servicePersentage, $taxPersentage)
{
    $withOutTax = ($totalBill / (1 + ($taxPersentage / 100)));
    $base = ($withOutTax / (1 + ($servicePersentage / 100)));

    return $base;
}

//checkIfAProductGotSizesAndOptions(10);
function checkIfAProductGotSizesAndOptions($productId)
{
    global $con;

    $stmt = $con->prepare('SELECT * FROM product_size WHERE product_id=' . $productId . ' AND status > 0');
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $sizeNumber = $result->num_rows;
    if ($sizeNumber == 1) {
        $sizeId = $rows[0]['id'];
        $stmt = $con->prepare('SELECT * FROM product_option_title WHERE product_size_id=' . $sizeId . ' AND status > 0');
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $optionNumber = $result->num_rows;

        if ($optionNumber > 0) {
            return 0;
        } else {
            return 1;
        }
    } else {
        return 0;
    }
}

//sortClientsByBirthday(365);
function sortClientsByBirthday($daysLeft)
{
    global $con;
    //$daysLeft = 20;
    $clientData = getAllDataOfClientTable("");
    $i = 1;
    $birthDayData = array();
    $year = date('Y');
    foreach ($clientData as $key => $value) {
        $due_date = $clientData[$key]['dob'] . "/" . $year;
        $due_date_ymd = date('d-m-Y', strtotime(str_replace('/', '-', $due_date)));
        $seconds_to_expire = strtotime($due_date_ymd) - time();
        $secondsLeftValue = $daysLeft * 86400;
        if ($seconds_to_expire > 0) {
            if ($seconds_to_expire < $secondsLeftValue) {
                $totalOrders = count(getAllDataOfOrderProcessTableFromClientId($clientData[$key]['id']));
                $daysLeftValue = round(($seconds_to_expire / 86400));
                $newItem = array(
                    "customer_id" => $clientData[$key]['id'],
                    "customer_name" => $clientData[$key]['name'],
                    "customer_mobile" => $clientData[$key]['mobile'],
                    "customer_address" => $clientData[$key]['address'],
                    "customer_birthday" => $due_date_ymd,
                    "customer_birthday_left" => $daysLeftValue,
                    "total_orders" => $totalOrders
                );

                array_push($birthDayData, $newItem);
            }
        }
    }

    $indexKey = array_column($birthDayData, 'customer_birthday_left');

    array_multisort($indexKey, SORT_ASC, $birthDayData);

    //var_dump($birthDayData);

    return $birthDayData;
}



function getAllDataOfOrderProcessTableFromClientId($id, $specialQuery = "")
{
    global $con;
    $result = array();


    $query = $con->query("select * from order_process WHERE client_id = '$id'" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}



function getAllStockWarningProducts($specialQuery = "")
{
    $ingRows = getAllDataOfIngredientTable(" ORDER BY ingredient_name ASC");

    // print_r($ingRows);
    $returnArray = array();

    foreach ($ingRows as $ingRow) {
        $tempArray = array();
        $stockDatas = getAllDataOfStockTable(" AND ingredient_id = '" . $ingRow['id'] . "'");
        $tempArray['ingredient_name'] = $ingRow['ingredient_name'];
        $tempArray['ingredient_amount'] = 0;
        $tempArray['ingredient_notification_amount'] = $ingRow['notification_limit'];
        foreach ($stockDatas as $stockData) {
            $tempArray['ingredient_amount'] = $tempArray['ingredient_amount'] + $stockData['ingredient_amount'];
        }

        if ($ingRow['notification_limit'] > $tempArray['ingredient_amount']) {
            $allow = true;
        } else {
            $allow = false;
        }

        $tempArray['ingredient_amount'] = $tempArray['ingredient_amount'] . " " . getDefaultWeightInNameFromIngredientId($ingRow['id']);


        if ($allow) {
            array_push($returnArray, $tempArray);
        }
    }

    return $returnArray;
}


function getNotificationLimitFromIngredientId($id)
{
    $stockDetails = getAllDataOfStockTable(" AND ingredient_id = '" . $id . "'");
    // print_r($stockDetails);
    $amount = 0;
    foreach ($stockDetails as $stockData) {
        $amount = $amount + $stockData['ingredient_amount'];
    }
    $ingredientDetails = getIngredientDetailsFromId($id);
    if ($amount > $ingredientDetails['notification_limit']) {
        return false;
    } else {
        return true;
    }
}

function getAllDataOfEventsTable($specialQuery = "")
{
    global $con;
    $result = array();


    $query = $con->query("select * from events WHERE status > 0" . $specialQuery);


    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        array_push($result, $row);
    }

    return $result;
}

function getComplementaryItemsPerDay($startingDate = "", $endingDate = "")
{
    global $con;
    $result = array();

    if ($startingDate == "" || $endingDate == "") {
        $startingDate = date("Y-m-d 00:00:00");
        $endingDate = date("Y-m-d 23:59:59");
    } else {
        $startingDate = $startingDate . " 00:00:00";
        $endingDate = $endingDate . " 23:59:59";
    }

    $dateArray = createDateRangeArray($startingDate, $endingDate);

    foreach ($dateArray as $currentDate) {
        $tempStartingDate = $currentDate . " 00:00:00";
        $tempEndingDate = $currentDate . " 23:59:59";
        $tempArray = array();
        $tempTotalComplementaryAmount = 0;
        $tempTotalOrders = 0;
        $query = $con->query("select * from order_process WHERE (status = 4 OR status = 6) AND discount_amount > 0 AND order_time BETWEEN '$tempStartingDate' AND '$tempEndingDate' ");
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

            if ($row['total_bill'] == 0) {
                $tempTotalComplementaryAmount = $tempTotalComplementaryAmount + $row['discount_amount'];
                $tempTotalOrders = $tempTotalOrders + 1;
            }
        }

        $tempArray['date'] = $currentDate;
        $tempArray['total_amount'] = $tempTotalComplementaryAmount;
        $tempArray['total_orders'] = $tempTotalOrders;
        array_push($result, $tempArray);
    }



    return $result;
}


function getDiscountItemsPerDay($startingDate = "", $endingDate = "")
{
    global $con;
    $result = array();

    if ($startingDate == "" || $endingDate == "") {
        $startingDate = date("Y-m-d 00:00:00");
        $endingDate = date("Y-m-d 23:59:59");
    } else {
        $startingDate = $startingDate . " 00:00:00";
        $endingDate = $endingDate . " 23:59:59";
    }

    $dateArray = createDateRangeArray($startingDate, $endingDate);

    foreach ($dateArray as $currentDate) {
        $tempStartingDate = $currentDate . " 00:00:00";
        $tempEndingDate = $currentDate . " 23:59:59";
        $tempArray = array();
        $tempTotalComplementaryAmount = 0;
        $tempTotalOrders = 0;
        $query = $con->query("select * from order_process WHERE (status = 4 OR status = 6) AND discount_amount > 0 AND order_time BETWEEN '$tempStartingDate' AND '$tempEndingDate' ");
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            if ($row['total_bill'] > 0) {
                $tempTotalComplementaryAmount = $tempTotalComplementaryAmount + $row['discount_amount'];
                $tempTotalOrders = $tempTotalOrders + 1;
            }
        }

        $tempArray['date'] = $currentDate;
        $tempArray['total_amount'] = $tempTotalComplementaryAmount;
        $tempArray['total_orders'] = $tempTotalOrders;
        array_push($result, $tempArray);
    }



    return $result;
}

function numberTowords($num)
{

    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
    );
    $tens = array(
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY",
        4 => "FORTY",
        5 => "FIFTY",
        6 => "SIXTY",
        7 => "SEVENTY",
        8 => "EIGHTY",
        9 => "NINETY"
    );
    $hundreds = array(
        "HUNDRED",
        "THOUSAND",
        "MILLION",
        "BILLION",
        "TRILLION",
        "QUARDRILLION"
    ); /*limit t quadrillion */
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {

        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            /* echo "getting:".$i; */
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")  $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}

function createDateRangeArray($strDateFrom, $strDateTo)
{
    $aryRange = [];

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom < $iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}



?>
