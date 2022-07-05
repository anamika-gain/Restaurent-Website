<?php
session_start();
if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user_name']) && !isset($_SESSION['user_full_name']) && !isset($_SESSION['user_type']) && !isset($_SESSION['user_photo']) && !isset($_SESSION['user_branch_id']) && !isset($_SESSION['user_sub_branch_id']) && !isset($_SESSION['user_branch_name']) && !isset($_SESSION['user_sub_branch_name']))) {
    if (isset($_REQUEST['funName']) && $_REQUEST['funName'] != 'getProductOtionDetailsFromSizeId' && $_REQUEST['funName'] != 'deleteSingleItemFromCart' && $_REQUEST['funName'] != 'updateClietOrderStatusView'  && $_REQUEST['funName'] != 'reloadMiniCart' && $_REQUEST['funName'] != 'updateCartQuantity' && $_REQUEST['funName'] != 'getTotalProductOnCart')
        header("Location: index.php");
}
require 'includes/easyfunctions.php';
$functionToCall = $_REQUEST['funName'];

switch ($functionToCall) {
    case "statusToggler":
        statusToggler();
        break;

    case "saveBranch":
        saveBranch();
        break;
    case "saveEditBranch":
        saveEditBranch();
        break;

    case "saveExpenseType":
        saveExpenseType();
        break;
    case "saveEditExpenseType":
        saveEditExpenseType();
        break;

    case "saveSubBranch":
        saveSubBranch();
        break;
    case "saveEditSubBranch":
        saveEditSubBranch();
        break;
    case "getAllSubBranchDataFromBranchIdAsHtmlOption":
        getAllSubBranchDataFromBranchIdAsHtmlOption();
        break;

    case "saveUser":
        saveUser();
        break;
    case "saveEditUser":
        saveEditUser();
        break;
    case "saveEditUserPassword":
        saveEditUserPassword();
        break;
    case "saveIngredient":
        saveIngredient();
        break;
    case "saveEditIngredient":
        saveEditIngredient();
        break;
    case "getAllIngredientDataFromSubBranchIdAsHtmlOption":
        getAllIngredientDataFromSubBranchIdAsHtmlOption();
        break;
    case "getAllSubCategoryDataFromCategoryIdAsHtmlOption":
        getAllSubCategoryDataFromCategoryIdAsHtmlOption();
        break;
    case "saveProductCategory":
        saveProductCategory();
        break;
    case "saveEditProductCategory":
        saveEditProductCategory();
        break;
    case "saveProductSubCategory":
        saveProductSubCategory();
        break;
    case "saveEditProductSubCategory":
        saveEditProductSubCategory();
        break;
    case "saveIngredientCategory":
        saveIngredientCategory();
        break;
    case "saveEditIngredientCategory":
        saveEditIngredientCategory();
        break;
    case "saveIngredientSubCategory":
        saveIngredientSubCategory();
        break;
    case "saveEditIngredientSubCategory":
        saveEditIngredientSubCategory();
        break;
    case "saveProduct":
        saveProduct();
        break;
    case "saveEditProduct":
        saveEditProduct();
        break;
    case "saveProductSize":
        saveProductSize();
        break;
    case "saveEditProductSize":
        saveEditProductSize();
        break;
    case "getAllUnaddedIngredientDetailsForAddingFromProductSizeId":
        getAllUnaddedIngredientDetailsForAddingFromProductSizeId($_REQUEST['productSizeId']);
        break;
    case "saveProductIngredient":
        saveProductIngredient();
        break;
    case "saveEditProductIngredient":
        saveEditProductIngredient();
        break;
    case "saveProductOptionTitle":
        saveProductOptionTitle();
        break;
    case "saveEditProductOptionTitle":
        saveEditProductOptionTitle();
        break;
    case "getAllUnaddedIngredientDetailsForAddingFromProductSizeIdAsHtmlOptions":
        getAllUnaddedIngredientDetailsForAddingFromProductSizeIdAsHtmlOptions();
        break;
    case "getAllAddedIngredientFromProductSizeIdAsDataTable":
        getAllAddedIngredientFromProductSizeIdAsDataTable();
        break;
    case "getAllAddedProductOptionTitleFromProductSizeFromProductSizeIdAsDataTable":
        getAllAddedProductOptionTitleFromProductSizeFromProductSizeIdAsDataTable();
        break;
    case "getProductOptionTitleFromProductSizeIdAsHtmlOption":
        getProductOptionTitleFromProductSizeIdAsHtmlOption();
        break;
    case "saveProductOption":
        saveProductOption();
        break;
    case "saveEditProductOption":
        saveEditProductOption();
        break;
    case "getAllAddedProductOptionFromProductTitleAsDataTable":
        getAllAddedProductOptionFromProductTitleAsDataTable();
        break;
    case "getAllProductOptionFromProductTitleIdAsHtmlOption":
        getAllProductOptionFromProductTitleIdAsHtmlOption();
        break;
    case "saveProductOptionIngredients":
        saveProductOptionIngredients();
        break;
    case "getAllUnaddedIngredientDetailsForAddingFromProductOptionIdAsHtmlOptions":
        getAllUnaddedIngredientDetailsForAddingFromProductOptionIdAsHtmlOptions();
        break;
    case "getAllAddedIngredientFromProductOptionIdAsDataTable":
        getAllAddedIngredientFromProductOptionIdAsDataTable();
        break;
    case "saveProductAddon":
        saveProductAddon();
        break;
    case "getAllUnaddedIngredientDetailsForAddingFromProductAddonIdAsHtmlOptions":
        getAllUnaddedIngredientDetailsForAddingFromProductAddonIdAsHtmlOptions();
        break;
    case "getAllAddedIngredientFromProductAddonIdAsDataTable":
        getAllAddedIngredientFromProductAddonIdAsDataTable();
        break;
    case "saveEditProductAddon":
        saveEditProductAddon();
        break;
    case "saveProductAddonIngredients":
        saveProductAddonIngredients();
        break;
    case "saveSubCategoryAddon":
        saveSubCategoryAddon();
        break;
    case "getAllUnaddedIngredientDetailsForAddingFromSubCategoryAddonIdAsHtmlOptions":
        getAllUnaddedIngredientDetailsForAddingFromSubCategoryAddonIdAsHtmlOptions();
        break;
    case "getAllAddedIngredientFromSubCategoryAddonIdAsDataTable":
        getAllAddedIngredientFromSubCategoryAddonIdAsDataTable();
        break;
    case "saveEditSubCategoryAddon":
        saveEditSubCategoryAddon();
        break;
    case "saveSubCategoryAddonIngredients":
        saveSubCategoryAddonIngredients();
        break;
    case "getAllIngredientDetailsAsHtmlOptions":
        getAllIngredientDetailsAsHtmlOptions();
        break;
    case "saveRequisition":
        saveRequisition();
        break;
    case "viewRequisition":
        viewRequisition();
        break;
    case "updateRequisition":
        updateRequisition();
        break;
    case "viewRequisitionInPurchase":
        viewRequisitionInPurchase();
        break;
    case "loadRequisitionItemsForPurchaseAdd":
        loadRequisitionItemsForPurchaseAdd();
        break;
    case "savePurchase":
        savePurchase();
        break;
    case "viewPurchaseCompletedList":
        viewPurchaseCompletedList();
        break;
    case "saveVendor":
        saveVendor();
        break;
    case "saveEditVendor":
        saveEditVendor();
        break;
    case "saveVendorCategory":
        saveVendorCategory();
        break;
    case "saveGuardRequisition":
        saveGuardRequisition();
        break;
    case "addProductInOrderSession":
        addProductInOrderSession();
        break;
    case "deleteSingleItemFromCart":
        deleteSingleItemFromCart();
        break;
    case "deleteSingleItemFromCartPos":
        deleteSingleItemFromCartPos();
        break;
    case "deleteAllItemFromCart":
        deleteAllItemFromCart();
        break;
    case "saveClient":
        saveClient();
        break;
    case "saveWastage":
        saveWastage();
        break;
    case "saveOrder":
        saveOrder();
        break;
    case "updateOrderProcess":
        updateOrderProcess();
        break;
    case "getProductOtionDetailsFromSizeId":
        getProductOtionDetailsFromSizeId();
        break;
    case "getProductOtionDetailsFromSizeIdForPos":
        getProductOtionDetailsFromSizeIdForPos();
        break;
    case "getOrderDetailsForCheffFromUniqueOrderId":
        getOrderDetailsForCheffFromUniqueOrderId();
        break;
    case "updateOrderDistribution":
        updateOrderDistribution();
        break;
    case "getTotalProductOnCart":
        getTotalProductOnCart();
        break;
    case "changeWebsiteView":
        changeWebsiteView();
        break;
    case "updateCartQuantity":
        updateCartQuantity();
        break;
    case "updateClietOrderStatusView":
        updateClietOrderStatusView();
        break;
    case "showNotification":
        showNotification();
        break;
    case "showCommonNotification":
        showCommonNotification();
        break;
    case "stopNotification":
        stopNotification();
        break;
    case "orderManagementTable":
        orderManagementTable();
        break;
    case "getProductSizesFromProductIdForPos":
        getProductSizesFromProductIdForPos();
        break;
    case "reloadListPos":
        reloadListPos();
        break;
    case "reloadTableList":
        reloadTableList();
        break;
    case "removeSingleOption":
        removeSingleOption();
        break;
    case "itemWisePurchaseReport":
        itemWisePurchaseReport();
        break;
    case "itemWiseSalesReport":
        itemWiseSalesReport();
        break;
    case "dailyReport":
        dailyReport();
        break;
    case "saveExpenseDetails":
        saveExpenseDetails();
        break;
    case "expenseReport":
        expenseReport();
        break;
    default:
        showProcessingWindow();
}


function statusToggler()
{
    global $con;
    $tableName = $_REQUEST['tableName'];
    $id = $_REQUEST['id'];
    $changeTo = $_REQUEST['changeTo'];
    $deleteDate = date("Y-m-d H:i:s");
    $userId = $_SESSION['user_id'];

    if ($changeTo == 0) {


        if ($tableName == 'product_option_ingredients' || $tableName == 'product_addons_ingredients' || $tableName == 'product_ingredients' || $tableName == 'vendor_ingredient_category') {


            if ($tableName == 'vendor_ingredient_category') {
                $idRow = getIngredientDetailsFromTableAndId($tableName, $id);
                $newId = $idRow['category_id'] . "99999";
                $sql = "UPDATE `$tableName` SET `category_id` = '$newId', `deleted_at` = '$deleteDate', `deleted_by` = '$userId', `status` = '$changeTo' WHERE `$tableName`.`id` = '$id'";
            } else {
                $idRow = getIngredientDetailsFromTableAndId($tableName, $id);
                $newId = $idRow['ingredient_id'] . "99999";
                $sql = "UPDATE `$tableName` SET `ingredient_id` = '$newId', `deleted_at` = '$deleteDate', `deleted_by` = '$userId', `status` = '$changeTo' WHERE `$tableName`.`id` = '$id'";
            }
        } else
            $sql = "UPDATE `$tableName` SET `deleted_at` = '$deleteDate', `deleted_by` = '$userId', `status` = '$changeTo' WHERE `$tableName`.`id` = '$id'";
    } else
        $sql = "UPDATE `$tableName` SET `status` = '$changeTo' WHERE `$tableName`.`id` = $id";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

// Branch Functions

function saveBranch()
{
    global $con;

    $addBranchLogo = $_REQUEST['branchLogo'];
    $addBranchName = $_REQUEST['branchName'];


    list($type, $addBranchLogo) = explode(';', $addBranchLogo);
    list(, $addBranchLogo)      = explode(',', $addBranchLogo);

    $userId = $_SESSION['user_id'];


    $addBranchLogo = base64_decode($addBranchLogo);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $addBranchLogo);

    $sql = "INSERT INTO `branch` (`name`, `logo`, `created_by`) VALUES ('$addBranchName', '$imageName', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditBranch()
{
    global $con;


    $branchId = $_REQUEST['branchId'];
    $branchName = $_REQUEST['branchName'];
    $branchCurrentLogoName = $_REQUEST['currentLogoName'];
    $branchUpdatedLogo = $_REQUEST['branchLogo'];
    $branchLogoChanged = $_REQUEST['logoChanged'];

    $userId = $_SESSION['user_id']; // deleted by will be session user id, 1 is used for demo purpuse only


    if ($branchLogoChanged == 1) {

        list($type, $branchUpdatedLogo) = explode(';', $branchUpdatedLogo);
        list(, $branchUpdatedLogo)      = explode(',', $branchUpdatedLogo);

        $branchUpdatedLogo = base64_decode($branchUpdatedLogo);

        $file_pointer = 'images/' . $branchCurrentLogoName;

        unlink($file_pointer);

        $branchCurrentLogoName = round(microtime(true) * 1000) . $userId . '.png';

        file_put_contents('images/' . $branchCurrentLogoName, $branchUpdatedLogo);
    }


    $sql = "UPDATE `branch` SET `name` = '$branchName', `logo` = '$branchCurrentLogoName' WHERE `branch`.`id` = $branchId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveExpenseType()
{
    global $con;


    $expenseTypeName = $_REQUEST['expenseTypeName'];

    $userId = $_SESSION['user_id'];


    $sql = "INSERT INTO `expense_name` (`name`, `created_by`) VALUES ('$expenseTypeName', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditExpenseType()
{
    global $con;

    $expenseTypeId = $_REQUEST['expenseTypeId'];
    $expenseTypeName = $_REQUEST['expenseTypeName'];

    $userId = $_SESSION['user_id']; // deleted by will be session user id, 1 is used for demo purpuse only



    $sql = "UPDATE `expense_name` SET `name` = '$expenseTypeName' WHERE `expense_name`.`id` = $expenseTypeId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Sub Branch Functions

function saveSubBranch()
{
    global $con;

    $addSubBranchFullName = $_REQUEST['fullName'];
    $addSubBranchBranchId = $_REQUEST['branchId'];
    $addSubBranchLogo = $_REQUEST['logo'];
    $addSubBranchAddress = $_REQUEST['address'];
    $addSubBranchArea = $_REQUEST['area'];
    $addSubBranchPhone = $_REQUEST['phone'];
    $addSubBranchMobile = $_REQUEST['mobile'];
    $addSubBranchEmail = $_REQUEST['email'];
    $addSubBranchCreatedBy = $_SESSION['user_id']; // deleted by will be session user id, 1 is used for demo purpuse only



    list($type, $addSubBranchLogo) = explode(';', $addSubBranchLogo);
    list(, $addSubBranchLogo)      = explode(',', $addSubBranchLogo);


    $addSubBranchLogo = base64_decode($addSubBranchLogo);
    $imageName = round(microtime(true) * 1000) . $addSubBranchCreatedBy . '.png';
    file_put_contents('images/' . $imageName, $addSubBranchLogo);

    $sql = "INSERT INTO `sub_branch` (`branch_id`, `name`, `logo`, `address`, `area`, `phone_number`, `mobile_number`, `email`, `created_by`) VALUES ('$addSubBranchBranchId', '$addSubBranchFullName', '$imageName', '$addSubBranchAddress', '$addSubBranchArea', '$addSubBranchPhone', '$addSubBranchMobile', '$addSubBranchEmail', '$addSubBranchCreatedBy')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditSubBranch()
{
    global $con;


    $editSubBranchFullName = $_REQUEST['fullName'];
    $editSubBranchBranchId = $_REQUEST['branchId'];
    $editSubBranchLogoUpdated = $_REQUEST['logoUpdated'];
    $editSubBranchCurrentLogoName = $_REQUEST['logoName'];
    $editSubBranchAddress = $_REQUEST['address'];
    $editSubBranchArea = $_REQUEST['area'];
    $editSubBranchPhone = $_REQUEST['phone'];
    $editSubBranchMobile = $_REQUEST['mobile'];
    $editSubBranchEmail = $_REQUEST['email'];
    $subBranchLogoChanged = $_REQUEST['logoChanged'];
    $editSubBranchId = $_REQUEST['id'];

    $userId = $_SESSION['user_id']; // deleted by will be session user id, 1 is used for demo purpuse only


    if ($subBranchLogoChanged == 1) {

        list($type, $editSubBranchLogoUpdated) = explode(';', $editSubBranchLogoUpdated);
        list(, $editSubBranchLogoUpdated)      = explode(',', $editSubBranchLogoUpdated);

        $editSubBranchLogoUpdated = base64_decode($editSubBranchLogoUpdated);

        $file_pointer = 'images/' . $editSubBranchCurrentLogoName;

        unlink($file_pointer);

        $editSubBranchCurrentLogoName = round(microtime(true) * 1000) . $userId . '.png';

        file_put_contents('images/' . $editSubBranchCurrentLogoName, $editSubBranchLogoUpdated);
    }


    $sql = "UPDATE `sub_branch` SET `branch_id` = '$editSubBranchBranchId', `logo` = '$editSubBranchCurrentLogoName', `name` = '$editSubBranchFullName', `address` = '$editSubBranchAddress', `area` = '$editSubBranchArea', `phone_number` = '$editSubBranchPhone', `mobile_number` = '$editSubBranchMobile', `email` = '$editSubBranchEmail' WHERE `sub_branch`.`id` = $editSubBranchId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function getAllSubBranchDataFromBranchIdAsHtmlOption()
{
    //$('#divId').html(response);

    global $con;
    $branchId = $_REQUEST['branchId'];
    $query = $con->query("select * from sub_branch WHERE branch_id =" . $branchId);
    while ($row = mysqli_fetch_array($query)) {
?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php
    }
}


// User Functions

function saveUser()
{
    global $con;

    $salt = generateSaltString();

    //echo $salt;

    $addUserUserName = $_REQUEST['userName'];
    $addUserFullName = $_REQUEST['fullName'];
    $addUserMobileNumber = $_REQUEST['mobileNumber'];
    $addUserUserType = $_REQUEST['userType']; //id of user type table
    $addUserPassword = $salt . strrev(hash('sha256', $_REQUEST['password']));
    $addUserEmployeeType = $_REQUEST['employeeType']; //id of employee type table
    $addUserPhoto = $_REQUEST['photo'];
    $addUserEmail = $_REQUEST['email'];
    $addUserJoiningDate = $_REQUEST['joiningDate'];
    $addUserBranchId = $_REQUEST['branchId'];  //id of branch table
    $addUserSubBranchId = $_REQUEST['subBranchId']; //id of sub branch table
    $addUserPresentAddress = $_REQUEST['presentAddress'];
    $addUserPermanentAddress = $_REQUEST['permanentAddress'];
    $addUserBasicSalary = $_REQUEST['basicSalary'];
    $addUserSalaryType = $_REQUEST['salaryType']; //id of salary type table

    $userId = $_SESSION['user_id']; //session data here; 1 used for demo




    list($type, $addUserPhoto) = explode(';', $addUserPhoto);
    list(, $addUserPhoto)      = explode(',', $addUserPhoto);


    $addUserPhoto = base64_decode($addUserPhoto);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $addUserPhoto);

    $sql = "INSERT INTO `user` (`user_name`, `full_name`, `mobile_number`, `user_type`, `email`, `joining_date`, `password`, `employee_type`, `photo`, `branch_id`, `sub_branch_id`, `present_address`, `permanent_address`, `basic_salary`, `salary_type`) 
    VALUES ('$addUserUserName', '$addUserFullName', '$addUserMobileNumber', '$addUserUserType', '$addUserEmail', '$addUserJoiningDate', '$addUserPassword', '$addUserEmployeeType', '$imageName', '$addUserBranchId', '$addUserSubBranchId', '$addUserPresentAddress', '$addUserPermanentAddress', '$addUserBasicSalary', '$addUserSalaryType')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditUser()
{
    global $con;

    //echo $salt;

    $editUserId = $_REQUEST['id'];
    $editUserUserName = $_REQUEST['userName'];
    $editUserFullName = $_REQUEST['fullName'];
    $editUserMobileNumber = $_REQUEST['mobileNumber'];
    $editUserUserType = $_REQUEST['userType']; //id of user type table
    $editUserJoiningDate = $_REQUEST['joiningDate'];
    $editUserEmployeeType = $_REQUEST['employeeType']; //id of employee type table
    $editUserCurrentPhotoName = $_REQUEST['photoName'];
    $editUserPhoto = $_REQUEST['photo'];  //new photo if available
    $editUserEmail = $_REQUEST['email'];
    $editUserBranchId = $_REQUEST['branchId'];  //id of branch table
    $editUserSubBranchId = $_REQUEST['subBranchId']; //id of sub branch table
    $editUserPresentAddress = $_REQUEST['presentAddress'];
    $editUserPermanentAddress = $_REQUEST['permanentAddress'];
    $editUserBasicSalary = $_REQUEST['basicSalary'];
    $editUserSalaryType = $_REQUEST['salaryType']; //id of salary type table

    $userPhotoChanged = $_REQUEST['photoChanged'];

    $userId = $_SESSION['user_id']; // this will be session user id, 1 is used for demo purpuse only


    if ($userPhotoChanged == 1) {

        list($type, $editUserPhoto) = explode(';', $editUserPhoto);
        list(, $editUserPhoto)      = explode(',', $editUserPhoto);

        $editUserPhoto = base64_decode($editUserPhoto);

        $file_pointer = 'images/' . $editUserCurrentPhotoName;

        unlink($file_pointer);

        $editUserCurrentPhotoName = round(microtime(true) * 1000) . $userId . '.png';

        file_put_contents('images/' . $editUserCurrentPhotoName, $editUserPhoto);
    }


    $sql = "UPDATE `user` SET 
                        
                            `user_name` = '$editUserUserName', 
                            `full_name` = '$editUserFullName', 
                            `mobile_number` = '$editUserMobileNumber', 
                            `user_type` = '$editUserUserType', 
                            `email` = '$editUserEmail', 
                            `joining_date` = '$editUserJoiningDate', 
                            `employee_type` = '$editUserEmployeeType', 
                            `photo` = '$editUserCurrentPhotoName', 
                            `branch_id` = '$editUserBranchId', 
                            `sub_branch_id` = '$editUserSubBranchId', 
                            `present_address` = '$editUserPresentAddress', 
                            `permanent_address` = '$editUserPermanentAddress', 
                            `basic_salary` = '$editUserBasicSalary', 
                            `salary_type` = '$editUserSalaryType' 
                        
                        WHERE `user`.`id` = $editUserId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditUserPassword()
{
    global $con;
    $salt = generateSaltString();
    $editUserId = $_REQUEST['id'];
    $editUserPassword = $salt . strrev(hash('sha256', $_REQUEST['password']));

    $sql = "UPDATE `user` SET `password` = '$editUserPassword' WHERE `user`.`id` = $editUserId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Ingredients Functions

function saveIngredient()
{
    global $con;

    $addIngredientName = $_REQUEST['name'];
    $addIngredientDefaultWeightIn = $_REQUEST['defaultWeightIn']; //dropdown name will be directly added from 
    $addIngredientSubBranchId = "0"; //$_REQUEST['subBranchId'];
    $addIngredientBranchId = $_REQUEST['branchId'];
    $addIngredientImage = $_REQUEST['photo'];
    $addIngredientCategory = $_REQUEST['category'];
    $addIngredientSubCategory = $_REQUEST['subCategory'];


    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only


    list($type, $addIngredientImage) = explode(';', $addIngredientImage);
    list(, $addIngredientImage)      = explode(',', $addIngredientImage);


    $addIngredientImage = base64_decode($addIngredientImage);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $addIngredientImage);

    $sql = "INSERT INTO `ingredients` (`ingredient_category_id`, `ingredient_sub_category_id`, `ingredient_name`, `default_weight_in`, `sub_branch_id`, `branch_id`, `image`) VALUES ('$addIngredientCategory', '$addIngredientSubCategory', '$addIngredientName', '$addIngredientDefaultWeightIn', '$addIngredientSubBranchId', '$addIngredientBranchId', '$imageName')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditIngredient()
{
    global $con;

    //echo $salt;

    $editIngredientId = $_REQUEST['id'];
    $editIngredientName = $_REQUEST['name'];
    $editIngredientDefaultWeightIn = $_REQUEST['defaultWeightIn']; //dropdown name will be directly added from 
    $editIngredientSubBranchId = "0"; //$_REQUEST['subBranchId'];
    $editIngredientBranchId = $_REQUEST['branchId'];
    $editIngredientImage = $_REQUEST['photo'];
    $ingredientImageChanged = $_REQUEST['imageChanged'];
    $editIngredientCurrentPhotoName = $_REQUEST['currentLogoName'];
    $editIngredientCategory = $_REQUEST['category'];
    $editIngredientSubCategory = $_REQUEST['subCategory'];

    $userId = $_SESSION['user_id']; // this will be session user id, 1 is used for demo purpuse only


    if ($ingredientImageChanged == 1) {

        list($type, $editIngredientImage) = explode(';', $editIngredientImage);
        list(, $editIngredientImage)      = explode(',', $editIngredientImage);

        $editIngredientImage = base64_decode($editIngredientImage);

        $file_pointer = 'images/' . $editIngredientCurrentPhotoName;

        unlink($file_pointer);

        $editIngredientCurrentPhotoName = round(microtime(true) * 1000) . $userId . '.png';

        file_put_contents('images/' . $editIngredientCurrentPhotoName, $editIngredientImage);
    }


    $sql = "UPDATE `ingredients` SET 
                                    `ingredient_category_id` = '$editIngredientCategory', 
                                    `ingredient_sub_category_id` = '$editIngredientSubCategory', 
                                    `ingredient_name` = '$editIngredientName', 
                                    `default_weight_in` = '$editIngredientDefaultWeightIn', 
                                    `sub_branch_id` = '$editIngredientSubBranchId', 
                                    `branch_id` = '$editIngredientBranchId',
                                    `image` = '$editIngredientCurrentPhotoName' 
                                WHERE `ingredients`.`id` = $editIngredientId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function getAllIngredientDataFromSubBranchIdAsHtmlOption()
{
    //$('#divId').html(response);

    global $con;
    //$subBranchId = $_REQUEST['subBranchId'];
    //$query = $con->query("select * from ingredient WHERE sub_branch_id =" . $subBranchId);
    $query = $con->query("select * from ingredient WHERE status = 1");
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['ingredient_name'] . " ( " . $row['default_weight_in'] . " )" ?></option>
    <?php
    }
}


// Product Category Functions

function saveProductCategory()
{
    global $con;

    $addProductCategoryName = $_REQUEST['name'];
    $addProductCategoryBranchId = $_REQUEST['branchId'];
    $addProductCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];

    $sql = "INSERT INTO `product_category` (`name`, `branch_id`, `sub_branch_id`) VALUES ('$addProductCategoryName', '$addProductCategoryBranchId', '$addProductCategorySubBranchId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditProductCategory()
{
    global $con;

    //echo $salt;

    $editProductCategoryId = $_REQUEST['id'];
    $editProductCategoryName = $_REQUEST['name'];
    $editProductCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];
    $editProductCategoryBranchId = $_REQUEST['branchId'];



    $sql = "UPDATE `product_category` SET 
                                    `name` = '$editProductCategoryName', 
                                    `branch_id` = '$editProductCategoryBranchId', 
                                    `sub_branch_id` = '$editProductCategorySubBranchId' 
                                WHERE `product_category`.`id` = $editProductCategoryId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Product Sub Category Functions

function saveProductSubCategory()
{
    global $con;

    $addProductSubCategoryName = $_REQUEST['name'];
    $addProductSubCategoryCategoryId = $_REQUEST['categoryId'];
    $addProductSubCategoryBranchId = $_REQUEST['branchId'];
    $addProductSubCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];

    $sql = "INSERT INTO `product_sub_category` (`name`, `branch_id`, `sub_branch_id`, `category_id`) VALUES ('$addProductSubCategoryName', '$addProductSubCategoryBranchId', '$addProductSubCategorySubBranchId', '$addProductSubCategoryCategoryId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditProductSubCategory()
{
    global $con;

    //echo $salt;

    $editProductSubCategoryId = $_REQUEST['id'];
    $editProductSubCategoryName = $_REQUEST['name'];
    $editProductSubCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];
    $editProductSubCategoryBranchId = $_REQUEST['branchId'];
    $editProductSubCategoryCategoryId = $_REQUEST['categoryId'];



    $sql = "UPDATE `product_sub_category` SET 
                                    `name` = '$editProductSubCategoryName', 
                                    `branch_id` = '$editProductSubCategoryBranchId', 
                                    `sub_branch_id` = '$editProductSubCategorySubBranchId', 
                                    `category_id` = '$editProductSubCategoryCategoryId' 
                                WHERE `product_sub_category`.`id` = $editProductSubCategoryId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Ingredient Category Functions

function saveIngredientCategory()
{
    global $con;

    $addIngredientCategoryName = $_REQUEST['name'];
    $addIngredientCategoryBranchId = $_REQUEST['branchId'];
    $addIngredientCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];

    $sql = "INSERT INTO `ingredient_category` (`name`, `branch_id`, `sub_branch_id`) VALUES ('$addIngredientCategoryName', '$addIngredientCategoryBranchId', '$addIngredientCategorySubBranchId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditIngredientCategory()
{
    global $con;

    //echo $salt;

    $editIngredientCategoryId = $_REQUEST['id'];
    $editIngredientCategoryName = $_REQUEST['name'];
    $editIngredientCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];
    $editIngredientCategoryBranchId = $_REQUEST['branchId'];



    $sql = "UPDATE `ingredient_category` SET 
                                    `name` = '$editIngredientCategoryName', 
                                    `branch_id` = '$editIngredientCategoryBranchId', 
                                    `sub_branch_id` = '$editIngredientCategorySubBranchId' 
                                WHERE `ingredient_category`.`id` = $editIngredientCategoryId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

// Ingredient Sub Category Functions

function saveIngredientSubCategory()
{
    global $con;

    $addIngredientSubCategoryName = $_REQUEST['name'];
    $addIngredientSubCategoryCategoryId = $_REQUEST['categoryId'];
    $addIngredientSubCategoryBranchId = $_REQUEST['branchId'];
    $addIngredientSubCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];

    $sql = "INSERT INTO `ingredient_sub_category` (`name`, `branch_id`, `sub_branch_id`, `category_id`) VALUES ('$addIngredientSubCategoryName', '$addIngredientSubCategoryBranchId', '$addIngredientSubCategorySubBranchId', '$addIngredientSubCategoryCategoryId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveEditIngredientSubCategory()
{
    global $con;

    //echo $salt;

    $editIngredientSubCategoryId = $_REQUEST['id'];
    $editIngredientSubCategoryName = $_REQUEST['name'];
    $editIngredientSubCategorySubBranchId = "0"; //$_REQUEST['subBranchId'];
    $editIngredientSubCategoryBranchId = $_REQUEST['branchId'];
    $editIngredientSubCategoryCategoryId = $_REQUEST['categoryId'];



    $sql = "UPDATE `ingredient_sub_category` SET 
                                    `name` = '$editIngredientSubCategoryName', 
                                    `branch_id` = '$editIngredientSubCategoryBranchId', 
                                    `sub_branch_id` = '$editIngredientSubCategorySubBranchId', 
                                    `category_id` = '$editIngredientSubCategoryCategoryId' 
                                WHERE `ingredient_sub_category`.`id` = $editIngredientSubCategoryId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Category Sub Category of Anything

function getAllSubCategoryDataFromCategoryIdAsHtmlOption()
{
    //$('#divId').html(response);

    global $con;
    $subCategoryTableName = $_REQUEST['scTable'];  //sub category table name in db
    $subCategoryTableColumnName = $_REQUEST['scTableColumn'];  //the coulmn where the category id is stored
    $returningValueCoulmnNameOfSubCategoryTable = $_REQUEST['rscTableColumn'];  // the coulmn name whichs value will be shown to customer
    $categoryId = $_REQUEST['categoryId'];
    $query = $con->query("select * from $subCategoryTableName WHERE status = 1 AND $subCategoryTableColumnName =" . $categoryId);
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row[$returningValueCoulmnNameOfSubCategoryTable] ?></option>
    <?php
    }
}


// Product Functions

function saveProduct()
{
    global $con;

    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only

    $addProductImage = $_REQUEST['image'];
    $addProductUniqueId = round(microtime(true) * 1000) . $userId;
    $addProductName = $_REQUEST['name'];
    $addProductCategoryId = $_REQUEST['categoryId'];
    $addProductSubCategoryId = $_REQUEST['subCategoryId'];
    $addProductBranchId = $_REQUEST['branchId'];
    $addProductSubBranchId = "0"; //$_REQUEST['subBranchId'];
    $addProductDescription = $_REQUEST['description'];
    // $addProductSellingPrice = $_REQUEST['sellingPrice'];

    // $addProductSpecialPrice = $_REQUEST['specialPrice'];

    // if ((float)$addProductSpecialPrice != 0) {
    //     $addProductSpecialPriceFrom = $_REQUEST['specialPriceFrom'];
    //     $addProductSpecialPriceTo = $_REQUEST['specialPriceTo'];
    // } else {
    //     $addProductSpecialPriceFrom = date("Y-m-d H:m:i");
    //     $addProductSpecialPriceTo = date("Y-m-d H:m:i");
    // }



    list($type, $addProductImage) = explode(';', $addProductImage);
    list(, $addProductImage)      = explode(',', $addProductImage);




    $addProductImage = base64_decode($addProductImage);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $addProductImage);

    $sql = "INSERT INTO `products` (`photo`, `unique_id`, `name`, `category_id`, `sub_category_id`, `branch_id`, `sub_branch_id`, `description`, `created_by`) VALUES ('$imageName', '$addProductUniqueId', '$addProductName', '$addProductCategoryId', '$addProductSubCategoryId', '$addProductBranchId', '$addProductSubBranchId', '$addProductDescription', '$userId')";

    if ($con->query($sql)) {
        $return_arr = array(
            "status" => 1,
            "productUniqueId" => $addProductUniqueId
        );

        echo json_encode($return_arr);
    } else {
        $return_arr = array(
            "status" => 0
        );

        echo json_encode($return_arr);
    }

    //using the value using javascript

    //var obj = JSON.parse(JSON.stringify(response));
    //obj.status ---->  1 means successful 0 means otherwise
    //obj.productUniqueId

}

function saveEditProduct()
{
    global $con;


    $editProductId = $_REQUEST['productId'];
    $editProductName = $_REQUEST['productName'];
    $editProductCurrentImageName = $_REQUEST['currentImageName'];
    $editProductUpdatedImage = $_REQUEST['productImage'];
    $editProductImageChanged = $_REQUEST['imageChanged'];
    $editProductCategoryId = $_REQUEST['categoryId'];
    $editProductSubCategoryId = $_REQUEST['subCategoryId'];
    $editProductBranchId = $_REQUEST['branchId'];
    $editProductSubBranchId = "0"; //$_REQUEST['subBranchId'];
    // $editProductSellingPrice = $_REQUEST['sellingPrice'];
    // $editProductSpecialPrice = $_REQUEST['specialPrice'];
    // $editProductSpecialPriceFrom = $_REQUEST['specialPriceFrom'];
    // $editProductSpecialPriceTo = $_REQUEST['specialPriceTo'];


    $userId = $_SESSION['user_id']; // deleted by will be session user id, 1 is used for demo purpuse only


    if ($editProductImageChanged == 1) {

        list($type, $editProductUpdatedImage) = explode(';', $editProductUpdatedImage);
        list(, $editProductUpdatedImage)      = explode(',', $editProductUpdatedImage);

        $editProductUpdatedImage = base64_decode($editProductUpdatedImage);

        $file_pointer = 'images/' . $editProductCurrentImageName;

        unlink($file_pointer);

        $editProductCurrentImageName = round(microtime(true) * 1000) . $userId . '.png';

        file_put_contents('images/' . $editProductCurrentImageName, $editProductUpdatedImage);
    }


    $sql = "UPDATE `products` SET 
                                `photo` = '$editProductCurrentImageName', 
                                `name` = '$editProductName', 
                                `category_id` = '$editProductCategoryId', 
                                `sub_category_id` = '$editProductSubCategoryId', 
                                `branch_id` = '$editProductBranchId', 
                                `sub_branch_id` = '$editProductSubBranchId'
                            WHERE `products`.`id` = $editProductId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Product Size Functions

function saveProductSize()
{
    global $con;


    $addProductSizeProductId = $_REQUEST['productId'];
    $addProductSizeSizeName = $_REQUEST['sizeName'];
    $addProductSizeSellingPrice = $_REQUEST['sellingPrice'];
    $addProductSizeSpecialPrice = $_REQUEST['specialPrice'];
    $addProductSizeSpecialPriceFrom = $_REQUEST['specialPriceFrom'];
    $addProductSizeSpecialPriceTo = $_REQUEST['specialPriceTo'];

    $addProductSizeCreatedBy = $_SESSION['user_id']; // will be session user id, 1 is used for demo purpuse only



    $sql = "INSERT INTO `product_size` (`product_id`, `name`, `selling_price`, `special_price`, `special_price_from`, `special_price_to`, `created_by`) VALUES ('$addProductSizeProductId', '$addProductSizeSizeName', '$addProductSizeSellingPrice', '$addProductSizeSpecialPrice', '$addProductSizeSpecialPriceFrom', '$addProductSizeSpecialPriceTo', '$addProductSizeCreatedBy')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveEditProductSize()
{

    global $con;

    $editProductSizeId = $_REQUEST['id'];
    //$editProductSizeProductId = $_REQUEST['productId'];
    $editProductSizeName = $_REQUEST['name'];
    $editProductSizeSellingPrice = $_REQUEST['sellingPrice'];
    $editProductSizeSpecialPrice = $_REQUEST['specialPrice'];
    $editProductSizeSpecialPriceFrom = $_REQUEST['specialPriceFrom'];
    $editProductSizeSpecialPriceTo = $_REQUEST['specialPriceTo'];



    $sql = "UPDATE `product_size` SET  
                                    `name` = '$editProductSizeName', 
                                    `selling_price` = '$editProductSizeSellingPrice', 
                                    `special_price` = '$editProductSizeSpecialPrice', 
                                    `special_price_from` = '$editProductSizeSpecialPriceFrom', 
                                    `special_price_to` = '$editProductSizeSpecialPriceTo' 
                                WHERE `product_size`.`id` = $editProductSizeId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


// Product Ingredients Functions

function saveProductIngredient()
{
    global $con;

    //01872733642
    $addProductIngredientProductId = $_REQUEST['productId'];
    $addProductIngredientProductSizeId = $_REQUEST['productSizeId'];
    $addProductIngredientIngredientId = $_REQUEST['ingredientId'];
    $addProductIngredientIngredientAmount = $_REQUEST['ingredientAmount'];

    $addProductIngredientCreatedBy = $_SESSION['user_id']; // will be session user id, 1 is used for demo purpuse only



    $sql = "INSERT INTO `product_ingredients` (`product_id`, `product_size_id`, `ingredient_id`, `ingredient_amount`, `created_by`) VALUES ('$addProductIngredientProductId', '$addProductIngredientProductSizeId', '$addProductIngredientIngredientId', '$addProductIngredientIngredientAmount', '$addProductIngredientCreatedBy')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveEditProductIngredient()
{

    global $con;

    $editProductIngredientId = $_REQUEST['id'];
    $editProductIngredientAmount = $_REQUEST['amount'];



    $sql = "UPDATE `product_ingredients` SET 
                                    `ingredient_amount` = '$editProductIngredientAmount' 
                                WHERE `product_ingredients`.`id` = '$editProductIngredientId'";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function getAllUnaddedIngredientDetailsForAddingFromProductSizeIdAsHtmlOptions()
{
    global $con;

    $productSizeId = $_REQUEST['id'];

    $branchId = $_SESSION['user_branch_id']; // session user sub branch id, 1 is for demo only 
    $subBranchId = "0"; //$_SESSION['user_sub_branch_id']; // session user sub branch id, 1 is for demo only 

    //generate ingredients ids that are not yet used.

    // $sql = "SELECT t1.id
    //         FROM ingredients t1
    //         LEFT JOIN product_ingredients t2 ON t2.ingredient_id = t1.id AND t2.product_size_id = $productSizeId 
    //         WHERE t2.id IS NULL AND t1.branch_id= $branchId AND t1.sub_branch_id= $subBranchId AND t1.status > 0";

    $sql = "SELECT t1.id
            FROM ingredients t1
            LEFT JOIN product_ingredients t2 ON t2.ingredient_id = t1.id AND t2.product_size_id = $productSizeId 
            WHERE t2.id IS NULL AND t1.branch_id= $branchId AND t1.status > 0";


    $query = $con->query($sql);

    $result = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $query2 = $con->query("select * from ingredients WHERE id = " . $row['id']);

        $row2 = mysqli_fetch_array($query2);

        array_push($result, $row2);
    }

    foreach ($result as $key => $value) {
    ?>

        <option value="<?php echo $result[$key]['id']; ?>"><?php echo $result[$key]['ingredient_name'] . " (" . getWeightNameFromId($result[$key]['default_weight_in']) . ")"; ?></option>

    <?php
    }
}

function getAllAddedIngredientFromProductSizeIdAsDataTable()
{
    global $con;
    $productSizeId = $_REQUEST['productSizeId'];
    $productSizeName = $_REQUEST['productSizeName'];
    ?>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Ingredient Name</th>
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //                                    $productId = $productDetails['id'];
        $result = getAllDataOfProductIngredientTableFromProductSizeId($productSizeId);
        $i = 1;
        foreach ($result as $key => $value) {

            $id = $result[$key]['id'];



        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><b>
                        <?php $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                        echo $ingredientDetails['ingredient_name'];
                        //                                                $weightDetails = getDefaultWeightInNameFromIngredientId($ingredientDetails['id']);
                        // echo " (".$weightDetails.")";
                        ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['ingredient_amount']; ?></b></td>
                <td class="text-center"><b>
                        <?php
                        $ingredientDefaultWeightName = getDefaultWeightInNameFromIngredientId($result[$key]['ingredient_id']);
                        echo $ingredientDefaultWeightName;
                        $productAllDetails = getProductDetailsFromId($result[$key]['product_id']);
                        $productName = $productAllDetails['name'];
                        ?>
                    </b></td>

                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">

                                <a class="dropdown-item bg-default" href="#" onclick="promtEditProduct('<?php echo $id; ?>', '<?php echo $ingredientDetails['ingredient_name']; ?>', '<?php echo $result[$key]['ingredient_amount']; ?>', '<?php echo $ingredientDefaultWeightName; ?>','<?php echo $productName; ?>','<?php echo $productSizeName; ?>')">Edit</a>

                                <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product ? Once Done, It Can Not Be Undone !','product_ingredients','<?php echo $id; ?>','0')">Delete</a>
                            </div>
                        </button>
                    </div>
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
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </tfoot>
<?php

    //echo "give me my html 1st";
}


// Product Option Title Functions

function saveProductOptionTitle()
{
    global $con;


    $addProductOptionTitleProductId = $_REQUEST['productId'];
    $addProductOptionTitleProductSizeId = $_REQUEST['productSizeId'];
    $addProductOptionTitleTitle = $_REQUEST['title'];
    $addProductOptionTitleOptionType = $_REQUEST['optionType'];

    $addProductOptionTitleCreatedBy = $_SESSION['user_id']; // will be session user id, 1 is used for demo purpuse only



    $sql = "INSERT INTO `product_option_title` (`product_id`, `product_size_id`, `title`, `option_type`, `created_by`) VALUES ('$addProductOptionTitleProductId', '$addProductOptionTitleProductSizeId', '$addProductOptionTitleTitle', '$addProductOptionTitleOptionType', '$addProductOptionTitleCreatedBy')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveEditProductOptionTitle()
{

    global $con;

    $editProductProductOptionTitleId = $_REQUEST['id'];
    $editProductProductOptionTitleTitle = $_REQUEST['title'];
    $editProductProductOptionTitleOptionType = $_REQUEST['optionType'];



    $sql = "UPDATE `product_option_title` SET 
                                    `title` = '$editProductProductOptionTitleTitle', 
                                    `option_type` = '$editProductProductOptionTitleOptionType' 
                                WHERE `product_option_title`.`id` = '$editProductProductOptionTitleId'";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function getAllAddedProductOptionTitleFromProductSizeFromProductSizeIdAsDataTable()
{
    $productSizeId = $_REQUEST['productSizeId'];
?>



    <thead>
        <tr>
            <th>Sl No</th>
            <th>Product Name</th>
            <th>Product Size Name </th>
            <th>Option Title</th>
            <th>Option type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = getAllDataOfProductOptionTitleTableFromProductSizeId($productSizeId);
        $i = 1;
        foreach ($result as $key => $value) {

            $id = $result[$key]['id'];
        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><b><?php
                                            $productAllDetails = getProductDetailsFromId($result[$key]['product_id']);
                                            echo $productName = $productAllDetails['name'];

                                            ?></b></td>
                <td class="text-center"><b><?php $getProductSizeName = getProductSizeDetailsFromProductSizeId($result[$key]['product_size_id']);
                                            echo $getProductSizeName['name']; ?></b></td>
                <td class="text-center"><b>
                        <?php
                        echo $result[$key]['title'];
                        ?>
                    </b>

                </td>
                <td class="text-center"><b>
                        <?php
                        echo $result[$key]['option_type'];
                        ?>
                    </b>
                </td>

                <?php
                if ($result[$key]['status'] == 1) {
                    $colorClass = "bg-success";
                    $statusValue = "Active";
                } else {
                    $colorClass = "bg-danger";
                    $statusValue = "Deactive";
                }
                ?>
                <td class="text-center <?php echo $colorClass; ?>"><?php echo $statusValue; ?></td>

                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">

                                <a class="dropdown-item bg-default" href="#" onclick="promtEditProduct('<?php echo $id; ?>', '<?php echo $productName; ?>', '<?php echo $getProductSizeName['name']; ?>', '<?php echo $result[$key]['title']; ?>','<?php echo $result[$key]['option_type']; ?>')">Edit</a>

                                <a class="dropdown-item bg-info" href="#" onclick="window.location.href='product_options_add.php?userId=<?php echo $result[$key]['product_id']; ?>&title=<?php echo $id; ?>'">Add Options</a>

                                <?php if ($result[$key]['status'] == 1) { ?>
                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Product  Option Title ?','product_option_title','<?php echo $id; ?>','2')">Deactivate</a>
                                <?php
                                } else {
                                ?>
                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Product  Option Title ?','product_option_title','<?php echo $id; ?>','1')">Activate</a>
                                <?php
                                }
                                ?>

                                <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product Option Title ? Once Done, It Can Not Be Undone !','product_option_title','<?php echo $id; ?>','0')">Delete</a>
                            </div>
                        </button>
                    </div>
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
            <th>Product Name</th>
            <th>Product Size Name </th>
            <th>Option Title</th>
            <th>Option type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </tfoot>



    <?php
}

function getProductOptionTitleFromProductSizeIdAsHtmlOption()
{
    global $con;
    $sizeId = $_REQUEST['sizeId'];
    $productTitle = getAllDataOfProductOptionTitleTableFromProductSizeId($sizeId);

    foreach ($productTitle as $key => $value) {
    ?>
        <option value="<?php echo $productTitle[$key]['id'] ?>"><?php echo $productTitle[$key]['title'] ?></option>
    <?php
    }
}

function saveProductOption()
{
    global $con;

    $productId = $_REQUEST['productId'];
    $productSizeId = $_REQUEST['productSizeId'];
    $productTitleId = $_REQUEST['productTitleId'];
    $productOptionName = $_REQUEST['productOptionName'];
    $productOptionImage = $_REQUEST['productOptionImage'];
    $productOptionExtraMoneyAdded = $_REQUEST['productOptionExtraMoneyAdded'];
    $productOptionOfferExtraMoneyAdded = $_REQUEST['productOptionOfferExtraMoneyAdded'];
    $productOptionOfferFrom = $_REQUEST['productOptionOfferFrom'];
    $productOptionOfferTo = $_REQUEST['productOptionOfferTo'];



    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only


    list($type, $productOptionImage) = explode(';', $productOptionImage);
    list(, $productOptionImage)      = explode(',', $productOptionImage);


    $productOptionImage = base64_decode($productOptionImage);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $productOptionImage);

    $sql = "INSERT INTO `product_option` (`product_id`, `product_size_id`, `product_title_id`, `name`, `created_by`, `image`, `extra_money_added`, `offer_money_added`, `offer_money_from`, `offer_money_to`) VALUES ('$productId', '$productSizeId', '$productTitleId', '$productOptionName', '$userId', '$imageName', '$productOptionExtraMoneyAdded', '$productOptionOfferExtraMoneyAdded', '$productOptionOfferFrom', '$productOptionOfferTo')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function getAllAddedProductOptionFromProductTitleAsDataTable()
{

    $productOptionTitleId = $_REQUEST['titleId'];

    ?>


    <thead>
        <tr>
            <th>Sl No</th>
            <th>Image</th>
            <th>Option Name</th>
            <th>Title Name</th>
            <th>Extra Price</th>
            <th>Offer Price</th>
            <th>Offer Price Starts</th>
            <th>Offer Price Ends</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = getAllDataOfProductOptionTableFromProductTitleId($productOptionTitleId);
        $i = 1;
        foreach ($result as $key => $value) {

            $id = $result[$key]['id'];
        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center">
                    <div>
                        <img src="images/<?php echo $result[$key]['image']; ?>" width="auto" height="100px">
                    </div>
                </td>
                <td class="text-center"><b><?php echo $result[$key]['name']; ?></b></td>
                <td class="text-center"><b><?php $titleName = getDetailsOfProductTitleTableFromId($result[$key]['product_title_id']);
                                            echo $titleName['title']; ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['extra_money_added']; ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['offer_money_added']; ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['offer_money_from']; ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['offer_money_to']; ?></b></td>

                <?php
                if ($result[$key]['status'] == 1) {
                    $colorClass = "bg-success";
                    $statusValue = "Active";
                } else {
                    $colorClass = "bg-danger";
                    $statusValue = "Deactive";
                }
                ?>
                <td class="text-center <?php echo $colorClass; ?>"><?php echo $statusValue; ?></td>

                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">

                                <a class="dropdown-item bg-default" href="#" onclick="promtEditProductAddon('<?php echo $id; ?>', '<?php echo $result[$key]['extra_money_added']; ?>', '<?php echo $result[$key]['offer_money_added']; ?>', '<?php echo $result[$key]['offer_money_from']; ?>','<?php echo $result[$key]['offer_money_to']; ?>')">Edit</a>

                                <?php if ($result[$key]['status'] == 1) { ?>
                                    <a class="dropdown-item bg-warning" href="#" onclick="statusToggler('Do You Want To Deactivate The Product ?','product_option','<?php echo $id; ?>','2')">Deactivate</a>
                                <?php
                                } else {
                                ?>
                                    <a class="dropdown-item bg-success" href="#" onclick="statusToggler('Do You Want To Activate The Product ?','product_option','<?php echo $id; ?>','1')">Activate</a>
                                <?php
                                }
                                ?>
                                <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product ? Once Done, It Can Not Be Undone !','product_option','<?php echo $id; ?>','0')">Delete</a>
                            </div>
                        </button>
                    </div>
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
            <th>Image</th>
            <th>Option Name</th>
            <th>Title Name</th>
            <th>Extra Price</th>
            <th>Offer Price</th>
            <th>Offer Price Starts</th>
            <th>Offer Price Ends</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </tfoot>


    <?php

}

function getAllProductOptionFromProductTitleIdAsHtmlOption()
{
    //$('#divId').html(response);

    global $con;
    $productTileId = $_REQUEST['productTileId'];
    $query = $con->query("select * from product_option WHERE product_title_id =" . $productTileId);
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
    <?php
    }
}


function saveProductOptionIngredients()
{
    global $con;

    $productId = $_REQUEST['productId'];
    $productSizeId = $_REQUEST['productSizeId'];
    $productOptionTitleId = $_REQUEST['productOptionTitleId'];
    $productOptionId = $_REQUEST['productOptionId'];
    $productOptionIngredientId = $_REQUEST['productOptionIngredientId'];
    $productOptionIngredientAmount = $_REQUEST['productOptionIngredientAmount'];



    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only



    $sql = "INSERT INTO `product_option_ingredients` (`product_id`, `product_size_id`, `product_option_title_id`, `product_option_id`, `ingredient_id`, `ingredient_amount`, `created_by`) VALUES ('$productId', '$productSizeId', '$productOptionTitleId', '$productOptionId', '$productOptionIngredientId', '$productOptionIngredientAmount', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function getAllUnaddedIngredientDetailsForAddingFromProductOptionIdAsHtmlOptions()
{
    global $con;

    $productOptionId = $_REQUEST['productOptionId'];

    $branchId = $_SESSION['user_branch_id']; // session user sub branch id, 1 is for demo only 
    $subBranchId = "0"; //$_SESSION['user_sub_branch_id']; // session user sub branch id, 1 is for demo only 

    //generate ingredients ids that are not yet used.


    $sql = "SELECT t1.id
            FROM ingredients t1
            LEFT JOIN product_option_ingredients t2 ON t2.ingredient_id = t1.id AND t2.product_option_id = $productOptionId 
            WHERE t2.id IS NULL AND t1.branch_id= $branchId";


    $query = $con->query($sql);

    $result = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $query2 = $con->query("select * from ingredients WHERE id = " . $row['id']);

        $row2 = mysqli_fetch_array($query2);

        array_push($result, $row2);
    }

    foreach ($result as $key => $value) {
    ?>

        <option value="<?php echo $result[$key]['id']; ?>"><?php echo $result[$key]['ingredient_name'] . " (" . getWeightNameFromId($result[$key]['default_weight_in']) . ")"; ?></option>

    <?php
    }
}


function getAllAddedIngredientFromProductOptionIdAsDataTable()
{
    global $con;
    $productOptionId = $_REQUEST['productOptionId'];
    ?>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Ingredient Name</th>
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //                                    $productId = $productDetails['id'];
        $result = getAllDataOfProductOptionIngredientTableFromProductOptionId($productOptionId);
        $i = 1;
        foreach ($result as $key => $value) {

            $id = $result[$key]['id'];



        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><b>
                        <?php $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                        echo $ingredientDetails['ingredient_name'];
                        //                                                $weightDetails = getDefaultWeightInNameFromIngredientId($ingredientDetails['id']);
                        // echo " (".$weightDetails.")";
                        ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['ingredient_amount']; ?></b></td>
                <td class="text-center"><b>
                        <?php
                        $ingredientDefaultWeightName = getDefaultWeightInNameFromIngredientId($result[$key]['ingredient_id']);
                        echo $ingredientDefaultWeightName;
                        ?>
                    </b></td>

                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">
                                <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product ? Once Done, It Can Not Be Undone !','product_option_ingredients','<?php echo $id; ?>','0')">Delete</a>
                            </div>
                        </button>
                    </div>
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
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </tfoot>
    <?php

    //echo "give me my html 1st";
}


function saveProductAddon()
{
    global $con;

    $productId = $_REQUEST['productId'];
    $productAddonName = $_REQUEST['productAddonName'];
    $productAddonExtraMoneyAdded = $_REQUEST['productAddonExtraMoneyAdded'];
    $productAddonOfferMoneyAdded = $_REQUEST['productAddonOfferMoneyAdded'];
    $productAddonOfferMoneyFrom = $_REQUEST['productAddonOfferMoneyFrom'];
    $productAddonOfferMoneyTo = $_REQUEST['productAddonOfferMoneyTo'];
    $productAddonImage = $_REQUEST['productAddonImage'];


    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only


    list($type, $productAddonImage) = explode(';', $productAddonImage);
    list(, $productAddonImage)      = explode(',', $productAddonImage);


    $productAddonImage = base64_decode($productAddonImage);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $productAddonImage);

    $sql = "INSERT INTO `product_addons` (`product_id`, `name`, `extra_money_added`, `offer_money_added`, `offer_money_from`, `offer_money_to`, `image`, `created_by`) VALUES ('$productId', '$productAddonName', '$productAddonExtraMoneyAdded', '$productAddonOfferMoneyAdded', '$productAddonOfferMoneyFrom', '$productAddonOfferMoneyTo', '$imageName', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function saveSubCategoryAddon()
{
    global $con;

    $subCategoryId = $_REQUEST['subCategoryId'];
    $subCategoryAddonName = $_REQUEST['subCategoryAddonName'];
    $subCategoryAddonExtraMoneyAdded = $_REQUEST['subCategoryAddonExtraMoneyAdded'];
    $subCategoryAddonOfferMoneyAdded = $_REQUEST['subCategoryAddonOfferMoneyAdded'];
    $subCategoryAddonOfferMoneyFrom = $_REQUEST['subCategoryAddonOfferMoneyFrom'];
    $subCategoryAddonOfferMoneyTo = $_REQUEST['subCategoryAddonOfferMoneyTo'];
    $subCategoryAddonImage = $_REQUEST['subCategoryAddonImage'];


    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only


    list($type, $subCategoryAddonImage) = explode(';', $subCategoryAddonImage);
    list(, $subCategoryAddonImage)      = explode(',', $subCategoryAddonImage);


    $subCategoryAddonImage = base64_decode($subCategoryAddonImage);
    $imageName = round(microtime(true) * 1000) . $userId . '.png';
    file_put_contents('images/' . $imageName, $subCategoryAddonImage);

    $sql = "INSERT INTO `sub_category_addons` (`sub_category_id`, `name`, `extra_money_added`, `offer_money_added`, `offer_money_from`, `offer_money_to`, `image`, `created_by`) VALUES ('$subCategoryId', '$subCategoryAddonName', '$subCategoryAddonExtraMoneyAdded', '$subCategoryAddonOfferMoneyAdded', '$subCategoryAddonOfferMoneyFrom', '$subCategoryAddonOfferMoneyTo', '$imageName', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveEditProductOption()
{
    global $con;
    $productOptionId = $_REQUEST['productOptionId'];
    $productOptionExtraMoneyAdded = $_REQUEST['productOptionExtraMoneyAdded'];
    $productOptionOfferMoneyAdded = $_REQUEST['productOptionOfferMoneyAdded'];
    $productOptionOfferMoneyFrom = $_REQUEST['productOptionOfferMoneyFrom'];
    $productOptionOfferMoneyTo = $_REQUEST['productOptionOfferMoneyTo'];



    $sql = "UPDATE `product_option` SET 
                                    `extra_money_added` = '$productOptionExtraMoneyAdded', 
                                    `offer_money_added` = '$productOptionOfferMoneyAdded', 
                                    `offer_money_from` = '$productOptionOfferMoneyFrom', 
                                    `offer_money_to` = '$productOptionOfferMoneyTo'
                                WHERE `product_option`.`id` = '$productOptionId'";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function getAllUnaddedIngredientDetailsForAddingFromProductAddonIdAsHtmlOptions()
{
    global $con;

    $productAddonId = $_REQUEST['productAddonId'];

    $branchId = $_SESSION['user_branch_id']; // session user sub branch id, 1 is for demo only 
    $subBranchId = "0"; //$_SESSION['user_sub_branch_id']; // session user sub branch id, 1 is for demo only 

    //generate ingredients ids that are not yet used.

    $sql = "SELECT t1.id
            FROM ingredients t1
            LEFT JOIN product_addons_ingredients t2 ON t2.ingredient_id = t1.id AND t2.product_addon_id = $productAddonId 
            WHERE t2.id IS NULL AND t1.branch_id= $branchId";


    $query = $con->query($sql);

    $result = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $query2 = $con->query("select * from ingredients WHERE id = " . $row['id']);

        $row2 = mysqli_fetch_array($query2);

        array_push($result, $row2);
    }

    foreach ($result as $key => $value) {
    ?>

        <option value="<?php echo $result[$key]['id']; ?>"><?php echo $result[$key]['ingredient_name'] . " (" . getWeightNameFromId($result[$key]['default_weight_in']) . ")"; ?></option>

    <?php
    }
}


function getAllAddedIngredientFromProductAddonIdAsDataTable()
{
    global $con;
    $productAddonId = $_REQUEST['productAddonId'];
    ?>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Ingredient Name</th>
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //                                    $productId = $productDetails['id'];
        $result = getDetailsOfProductAddonIngredientTableFromProductAddonId($productAddonId);
        $i = 1;
        foreach ($result as $key => $value) {

            $id = $result[$key]['id'];



        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><b>
                        <?php $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                        echo $ingredientDetails['ingredient_name'];
                        //                                                $weightDetails = getDefaultWeightInNameFromIngredientId($ingredientDetails['id']);
                        // echo " (".$weightDetails.")";
                        ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['ingredient_amount']; ?></b></td>
                <td class="text-center"><b>
                        <?php
                        $ingredientDefaultWeightName = getDefaultWeightInNameFromIngredientId($result[$key]['ingredient_id']);
                        echo $ingredientDefaultWeightName;
                        ?>
                    </b></td>

                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">
                                <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Product ? Once Done, It Can Not Be Undone !','product_addons_ingredients','<?php echo $id; ?>','0')">Delete</a>
                            </div>
                        </button>
                    </div>
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
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </tfoot>
    <?php

}


function saveEditProductAddon()
{
    global $con;
    $productAddonId = $_REQUEST['productAddonId'];
    $productAddonExtraMoneyAdded = $_REQUEST['productAddonExtraMoneyAdded'];
    $productAddonOfferMoneyAdded = $_REQUEST['productAddonOfferMoneyAdded'];
    $productAddonOfferMoneyFrom = $_REQUEST['productAddonOfferMoneyFrom'];
    $productAddonOfferMoneyTo = $_REQUEST['productAddonOfferMoneyTo'];



    $sql = "UPDATE `product_addons` SET 
                                    `extra_money_added` = '$productAddonExtraMoneyAdded', 
                                    `offer_money_added` = '$productAddonOfferMoneyAdded', 
                                    `offer_money_from` = '$productAddonOfferMoneyFrom', 
                                    `offer_money_to` = '$productAddonOfferMoneyTo' 
                                WHERE `product_addons`.`id` = '$productAddonId'";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveProductAddonIngredients()
{
    global $con;

    $productId = $_REQUEST['productId'];
    $productAddonId = $_REQUEST['productAddonId'];
    $productAddonIngredientId = $_REQUEST['productAddonIngredientId'];
    $productAddonIngredientAmount = $_REQUEST['productAddonIngredientAmount'];



    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only



    $sql = "INSERT INTO `product_addons_ingredients` (`product_id`, `product_addon_id`, `ingredient_id`, `ingredient_amount`, `created_by`) VALUES ('$productId', '$productAddonId', '$productAddonIngredientId', '$productAddonIngredientAmount', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function getAllUnaddedIngredientDetailsForAddingFromSubCategoryAddonIdAsHtmlOptions()
{
    global $con;

    $subCategoryAddonId = $_REQUEST['subCategoryAddonId'];

    $branchId = $_SESSION['user_branch_id']; // session user sub branch id, 1 is for demo only 
    $subBranchId = "0"; //$_SESSION['user_sub_branch_id']; // session user sub branch id, 1 is for demo only 

    //generate ingredients ids that are not yet used.

    $sql = "SELECT t1.id
            FROM ingredients t1
            LEFT JOIN sub_category_addons_ingredients t2 ON t2.ingredient_id = t1.id AND t2.sub_category_addon_id = $subCategoryAddonId 
            WHERE t2.id IS NULL AND t1.branch_id= $branchId";


    $query = $con->query($sql);

    $result = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

        $query2 = $con->query("select * from ingredients WHERE id = " . $row['id']);

        $row2 = mysqli_fetch_array($query2);

        array_push($result, $row2);
    }

    foreach ($result as $key => $value) {
    ?>

        <option value="<?php echo $result[$key]['id']; ?>"><?php echo $result[$key]['ingredient_name'] . " (" . getWeightNameFromId($result[$key]['default_weight_in']) . ")"; ?></option>

    <?php
    }
}


function getAllAddedIngredientFromSubCategoryAddonIdAsDataTable()
{
    global $con;
    $subCategoryAddonId = $_REQUEST['subCategoryAddonId'];
    ?>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Ingredient Name</th>
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //                                    $subCategoryId = $subCategoryDetails['id'];
        $result = getDetailsOfSubCategoryAddonIngredientTableFromSubCategoryAddonId($subCategoryAddonId);
        $i = 1;
        foreach ($result as $key => $value) {

            $id = $result[$key]['id'];



        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><b>
                        <?php $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                        echo $ingredientDetails['ingredient_name'];
                        //                                                $weightDetails = getDefaultWeightInNameFromIngredientId($ingredientDetails['id']);
                        // echo " (".$weightDetails.")";
                        ?></b></td>
                <td class="text-center"><b><?php echo $result[$key]['ingredient_amount']; ?></b></td>
                <td class="text-center"><b>
                        <?php
                        $ingredientDefaultWeightName = getDefaultWeightInNameFromIngredientId($result[$key]['ingredient_id']);
                        echo $ingredientDefaultWeightName;
                        ?>
                    </b></td>

                <td class="text-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">
                                <a class="dropdown-item bg-danger" href="#" onclick="statusToggler('Do You Want To Delete The Addon ? Once Done, It Can Not Be Undone !','sub_category_addons_ingredients','<?php echo $id; ?>','0')">Delete</a>
                            </div>
                        </button>
                    </div>
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
            <th>Amount </th>
            <th>Default Weight In</th>
            <th>Option</th>
        </tr>
    </tfoot>
<?php

}


function saveEditSubCategoryAddon()
{
    global $con;
    $subCategoryAddonId = $_REQUEST['subCategoryAddonId'];
    $subCategoryAddonExtraMoneyAdded = $_REQUEST['subCategoryAddonExtraMoneyAdded'];
    $subCategoryAddonOfferMoneyAdded = $_REQUEST['subCategoryAddonOfferMoneyAdded'];
    $subCategoryAddonOfferMoneyFrom = $_REQUEST['subCategoryAddonOfferMoneyFrom'];
    $subCategoryAddonOfferMoneyTo = $_REQUEST['subCategoryAddonOfferMoneyTo'];



    $sql = "UPDATE `sub_category_addons` SET 
                                    `extra_money_added` = '$subCategoryAddonExtraMoneyAdded', 
                                    `offer_money_added` = '$subCategoryAddonOfferMoneyAdded', 
                                    `offer_money_from` = '$subCategoryAddonOfferMoneyFrom', 
                                    `offer_money_to` = '$subCategoryAddonOfferMoneyTo' 
                                WHERE `sub_category_addons`.`id` = '$subCategoryAddonId'";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveSubCategoryAddonIngredients()
{
    global $con;

    $subCategoryId = $_REQUEST['subCategoryId'];
    $subCategoryAddonId = $_REQUEST['subCategoryAddonId'];
    $subCategoryAddonIngredientId = $_REQUEST['subCategoryAddonIngredientId'];
    $subCategoryAddonIngredientAmount = $_REQUEST['subCategoryAddonIngredientAmount'];



    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only



    $sql = "INSERT INTO `sub_category_addons_ingredients` (`sub_category_id`, `sub_category_addon_id`, `ingredient_id`, `ingredient_amount`, `created_by`) VALUES ('$subCategoryId', '$subCategoryAddonId', '$subCategoryAddonIngredientId', '$subCategoryAddonIngredientAmount', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function getAllIngredientDetailsAsHtmlOptions()
{

    global $con;

    $branchId = $_SESSION['user_branch_id']; // session user sub branch id, 1 is for demo only 
    $subBranchId = "0"; //$_SESSION['user_sub_branch_id']; // session user sub branch id, 1 is for demo only 

    $newId = $_REQUEST['newId'];

    //generate ingredients ids that are not yet used.

?>
    <div class="singleRow">


        <div class="row classForRowAdding" id="<?php echo 'r' . $newId; ?>">
            <div class="col-md-5">
                <div class="form-group">
                    <label>Select An Ingredient </label>
                    <select class="form-control ingCount" name="ingredientName[]">
                        <option value="null" selected disabled>--Select An Ingredient--</option>
                        <?php
                        $sql = "SELECT * FROM ingredients WHERE status > 0 AND branch_id = '$branchId'";


                        $query = $con->query($sql);
                        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['ingredient_name'] . " (" . getWeightNameFromId($row['default_weight_in']) . ")"; ?></option>
                        <?php

                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Needed Amount </label>
                    <input class="form-control" name="ingredientAmount[]" value="0">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Delete This Row</label><br>
                    <button class="btn btn-danger" onclick="deleteRow('<?php echo 'r' . $newId; ?>')">
                        <i class="fas fa-minus-circle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php

}


function saveRequisition()
{
    global $con;

    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only

    $userType = $_SESSION['user_type'];

    //print_r($_SESSION);

    $addRequisitionUniqueId = round(microtime(true) * 1000) . $userId;
    $addRequisitionBranchId = $_SESSION['user_branch_id'];
    $addRequisitionSubBranchId = $_SESSION['user_sub_branch_id'];
    $addRequisitionCreatedBy = $userId;
    $addRequisitionIngredientId = $_REQUEST['ingredientId'];
    $addRequisitionIngredientAmount = $_REQUEST['ingredientAmount'];
    $addRequisitionRemarks = $_REQUEST['remarks'];


    if ($userType == 3 || $userType == 4) {
        $addRequisitionStatus = 1;
    } elseif ($userType == 2) {
        $addRequisitionStatus = 2;
    } else {
        $addRequisitionStatus = 0;
    }


    $sql = "INSERT INTO `requisition_process` (`unique_requisition_id`, `branch_id`, `sub_branch_id`, `created_by`, `remarks`, `status`) VALUES ('$addRequisitionUniqueId', '$addRequisitionBranchId', '$addRequisitionSubBranchId', '$addRequisitionCreatedBy', '$addRequisitionRemarks', '$addRequisitionStatus')";



    if ($con->query($sql)) {

        $i = 0;
        foreach ($addRequisitionIngredientId as $key => $value) {

            $defaultWeightRow = getIngredientDetailsFromId($addRequisitionIngredientId[$key]);
            $defaultWeight = $defaultWeightRow['default_weight_in'];

            if ($addRequisitionStatus == 1) {
                $waiterRequisitionDate = date("Y-m-d H:i:s");
                $managerRequisitionDate = NULL;
            } elseif ($addRequisitionStatus == 2) {
                $waiterRequisitionDate = NULL;
                $managerRequisitionDate = date("Y-m-d H:i:s");
            } else {
                $waiterRequisitionDate = date("Y-m-d H:i:s");
                $managerRequisitionDate = date("Y-m-d H:i:s");
            }

            $sql = "INSERT INTO `requisition_items` (`unique_requisition_id`, `branch_id`, `sub_branch_id`, `ingredient_id`, `ingredient_unit_id`, `waiter_requisition_amount`, `sub_manager_requisition_amount`, `admin_requisition_amount`, `waiter_requisition_date`, `sub_manager_requisition_date`) VALUES ('$addRequisitionUniqueId', '$addRequisitionBranchId', '$addRequisitionSubBranchId', '$addRequisitionIngredientId[$key]', '$defaultWeight', '$addRequisitionIngredientAmount[$key]','$addRequisitionIngredientAmount[$key]','$addRequisitionIngredientAmount[$key]', '$waiterRequisitionDate', '$managerRequisitionDate')";

            if ($con->query($sql)) {
                $i++;
            }
        }
        if (count($addRequisitionIngredientId) == $i) {
            echo "1";
        }
    } else {
        echo "0";
    }
}


function viewRequisition()
{

    global $con;

    $uniqueId = $_REQUEST['uniqueId'];
    $requisitionDate = $_REQUEST['requisitionDate'];
    $requisitionGivenBy = $_REQUEST['requisitionGivenBy'];
    $status = $_REQUEST['status'];

?>
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="overflow-x: auto;">
            <div class="modal-header">
                <h4 class="modal-title">Edit Requisition</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                // $uniqueId = '16025891515195';
                // $requisitionDate = '2020-10-13 11:38:02';
                // $status = '2';
                // $requisitionGivenBy = '5';
                $userDetails = getUserDetailsFromId($requisitionGivenBy);
                $userType = $userDetails['user_type'];

                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Requisition Id</label>
                            <input type="text" class="form-control" id="editRequisitionUniqueId" value="<?php echo $uniqueId; ?>" required readonly><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Requisition Date</label>
                            <input type="text" class="form-control" id="editRequisitionDate" value="<?php echo $requisitionDate; ?>" required readonly><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" style="overflow: scroll; overflow: auto;">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Ingredient Name</th>
                                    <th style="width: 100px">In Stock<br>(As of <?php echo date('d-M H:m'); ?>)</th>
                                    <th style="width: 175px">Last Pur Price<br>Last Pur Date</th>
                                    <th style="width: 185px">Waiter/Staff Amount</th>
                                    <th style="width: 185px">Manager Amount</th>
                                    <th style="width: 185px">Admin Amount</th>
                                    <th style="width: 185px">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $result = getAllDataOfRequisitionItemTableFromRequisitionUniqueId($uniqueId);
                                $i = 1;
                                foreach ($result as $key => $value) {
                                    $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                                    $stockTableData = getIngredientStockDetailsFromIngredientId($result[$key]['ingredient_id']);
                                ?>
                                    <tr>
                                        <input type="hidden" name="itemTableId[]" value="<?php echo $result[$key]['id']; ?>">
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo "images/" . $ingredientDetails['image']; ?>" alt="<?php echo $ingredientDetails['ingredient_name'];  ?>" height="100px" width="auto"></td>
                                        <td><?php echo $ingredientDetails['ingredient_name'];  ?></td>
                                        <td><?php echo $stockTableData['ingredient_stock_amount'] . " " . $stockTableData['ingredient_weight_in']; ?></td>
                                        <td><?php echo $stockTableData['ingredient_last_bought_price'] . "/- Per " . $stockTableData['ingredient_weight_in'] . "<br>" . $stockTableData['ingredient_last_stock_in']; ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <?php
                                                    $showWeightIn = true;
                                                    if ($status == 1) {
                                                        if ($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
                                                    ?>
                                                            <input class="form-control text-center" type="number" name="waiterAmount[]" value="<?php echo $result[$key]['waiter_requisition_amount']; ?>">
                                                    <?php
                                                        } else {
                                                            echo $result[$key]['waiter_requisition_amount'];
                                                        }
                                                    } elseif ($status > 1) {
                                                        if ($userType == 2) {
                                                            echo "No input found!";
                                                            $showWeightIn = false;
                                                        } else {
                                                            echo $result[$key]['waiter_requisition_amount'];
                                                        }
                                                    } else {
                                                        echo "No input found!";
                                                        $showWeightIn = false;
                                                    }

                                                    ?>
                                                </div>
                                                <?php
                                                if ($showWeightIn) {
                                                ?>

                                                    <div class="col-md-3 text-left">
                                                        <?php
                                                        $weight = getWeightDetailsFromId($result[$key]['ingredient_unit_id']);
                                                        echo $weight['name'];
                                                        ?>
                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <?php
                                                    $showWeightIn = true;
                                                    if ($status == 1) {
                                                        if ($_SESSION['user_type'] == 2) {
                                                    ?>
                                                            <input class="form-control text-center" type="number" name="managerAmount[]" value="<?php echo $result[$key]['sub_manager_requisition_amount']; ?>">
                                                        <?php
                                                        } else {
                                                            echo "No Input Found!";
                                                            $showWeightIn = false;
                                                        }
                                                    } elseif ($status == 2) {
                                                        if ($_SESSION['user_type'] == 2) {
                                                        ?>
                                                            <input class="form-control text-center" type="number" name="managerAmount[]" value="<?php echo $result[$key]['sub_manager_requisition_amount']; ?>">
                                                    <?php
                                                        } else {
                                                            echo $result[$key]['sub_manager_requisition_amount'];;
                                                        }
                                                    } else {
                                                        echo $result[$key]['sub_manager_requisition_amount'];
                                                    }

                                                    ?>
                                                </div>
                                                <?php
                                                if ($showWeightIn) {
                                                ?>

                                                    <div class="col-md-3 text-left">
                                                        <?php
                                                        $weight = getWeightDetailsFromId($result[$key]['ingredient_unit_id']);
                                                        echo $weight['name'];
                                                        ?>
                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <?php
                                                    $showWeightIn = true;
                                                    if ($status == 1) {
                                                        echo "not yet approved by Manager !";
                                                        $showWeightIn = false;
                                                    } elseif ($status == 2) {
                                                        if ($_SESSION['user_type'] == 1) {
                                                    ?>
                                                            <input class="form-control text-center" type="number" name="adminAmount[]" value="<?php echo $result[$key]['admin_requisition_amount']; ?>">
                                                    <?php
                                                        } else {
                                                            echo "No Input Found!";
                                                            $showWeightIn = false;
                                                        }
                                                    } else {
                                                        echo $result[$key]['admin_requisition_amount'];
                                                    }

                                                    ?>
                                                </div>
                                                <?php
                                                if ($showWeightIn) {
                                                ?>

                                                    <div class="col-md-3 text-left">
                                                        <?php
                                                        $weight = getWeightDetailsFromId($result[$key]['ingredient_unit_id']);
                                                        echo $weight['name'];
                                                        ?>
                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            if (($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) && $status > 1) {
                                                echo "No Action To Take!";
                                            } elseif ($_SESSION['user_type'] == 2 && $status == 2) {
                                            ?>
                                                <button class="btn btn-danger" onclick="statusToggler('Do You Want To Delete The Ingredient ? Once Done, It Can Not Be Undone !','requisition_items','<?php echo $result[$key]['id']; ?>','0')">Delete</button>
                                            <?php
                                            } elseif (($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) && $status == 1) {
                                            ?>
                                                <button class="btn btn-danger" onclick="statusToggler('Do You Want To Delete The Ingredient ? Once Done, It Can Not Be Undone !','requisition_items','<?php echo $result[$key]['id']; ?>','0')">Delete</button>
                                            <?php
                                            } else {
                                                echo "No Action To Take!";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">

                <?php
                if ($status == 1) {
                    if ($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
                ?>
                        <button type="button" class="btn btn-info" onclick="updateRequisitionForm('waiterAmount', 'waiter_requisition_amount', '1')">Update Requisition</button>
                    <?php
                    } elseif ($_SESSION['user_type'] == 2) {
                    ?>
                        <button type="button" class="btn btn-info" onclick="updateRequisitionForm('managerAmount', 'sub_manager_requisition_amount', '1')">Update Requisition</button>
                        <button type="button" class="btn btn-success" onclick="updateRequisitionForm('managerAmount', 'sub_manager_requisition_amount', '2')">Approve Requisition</button>
                    <?php
                    } else {
                    }
                } elseif ($status == 2) {
                    if ($_SESSION['user_type'] == 3 || $_SESSION['user_type'] == 4) {
                    } elseif ($_SESSION['user_type'] == 2) {
                    ?>
                        <button type="button" class="btn btn-info" onclick="updateRequisitionForm('managerAmount', 'sub_manager_requisition_amount', '2')">Update Requisition</button>
                    <?php
                    } elseif ($_SESSION['user_type'] == 1) {
                    ?>
                        <button type="button" class="btn btn-success" onclick="updateRequisitionForm('adminAmount', 'admin_requisition_amount', '4')">Approve Requisition</button>
                        <button type="button" class="btn btn-info" onclick="updateRequisitionForm('adminAmount', 'admin_requisition_amount', '2')">Update Requisition</button>
                <?php
                    }
                } else {
                }
                ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<?php

}



function updateRequisition()
{
    global $con;
    $requisitionAmount = $_REQUEST['arrayList'];
    $ids = $_REQUEST['ids'];
    $columnName = $_REQUEST['uName'];
    $status = $_REQUEST['status'];
    $uniqueId = $_REQUEST['uniqueId'];
    $updateDate = date("Y-m-d H:i:s");
    $updatedBy = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only

    $sql = "UPDATE `requisition_process` SET `status` = '$status' WHERE `requisition_process`.`unique_requisition_id` = $uniqueId";

    if ($con->query($sql)) {
        $i = 0;
        foreach ($ids as $key => $value) {
            if ($columnName == 'waiter_requisition_amount') {
                $updateDateColumn = 'waiter_update_date';
                $updateByColumn = 'waiter_update_by';
            } elseif ($columnName == 'sub_manager_requisition_amount') {
                $updateDateColumn = 'sub_manager_update_date';
                $updateByColumn = 'sub_manager_update_by';
                updateRequisitionTime("`sub_manager_requisition_date` = '$updateDate'", $uniqueId);
            } elseif ($columnName == 'admin_requisition_amount') {
                $updateDateColumn = 'admin_update_date';
                $updateByColumn = 'admin_update_by';
                updateRequisitionTime("`admin_requisition_date` = '$updateDate'", $uniqueId);

                if ($status == 3) {
                    sendRequisitionSMSToVendor($uniqueId);
                }
            } else {
            }
            $sql2 = "UPDATE `requisition_items` SET `$columnName` = '$requisitionAmount[$key]', `$updateDateColumn` = '$updateDate', `$updateByColumn` = '$updatedBy'  WHERE `requisition_items`.`id` = $ids[$key]";

            if ($con->query($sql2)) {
                //echo "came here!";
                $i++;
            }
        }

        if (count($ids) == $i) {
            echo "1";
        }
    } else {
        echo "0";
    }
}


function updateRequisitionTime($queryCame, $uniqueId)
{
    global $con;
    $sql = "UPDATE `requisition_items` SET 
                                    " . $queryCame . " 
                                WHERE `requisition_items`.`unique_requisition_id` = '$uniqueId'";

    $con->query($sql);
}


function sendRequisitionSMSToVendor($uniqueId)
{
}


function viewRequisitionInPurchase()
{

    global $con;

    $uniqueId = $_REQUEST['uniqueId'];
    $requisitionDate = $_REQUEST['requisitionDate'];

?>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Requisition Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Requisition Id</label>
                            <input type="text" class="form-control" id="editRequisitionUniqueId" value="<?php echo $uniqueId; ?>" required readonly><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Requisition Date</label>
                            <input type="text" class="form-control" id="editRequisitionDate" value="<?php echo $requisitionDate; ?>" required readonly><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Ingredient Name</th>
                                    <th>Amount</th>
                                    <th style="width: 100px">In Stock<br>(As of <?php echo date('d-M H:m'); ?>)</th>
                                    <th style="width: 175px">Last Pur Price<br>Last Pur Date</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $result = getAllDataOfRequisitionItemTableFromRequisitionUniqueId($uniqueId);
                                $i = 1;
                                foreach ($result as $key => $value) {
                                    $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                                    $stockTableData = getIngredientStockDetailsFromIngredientId($result[$key]['ingredient_id']);
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo "images/" . $ingredientDetails['image']; ?>" alt="<?php echo $ingredientDetails['ingredient_name'];  ?>" height="100px" width="auto"></td>
                                        <td><?php echo $ingredientDetails['ingredient_name'];  ?></td>
                                        <td>
                                            <?php
                                            echo $result[$key]['admin_requisition_amount'];
                                            $weight = getWeightDetailsFromId($result[$key]['ingredient_unit_id']);
                                            echo $weight['name'];
                                            ?>
                                        </td>
                                        <td><?php echo $stockTableData['ingredient_stock_amount'] . " " . $stockTableData['ingredient_weight_in']; ?></td>
                                        <td><?php echo $stockTableData['ingredient_last_bought_price'] . "/- Per " . $stockTableData['ingredient_weight_in'] . "<br>" . $stockTableData['ingredient_last_stock_in']; ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<?php

}


function loadRequisitionItemsForPurchaseAdd()
{
    global $con;
    $uniqueRequisitionId = $_REQUEST['uniqueRequisitionId'];;
?>
    <table class="table table-bordered" id="purchaseAddTable">
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Image</th>
                <th>Ingredient Name</th>
                <th>Requisition Amount</th>
                <th>Purchased Amount</th>
                <th>Purchased Unit Price</th>
                <th>Purchased Total Price</th>
                <th>Purchased Paid</th>
                <th>Expiry Date</th>
                <th>Vendor Name</th>

            </tr>
        </thead>
        <tbody>

            <?php
            $result = getAllDataOfUnaddedRequisitionItemTableFromRequisitionUniqueId($uniqueRequisitionId);
            $i = 1;
            foreach ($result as $key => $value) {
                $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
            ?>

                <tr>
                    <input type="hidden" type="text" name="purchasedRequisitionItemTableId[]" value="<?php echo $result[$key]['id']; ?>">
                    <input type="hidden" type="text" name="purchasedIngredientId[]" value="<?php echo $result[$key]['ingredient_id']; ?>">
                    <td><?php echo $i; ?></td>
                    <td><img src="<?php echo "images/" . $ingredientDetails['image']; ?>" alt="<?php echo $ingredientDetails['ingredient_name'];  ?>" height="100px" width="auto"></td>
                    <td><?php echo $ingredientDetails['ingredient_name']; ?></td>
                    <td>
                        <input type="hidden" type="text" name="purchasedRequisitionAmount[]" value="<?php echo $result[$key]['admin_requisition_amount']; ?>">

                        <?php
                        echo $result[$key]['admin_requisition_amount'] . " ";
                        $weight = getWeightDetailsFromId($result[$key]['ingredient_unit_id']);
                        echo $weight['name'];
                        ?>
                    </td>
                    <td>
                        <input type="number" class="form-control" value="0" name="purchasedAmount[]">
                        <?php
                        echo $weight['name'];
                        ?>
                    </td>
                    <td>
                        <input type="number" class="form-control" value="0" name="purchasedUnitPrice[]">
                    </td>
                    <td>
                        <input type="number" class="form-control" value="0" name="purchasedTotalPrice[]">
                    </td>
                    <td>
                        <input type="number" class="form-control" value="0" name="purchasedTotalPaid[]">
                    </td>
                    <td>
                        <input type="text" class="form-control expiryDate" name="purchasedIngredientExpiryDate[]" placeholder="select expiry date">
                    </td>
                    <td>
                        <select class="form-control select2bs4" style="width: 100%;" name="purchasedVendorId[]">
                            <option selected="selected" value="">Select Vendor</option>
                            <?php $vendorDetails = getAllDataOfVendorTable(""); ?>
                            <?php foreach ($vendorDetails as $data => $key) { ?>

                                <option title="<?php echo "Contact Person: " . $vendorDetails[$data]['contact_person'] . "  ------   Contact Person Number: " . $vendorDetails[$data]['contact_person_mobile']; ?>" value="<?php echo intval($vendorDetails[$data]['id']); ?>"><?php echo $vendorDetails[$data]['company_name']; ?></option>

                            <?php } ?>
                        </select>
                    </td>

                </tr>

            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php
}


function savePurchase()
{
    global $con;

    $purchasedRequisitionItemTableId = $_REQUEST['purchasedRequisitionItemTableId'];
    $purchasedIngredientId = $_REQUEST['purchasedIngredientId'];
    $purchasedRequisitionAmount = $_REQUEST['purchasedRequisitionAmount'];
    $purchasedAmount = $_REQUEST['purchasedAmount'];
    $purchasedUnitPrice = $_REQUEST['purchasedUnitPrice'];
    $purchasedTotalPrice = $_REQUEST['purchasedTotalPrice'];
    $purchasedTotalPaid = $_REQUEST['purchasedTotalPaid'];
    $purchasedVendorId = $_REQUEST['purchasedVendorId'];
    $purchaseDate = $_REQUEST['purchaseDate'];
    $requisitionId = $_REQUEST['requisitionId'];
    $purchasedIngredientExpiryDate = $_REQUEST['purchasedIngredientExpiryDate'];
    $purchasedBoughtBy = $_SESSION['user_id'];
    $purchaseId = round(microtime(true) * 1000) . $purchasedBoughtBy;
    $totalPurchasePrice = 0;
    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    foreach ($purchasedTotalPrice as $key => $value) {
        $totalPurchasePrice = $totalPurchasePrice + $purchasedTotalPrice[$key];
    }


    foreach ($purchasedRequisitionItemTableId as $key => $value) {
        if ($purchasedAmount[$key] > 0) {
            $sql = "UPDATE `requisition_items` SET `purchase_bought_amount` = '$purchasedAmount[$key]', `purchase_bought_by` = '$purchasedBoughtBy', `purchase_bought_date` = '$purchaseDate' WHERE `requisition_items`.`id` = '$purchasedRequisitionItemTableId[$key]'";

            $con->query($sql);
        }
    }


    foreach ($purchasedVendorId as $key => $value) {
        if ($purchasedAmount[$key] > 0) {
            $sql = "INSERT INTO `vendor_bought` (`vendor_id`, `unique_requisition_id`, `unique_purchase_id`, `ingredient_id`, `purchase_amount`, `unit_price`, `total_price`, `created_by`) VALUES ('$purchasedVendorId[$key]', '$requisitionId', '$purchaseId', '$purchasedIngredientId[$key]', '$purchasedAmount[$key]', '$purchasedUnitPrice[$key]', '$purchasedTotalPrice[$key]', '$purchasedBoughtBy'";

            $con->query($sql);

            $sql2 = "UPDATE `vendor` SET `total_purchase` = `total_purchase` + $purchasedTotalPrice[$key] , `total_paid` = `total_paid` + $purchasedTotalPaid[$key] WHERE `id` = $purchasedVendorId[$key]";
            $con->query($sql2);
        }
    }

    $rPData = getAllDataOfRequisitionProcessTable(" AND unique_requisition_id = '$requisitionId'");
    foreach ($rPData as $key => $value) {
        $requisitionBy = $rPData[$key]['created_by'];
        $requisitionAt = $rPData[$key]['created_at'];
    }



    $sql = "INSERT INTO `purchase` (`branch_id`, `sub_branch_id`, `unique_purchase_id`, `unique_requisition_id`, `requisition_by`, `requisition_at`, `created_by`, `total_purchased_amount`) VALUES ('$branchId', '$subBranchId', '$purchaseId', '$requisitionId', '$requisitionBy', '$requisitionAt', '$purchasedBoughtBy', '$totalPurchasePrice')";

    $con->query($sql);



    foreach ($purchasedIngredientId as $key => $value) {
        if ($purchasedAmount[$key] > 0) {
            $sql = "INSERT INTO `purchase_details` (`unique_purchase_id`, `unique_requisition_id`, `ingredient_id`, `ingredient_amount`, `ingredient_unit_price`, `ingredient_expiry_date`, `vendor_id`) VALUES ('$purchaseId', '$requisitionId', '$purchasedIngredientId[$key]', '$purchasedAmount[$key]', '$purchasedUnitPrice[$key]', '$purchasedIngredientExpiryDate[$key]', '$purchasedVendorId[$key]')";

            $con->query($sql);
        }
    }


    foreach ($purchasedIngredientId as $key => $value) {
        if ($purchasedAmount[$key] > 0) {
            $sql = "INSERT INTO `stock` (`branch_id`, `sub_branch_id`, `ingredient_id`, `ingredient_amount`, `purchase_date`, `unique_purchase_id`, `unique_requisition_id`, `ingredient_expiry_date`, `ingredient_unit_price`, `created_by`) VALUES ('$branchId', '$subBranchId', '$purchasedIngredientId[$key]', '$purchasedAmount[$key]', '$purchaseDate', '$purchaseId', '$requisitionId', '$purchasedIngredientExpiryDate[$key]', '$purchasedUnitPrice[$key]', '$purchasedBoughtBy')";

            $con->query($sql);
        }
    }

    if (checkIfAllItemsArePurchased($requisitionId)) {
        $sql = "UPDATE `requisition_process` SET `status` = '5' WHERE `requisition_process`.`unique_requisition_id` = '$requisitionId'";

        $con->query($sql);
    }


}


function viewPurchaseCompletedList()
{

    global $con;

    $uniquePurchaseId = $_REQUEST['uniquePurchaseId'];
    $requisitionDate = $_REQUEST['requisitionDate'];
    $purchaseDate = $_REQUEST['purchaseDate'];

?>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Purchased Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Id</label>
                            <input type="text" class="form-control" value="<?php echo $uniquePurchaseId; ?>" required readonly><br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Requisition Date</label>
                            <input type="text" class="form-control" value="<?php echo $requisitionDate; ?>" required readonly><br>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchased Date</label>
                            <input type="text" class="form-control" id="editRequisitionDate" value="<?php echo $purchaseDate; ?>" required readonly><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Unit Price</th>
                                    <th>Expiry Date</th>
                                    <th>Vendor<br>Mobile No</th>
                                    <th>Requisition Id</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $result = getAllDataOfPurchaseDetailsTableFromPurchaseUniqueId($uniquePurchaseId);
                                $i = 1;
                                foreach ($result as $key => $value) {
                                    $ingredientDetails = getIngredientDetailsFromId($result[$key]['ingredient_id']);
                                    $vendorDetails = getVendorDetailsFromId($result[$key]['vendor_id']);
                                    $weightDetails = getWeightDetailsFromId($ingredientDetails['default_weight_in']);
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo "images/" . $ingredientDetails['image']; ?>" alt="<?php echo $ingredientDetails['ingredient_name'];  ?>" height="100px" width="auto"></td>
                                        <td><?php echo $ingredientDetails['ingredient_name'];  ?></td>
                                        <td>
                                            <?php
                                            echo $result[$key]['ingredient_amount'] . " " . $weightDetails['name'];
                                            ?>
                                        </td>
                                        <td><?php echo $result[$key]['ingredient_unit_price'] . " Per " . $weightDetails['name']; ?></td>
                                        <td><?php echo $result[$key]['ingredient_expiry_date']; ?></td>
                                        <td><?php echo $vendorDetails['company_name'] . "<br>" . $vendorDetails['mobile'];  ?></td>

                                        <td><?php echo $result[$key]['unique_requisition_id']; ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <?php

}


function saveVendor()
{
    global $con;

    $branchId = $_REQUEST['branchId'];
    $subBranchId = "0"; //$_REQUEST['subBranchId'];
    $companyName = $_REQUEST['companyName'];
    $mobile = $_REQUEST['mobile'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $address = $_REQUEST['address'];
    $contactPerson = $_REQUEST['contactPerson'];
    $contactPersonMobile = $_REQUEST['contactPersonMobile'];


    $userId = $_SESSION['user_id']; //session_user_id will be here, 1 for demo purpose only


    $sql = "INSERT INTO `vendor` (`branch_id`, `sub_branch_id`, `company_name`, `mobile`, `phone`, `email`, `address`, `contact_person`, `contact_person_mobile`, `created_by`) VALUES ('$branchId', '$subBranchId', '$companyName', '$mobile', '$phone', '$email', '$address', '$contactPerson', '$contactPersonMobile', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveEditVendor()
{
    global $con;

    $id = $_REQUEST['id'];
    $branchId = $_REQUEST['branchId'];
    $subBranchId = "0"; //$_REQUEST['subBranchId'];
    $companyName = $_REQUEST['companyName'];
    $mobile = $_REQUEST['mobile'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $address = $_REQUEST['address'];
    $contactPerson = $_REQUEST['contactPerson'];
    $contactPersonMobile = $_REQUEST['contactPersonMobile'];


    $sql = "UPDATE `vendor` SET `branch_id` = '$branchId', `sub_branch_id` = '$subBranchId', `company_name` = '$companyName', `mobile` = '$mobile', `phone` = '$phone', `email` = '$email', `address` = '$address', `contact_person` = '$contactPerson', `contact_person_mobile` = '$contactPersonMobile' WHERE `vendor`.`id` = $id";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveVendorCategory()
{
    global $con;
    $branchId = $_REQUEST['branchId'];
    $subBranchId = "0"; //$_REQUEST['subBranchId'];
    $categoryId = $_REQUEST['categoryId'];
    $vendorId = $_REQUEST['vendorId'];

    $sql = "INSERT INTO `vendor_ingredient_category` (`branch_id`, `sub_branch_id`, `category_id`, `vendor_id`) VALUES ('$branchId', '$subBranchId', '$categoryId', '$vendorId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveGuardRequisition()
{
    global $con;
    $requisitionUniqueId = $_REQUEST['requisitionUniqueId'];
    $requisitionItemsTableId = $_REQUEST['requisitionItemsTableId']; //array
    $guardRecivedAmount = $_REQUEST['guardRecivedAmount']; //array

    $guardRecivedDate = date("Y-m-d H:i:s");;
    $guardRecivedBy = $_SESSION['user_id'];

    $i = -1;

    $sql = "UPDATE `requisition_process` SET `status` = '4' WHERE `requisition_process`.`unique_requisition_id` = $requisitionUniqueId";

    if ($con->query($sql)) {
        $i++;
    }

    foreach ($requisitionItemsTableId as $key => $value) {

        $sql = "UPDATE `requisition_items` SET `guard_received_amount` = '$guardRecivedAmount[$key]', `guard_received_by` = '$guardRecivedBy', `guard_received_date` = '$guardRecivedDate' WHERE `requisition_items`.`id` = $requisitionItemsTableId[$key]";

        if ($con->query($sql)) {
            $i++;
        }
    }
    if (count($requisitionItemsTableId) == $i) {
        echo "1";
    } else {
        echo "0";
    }
}


function saveWastage()
{
    global $con;
    $stockIds = $_REQUEST['stockIds']; //array
    $ingredientIds = $_REQUEST['ingredientIds']; //array
    $stockWastageAmount = $_REQUEST['stockWastageAmount']; //array
    $reason = $_REQUEST['reason']; //array
    $createdBy = $_SESSION['user_id']; // user session id here, 1 used for demo purpose only
    $branchId = $_SESSION['user_branch_id'];
    $subBranchId = $_SESSION['user_sub_branch_id'];

    $i = 0;
    $legalIds = 0;

    foreach ($stockIds as $key => $value) {

        if ($stockWastageAmount[$key] > 0) {
            $legalIds++;
            $sql = "INSERT INTO `wastage` (`branch_id`, `sub_branch_id`, `stock_id`, `ingredient_id`, `amount`, `reason`, `created_by`) VALUES ('$branchId', '$subBranchId', '$stockIds[$key]', '$ingredientIds[$key]', '$stockWastageAmount[$key]', '$reason[$key]', '$createdBy')";
            if ($con->query($sql)) {
                $i = $i + 2;
            }

            $sql2 = "UPDATE `stock` SET `ingredient_amount` = ROUND((`ingredient_amount` - '$stockWastageAmount[$key]'), 3) WHERE `stock`.`id` = '$stockIds[$key]'";
            if ($con->query($sql2)) {
                $i--;
            }
        }
    }


    if ($legalIds == $i) {
        echo "1";
    } else {
        echo "0";
    }
}



function addProductInOrderSession()
{
    $productId = $_REQUEST['productId'];
    $productSizeId = $_REQUEST['productSizeId'];
    $productSizePrice = $_REQUEST['productSizePrice'];

    if (isset($_REQUEST['productOptionIds'])) {
        $productOptionIds = $_REQUEST['productOptionIds']; //array
        $productOptionPrices = array();

        foreach ($productOptionIds as $key => $value) {
            $optionDetails = getAllDataOfProductOptionTableFromProductOptionId($productOptionIds[$key]);


            $currentDate = date("Y-m-d H:i:s");

            if ($optionDetails['offer_money_from'] < $currentDate && $optionDetails['offer_money_to'] > $currentDate) {
                $optionDetailsPrice = $optionDetails['offer_money_added'];
            } else {
                $optionDetailsPrice = $optionDetails['extra_money_added'];
            }

            array_push($productOptionPrices, $optionDetailsPrice);
        }
    } else {
        $productOptionIds = array(); //array
        $productOptionPrices = array(); //array
    }

    if (isset($_REQUEST['productAddonIds'])) {
        $productAddonIds = $_REQUEST['productAddonIds']; //array
        $productAddonPrices = array();

        foreach ($productAddonIds as $key => $value) {
            $addonDetails = getAllDataOfProductAddonTableFromProductAddonId($productAddonIds[$key]);


            $currentDate = date("Y-m-d H:i:s");

            if ($addonDetails['offer_money_from'] < $currentDate && $addonDetails['offer_money_to'] > $currentDate) {
                $addonDetailsPrice = $addonDetails['offer_money_added'];
            } else {
                $addonDetailsPrice = $addonDetails['extra_money_added'];
            }

            array_push($productAddonPrices, $addonDetailsPrice);
        }
    } else {
        $productAddonIds = array(); //array
        $productAddonPrices = array(); //array
    }

    $productQuantity = $_REQUEST['productQuntity'];

    $addNew = 1;

    foreach ($_SESSION['cart'] as $i => $value) {
        if ($productId == $_SESSION['cart'][$i]['product_id']) {
            if ($productSizeId == $_SESSION['cart'][$i]['product_size_id']) {
                if ($productOptionIds === $_SESSION['cart'][$i]['product_option_ids']) {
                    if ($productAddonIds === $_SESSION['cart'][$i]['product_addon_ids']) {
                        $foundInArrayIndex = $i;
                        $addNew = 0;
                    }
                }
            }
        }
    }

    if ($addNew == 1) {

        $productPrice = $productSizePrice;

        foreach ($productOptionPrices as $key => $value) {
            $productPrice = $productPrice + $productOptionPrices[$key];
        }

        foreach ($productAddonPrices as $key => $value) {
            $productPrice = $productPrice + $productAddonPrices[$key];
        }

        $productDetails = getProductDetailsFromId($productId);
        $productName = $productDetails['name'];
        $productImage = $productDetails['photo'];
        $productSizeDetails = getProductSizeDetailsFromProductSizeId($productSizeId);
        $productSizeName = $productSizeDetails['name'];


        $newItem = array(
            "product_id" => "$productId",
            "product_name" => "$productName",
            "product_image" => "$productImage",
            "product_size_id" => "$productSizeId",
            "product_size_name" => "$productSizeName",
            "product_option_ids" => $productOptionIds,
            "product_addon_ids" => $productAddonIds,
            "product_size_price" => "$productSizePrice",
            "product_option_prices" => $productOptionPrices,
            "product_addon_prices" => $productAddonPrices,
            "quantity" => "$productQuantity",
            "product_price" => $productPrice * $productQuantity
        );

        array_push($_SESSION['cart'], $newItem);
    } else {

        $previousQuantity = $_SESSION['cart'][$foundInArrayIndex]['quantity'];
        $unitPrice = $_SESSION['cart'][$foundInArrayIndex]['product_price'] / $previousQuantity;

        if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "checkOutPage") {
            $_SESSION['cart'][$foundInArrayIndex]['quantity'] = $productQuantity;
        } else {
            $_SESSION['cart'][$foundInArrayIndex]['quantity'] = $_SESSION['cart'][$foundInArrayIndex]['quantity'] + $productQuantity;
        }

        $_SESSION['cart'][$foundInArrayIndex]['product_price'] = $unitPrice * $_SESSION['cart'][$foundInArrayIndex]['quantity'];

        if ($_SESSION['cart'][$foundInArrayIndex]['quantity'] <= 0) {
            unset($_SESSION['cart'][$foundInArrayIndex]);
        }
    }
}

function deleteSingleItemFromCart()
{

    $foundInArrayIndex = 9999;

    $productId = $_REQUEST['productId'];
    $productSizeId = $_REQUEST['productSizeId'];
    if ($_REQUEST['productOptionIds'] == "") {
        $productOptionIds = array();
    } else {
        $productOptionIds = explode(",", $_REQUEST['productOptionIds']); //comma seperated string
    }

    if ($_REQUEST['productAddonIds'] == "") {
        $productAddonIds = array();
    } else {
        $productAddonIds = explode(",", $_REQUEST['productAddonIds']); //comma seperated string
    }

    if ($_REQUEST['subCategoryAddonIds'] == "") {
        $subCategoryAddonIds = array();
    } else {
        $subCategoryAddonIds = explode(",", $_REQUEST['subCategoryAddonIds']); //comma seperated string
    }


    foreach ($_SESSION['cart'] as $i => $value) {
        if ($productId == $_SESSION['cart'][$i]['product_id']) {
            if ($productSizeId == $_SESSION['cart'][$i]['product_size_id']) {
                if ($productOptionIds === $_SESSION['cart'][$i]['product_option_ids']) {
                    if ($productAddonIds === $_SESSION['cart'][$i]['product_addon_ids'] && $subCategoryAddonIds === $_SESSION['cart'][$i]['sub_category_addon_ids']) {
                        $foundInArrayIndex = $i;
                    }
                }
            }
        }
    }

    //echo $foundInArrayIndex;

    unset($_SESSION['cart'][$foundInArrayIndex]);

    reloadMiniCart(); //if needed ! 

}

function deleteSingleItemFromCartPos()
{

    $foundInArrayIndex = 9999;

    $tableId = $_REQUEST['tableId'];
    $sessionName = "table" . $tableId;
    $productId = $_REQUEST['productId'];
    $productSizeId = $_REQUEST['productSizeId'];
    if ($_REQUEST['productOptionIds'] == "") {
        $productOptionIds = array();
    } else {
        $productOptionIds = explode(",", $_REQUEST['productOptionIds']); //comma seperated string
    }

    if ($_REQUEST['productAddonIds'] == "") {
        $productAddonIds = array();
    } else {
        $productAddonIds = explode(",", $_REQUEST['productAddonIds']); //comma seperated string
    }

    if ($_REQUEST['subCategoryAddonIds'] == "") {
        $subCategoryAddonIds = array();
    } else {
        $subCategoryAddonIds = explode(",", $_REQUEST['subCategoryAddonIds']); //comma seperated string
    }


    foreach ($_SESSION[$sessionName] as $i => $value) {
        if ($productId == $_SESSION[$sessionName][$i]['product_id']) {
            if ($productSizeId == $_SESSION[$sessionName][$i]['product_size_id']) {
                if ($productOptionIds === $_SESSION[$sessionName][$i]['product_option_ids']) {
                    if ($productAddonIds === $_SESSION[$sessionName][$i]['product_addon_ids'] && $subCategoryAddonIds === $_SESSION[$sessionName][$i]['sub_category_addon_ids']) {
                        $foundInArrayIndex = $i;
                    }
                }
            }
        }
    }

    //echo $foundInArrayIndex;

    unset($_SESSION[$sessionName][$foundInArrayIndex]);

    reloadListPos($tableId); //if needed ! 

}

function deleteAllItemFromCart()
{
    foreach ($_SESSION['cart'] as $i => $value) {
        unset($_SESSION['cart'][$i]);
    }

    reloadMiniCart();
    //loadMiniCart(); //if needed ! 
}


function saveClient($clientName = "", $clientEmail = "", $clientMobile = "", $clientDOB = "", $clientAddress = "", $clientPassword = "")
{
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
    }

    $sql = "INSERT INTO `client` (`name`, `email`, `mobile`, `dob`, `address`, `password`) VALUES ('$clientName', '$clientEmail', '$clientMobile', '$clientDOB', '$clientAddress', '$clientPassword')";

    if ($returnResult) {
        if ($con->query($sql)) {
            echo "1";
        } else {
            echo "0";
        }
    } else {

        if ($con->query($sql)) {
            $clientDetails = getClientDetailsFromMobileNumber($clientMobile);
            $_COOKIE["client_id"] = $clientDetails['id'];
            $_COOKIE["client_name"] = $clientDetails['name'];
            $_COOKIE["client_email"] = $clientDetails['email'];
            $_COOKIE["client_mobile"] = $clientDetails['mobile'];
            $_COOKIE["client_dob"] = $clientDetails['dob'];
            $_COOKIE["client_address"] = $clientDetails['address'];
        }
    }
}


function saveOrder()
{
    global $con;



    if (!isset($_COOKIE["client_id"]) || $_REQUEST["client_id"] == 0) {
        $clientName = $_REQUEST['clientName'];
        $clientEmail = $_REQUEST['clientEmail'];
        $clientMobile = $_REQUEST['clientMobile'];
        $clientDOB = $_REQUEST['clientDOB'];
        $clientAddress = $_REQUEST['clientAddress'];
        $clientPassword = $_REQUEST['clientPassword'];
        saveClient($clientName, $clientEmail, $clientMobile, $clientDOB, $clientAddress, $clientPassword);
        //$clientId = $_COOKIE['client_id'];
        $clientDetails = getClientDetailsFromMobileNumber($clientMobile);
        $clientId = $clientDetails['id'];
    } else {
        $clientId = $_COOKIE['client_id'];
    }

    $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
    $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];


    $tableId = $_REQUEST['tableId'];

    if ($tableId == 0) {
        $status = 1;
    } else {
        $status = 2;
    }
    $branchId = $_REQUEST['branchId'];
    $subBranchId = "0"; //$_REQUEST['subBranchId'];

    $uniqueOrderId = round(microtime(true) * 1000) . $clientId;
    $deliveryAddress = $_SESSION['deliveryAddress'];
    $totalItems = totalCartItem();
    $basicTotalBill = totalCartPrice();
    $serviceCharge = totalServiceCharge($basicTotalBill, $serviceChargePercentage);
    $beforeTax = $basicTotalBill + $serviceCharge;
    $tax = totalTax($beforeTax, $taxPercentage);
    $deliveryCharge = $_REQUEST['deliveryCharge'];
    $discountAmount = $_REQUEST['discountAmount'];
    $totalBill = (grandTotalFromBasicAmount($basicTotalBill, $serviceChargePercentage, $taxPercentage) + $deliveryCharge) - $discountAmount;
    $paidAmount = $_REQUEST['paidAmount'];
    $paymentMethodId = $_REQUEST['paymentMethodId'];
    $orderRemarks = $_REQUEST['orderRemarks'];


    $sql = "INSERT INTO `order_process` (`table_id`, `branch_id`, `sub_branch_id`, `client_id`, `unique_order_id`, `delivery_address`, `total_items`, `basic_total_bill`, `service_charge`, `tax`, `delivery_charge`, `discount_amount`, `total_bill`, `paid_amount`, `payment_method_id`, `remarks`, `status`) VALUES ('$tableId', '$branchId', '$subBranchId', '$clientId', '$uniqueOrderId', '$deliveryAddress', '$totalItems', '$basicTotalBill', '$serviceCharge', '$tax', '$deliveryCharge', '$discountAmount', '$totalBill', '$paidAmount', '$paymentMethodId', '$orderRemarks', '$status')";

    //print_r($_SESSION['cart']);

    if ($con->query($sql)) {
        foreach ($_SESSION['cart'] as $key => $value) {
            $productId = $_SESSION['cart'][$key]['product_id'];
            $productSizeId = $_SESSION['cart'][$key]['product_size_id'];
            $basePrice = getProductPriceFromSizeId($_SESSION['cart'][$key]['product_size_id']);
            $productOptionIds = $_SESSION['cart'][$key]['product_option_ids'];
            $productOptionPrices = array();
            foreach ($productOptionIds as $key2 => $value) {
                array_push($productOptionPrices, getProductOptionPriceFromOptionId($productOptionIds[$key2]));
            }
            $totalOptionPrice = array_sum($productOptionPrices);

            $productAddonIds = $_SESSION['cart'][$key]['product_addon_ids'];
            $productAddonPrices = array();
            foreach ($productAddonIds as $key3 => $value) {
                array_push($productOptionPrices, getProductAddonPriceFromAddonId($productAddonIds[$key3]));
            }
            $totalAddonPrice = array_sum($productAddonPrices);
            $productUnitPrice = round($_SESSION['cart'][$key]['product_price'] / $_SESSION['cart'][$key]['quantity'], 2);
            $productQuantity = $_SESSION['cart'][$key]['quantity'];
            $productTotalPrice = $_SESSION['cart'][$key]['product_price'];
            $perUnitProductionCost = round(getProductionCostPerUnitOfSessionProductFromId($_SESSION['cart'][$key]['product_id']), 3);
            $totalProductionCost = round(($perUnitProductionCost * $productQuantity), 3);

            $productOptionIds2 = serialize($productOptionIds);
            $productOptionPrices2 = serialize($productOptionPrices);
            $productAddonIds2 = serialize($productAddonIds);
            $productAddonPrices2 = serialize($productAddonPrices);

            $sql = "INSERT INTO `order_items` (`branch_id`, `sub_branch_id`, `unique_order_id`, `product_id`, `product_size_id`, `base_price`, `product_option_ids`, `product_option_prices`, `total_option_price`, `product_addon_ids`, `product_addon_prices`, `total_addon_price`, `product_unit_price`, `product_quantity`, `product_total_price`, `per_unit_production_cost`, `total_production_cost`, `created_by`) VALUES ('$branchId', '$subBranchId', '$uniqueOrderId', '$productId', '$productSizeId', '$basePrice', '$productOptionIds2', '$productOptionPrices2', '$totalOptionPrice', '$productAddonIds2', '$productAddonPrices2', '$totalAddonPrice', '$productUnitPrice', '$productQuantity', '$productTotalPrice', '$perUnitProductionCost', '$totalProductionCost', '$clientId')";

            $con->query($sql);
        }
    }

    if ($tableId == 0) {
        updateOrderProcess($branchId, $subBranchId, $uniqueOrderId, '2', '0');
    }

    echo $uniqueOrderId;
}

function updateOrderProcess($branchId = "", $subBranchId = "", $uniqueOrderId = "", $userTypeId = "", $userId = "")
{
    global $con;

    if (isset($_REQUEST['branchId']) && isset($_REQUEST['subBranchId']) && isset($_REQUEST['uniqueOrderId']) && isset($_REQUEST['userTypeId']) && isset($_REQUEST['userId'])) {
        $branchId = $_REQUEST['branchId'];
        $subBranchId = $_REQUEST['subBranchId'];
        $uniqueOrderId = $_REQUEST['uniqueOrderId'];
        $userTypeId = $_REQUEST['userTypeId'];
        $userId = $_REQUEST['userId'];
    }


    $updateTime = date("Y-m-d H:i:s");
    //$columnName = '';

    if ($userTypeId == 2) { //manager
        if (isset($_REQUEST['orderAccepted'])) {
            $sql = "UPDATE `order_process` SET `manager_id` = '$userId' , `manager_approve_time` = '$updateTime' , `status` = '2' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";

            if ($con->query($sql)) {
                deductIngredientsAmountFromStockFromUniqueOrderId($branchId, $subBranchId, $uniqueOrderId, ""); // when manager apporves
                echo "1";
            } else {
                echo "0";
            }
        }

        if (isset($_REQUEST['orderDeclined'])) {
            $sql = "UPDATE `order_process` SET `manager_id` = '$userId' , `manager_approve_time` = '$updateTime' , `status` = '7' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";

            if ($con->query($sql)) {
                echo "1";
            } else {
                echo "0";
            }
        }

        if (isset($_REQUEST['deliveryManSelected'])) {
            $deliveryStartTime = date("Y-m-d H:i:s");
            $deliveryManId = $_REQUEST['deliveryManId'];
            $sql = "UPDATE `order_process` SET `delivery_man_id` = '$deliveryManId'  WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";

            if ($con->query($sql)) {
                echo "1";
            } else {
                echo "0";
            }
        }

        if (isset($_REQUEST['cookingStartTime'])) {
            $cookingStartTime = date("Y-m-d H:i:s");
            $sql = "UPDATE `order_process` SET `cheff_id` = '$userId' , `cooking_start_time` = '$cookingStartTime' , `status` = '3' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
            if ($con->query($sql)) {
                echo "1";
            } else {
                echo "0";
            }
        }

        if (isset($_REQUEST['cookingFinishTime'])) {
            $cookingFinishTime = date("Y-m-d H:i:s"); //$_REQUEST['cookingFinishTime'];
            $sql = "UPDATE `order_process` SET `cooking_finish_time` = '$cookingFinishTime' , `status` = '4' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
            if ($con->query($sql)) {
                echo "1";
            } else {
                echo "0";
            }
        }



        if (isset($_REQUEST['deliveryStartTime'])) {
            $deliveryStartTime = date("Y-m-d H:i:s");
            $sql = "UPDATE `order_process` SET `delivery_man_id` = '$userId' , `delivery_start_time` = '$deliveryStartTime' , `status` = '5' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
            if ($con->query($sql)) {
                echo "1";
            } else {
                echo "0";
            }
        }


        if (isset($_REQUEST['deliveryEndTime'])) {
            $deliveryFinishTime = date("Y-m-d H:i:s");
            $sql = "UPDATE `order_process` SET `delivery_finish_time` = '$deliveryFinishTime' , `status` = '6' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
            if ($con->query($sql)) {
                echo "1";
            } else {
                echo "0";
            }
        }
    } elseif ($userTypeId == 3) {

        if (isset($_REQUEST['cookingStartTime'])) {
            $cookingStartTime = date("Y-m-d H:i:s");
            $sql = "UPDATE `order_process` SET `cheff_id` = '$userId' , `cooking_start_time` = '$cookingStartTime' , `status` = '3' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        } else {
            $cookingFinishTime = date("Y-m-d H:i:s"); //$_REQUEST['cookingFinishTime'];
            $sql = "UPDATE `order_process` SET `cooking_finish_time` = '$cookingFinishTime' , `status` = '4' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        }

        if ($con->query($sql)) {
            echo "1";
        } else {
            echo "0";
        }
    } elseif ($userTypeId == 8) {
        if (isset($_REQUEST['deliveryStartTime'])) {
            $deliveryStartTime = date("Y-m-d H:i:s");
            $sql = "UPDATE `order_process` SET `delivery_man_id` = '$userId' , `delivery_start_time` = '$deliveryStartTime' , `status` = '5' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        } else {
            $deliveryFinishTime = date("Y-m-d H:i:s");
            $sql = "UPDATE `order_process` SET `delivery_finish_time` = '$deliveryFinishTime' , `status` = '6' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";
        }

        if ($con->query($sql)) {
            echo "1";
        } else {
            echo "0";
        }
    } else {
        echo "0";
    }
}


function getProductOtionDetailsFromSizeId()
{
    global $con;
    $optionTitleDetails = getAllDataOfProductOptionTitleTableFromProductSizeId($_REQUEST['productSizeId']);
    foreach ($optionTitleDetails as $key => $value) {
        $optionDetails = getAllDataOfProductOptionTableFromProductTitleIdAndProductSizeId($optionTitleDetails[$key]['id'], $_REQUEST['productSizeId']);
    ?>
        <div class="col-md-12" style="margin-top: 20px; margin-bottom:20px; border: 1px solid blues">
            <div class="item-option-title">
                <h2><?php echo $optionTitleDetails[$key]['title']; ?></h2>
            </div>
            <div class="row text-center optionsHolderDivCatcher">
                <?php
                if ($optionTitleDetails[$key]['option_type'] == "radio") {
                ?>
                    <ul class="text-center">
                        <?php
                    }
                    foreach ($optionDetails as $key2 => $value) {
                        $optionDetailsPrice = 0;
                        $currentDate = date("Y-m-d H:i:s");

                        if ($optionDetails[$key2]['offer_money_from'] < $currentDate && $optionDetails[$key2]['offer_money_to'] > $currentDate) {
                            $optionDetailsPrice = $optionDetails[$key2]['offer_money_added'];
                        } else {
                            $optionDetailsPrice = $optionDetails[$key2]['extra_money_added'];
                        }

                        if ($optionTitleDetails[$key]['option_type'] == "checkbox") {

                        ?>

                            <div class="col-md-4">
                                <input type="checkbox" name="productOptionIds[]" value="<?php echo $optionDetails[$key2]['id']; ?>" id="po<?php echo $optionDetails[$key2]['id']; ?>">
                                <label for="po<?php echo $optionDetails[$key2]['id']; ?>" style="padding:10px;">
                                    <img src="erp/images/<?php echo $optionDetails[$key2]['image']; ?>">
                                    <p><?php echo $optionDetails[$key2]['name']; ?>
                                        <br><?php echo "+৳" . $optionDetailsPrice; ?>
                                    </p>
                                </label>
                            </div>

                        <?php
                        } else {
                        ?>
                            <li class="col-sm-4">
                                <input type="radio" name="productOptionIds[]" value="<?php echo $optionDetails[$key2]['id']; ?>" id="po<?php echo $optionDetails[$key2]['id']; ?>">
                                <label for="po<?php echo $optionDetails[$key2]['id']; ?>" class="customRadio" style="height: 185px;">

                                    <div class="row optionTitleDivForCenter">
                                        <div class="col-md-12">
                                            <img style="z-index: 999999;" src="erp/images/<?php echo $optionDetails[$key2]['image']; ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <p style="margin-left: 0px; ">
                                                <?php echo $optionDetails[$key2]['name']; ?>
                                                <?php echo " <br>+৳" . $optionDetailsPrice; ?>
                                            </p>
                                        </div>

                                    </div>

                                </label>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    <?php
                    if ($optionTitleDetails[$key]['option_type'] == "radio") {
                    ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
    <?php
    }
}


function getProductSizesFromProductIdForPos()
{
    global $con;
    $productId = $_REQUEST['productId'];
    $productSizeDetails = getAllDataOfProductSizeTableFromProductId($_REQUEST['productId']);
    ?>
    <ul class="unstyled centered">
        <?php
        foreach ($productSizeDetails as $key => $value) {
        ?>
            <li>
                <input class="styled-checkbox" id="psize<?php echo $productSizeDetails[$key]['id'] ?>" type="radio" value="<?php echo $productSizeDetails[$key]['id'] ?>" name="productSizeId" onclick="loadOptions('<?php echo $productId; ?>', '<?php echo $productSizeDetails[$key]['id'] ?>');">
                <label for="psize<?php echo $productSizeDetails[$key]['id'] ?>"><?php echo $productSizeDetails[$key]['name'] ?></label>
            </li>
        <?php
        }
        ?>
    </ul>
    <?php
}



function getProductOtionDetailsFromSizeIdForPos()
{
    global $con;

    // product options
    $optionTitleDetails = getAllDataOfProductOptionTitleTableFromProductSizeId($_REQUEST['productSizeId']);
    foreach ($optionTitleDetails as $key => $value) {
        $optionDetails = getAllDataOfProductOptionTableFromProductTitleIdAndProductSizeId($optionTitleDetails[$key]['id'], $_REQUEST['productSizeId']);
    ?>


        <!-- for title -->
        <span class="fk-addons-table__info-text text-capitalize text-primary" style="font-size: larger; background: yellow; ">
            <?php echo $optionTitleDetails[$key]['title']; ?>
        </span>
        <!-- for title -->


        <ul class="unstyled centered">
            <?php
            foreach ($optionDetails as $key2 => $value) {
                $optionDetailsPrice = 0;
                $currentDate = date("Y-m-d H:i:s");

                if ($optionDetails[$key2]['offer_money_from'] < $currentDate && $optionDetails[$key2]['offer_money_to'] > $currentDate) {
                    $optionDetailsPrice = $optionDetails[$key2]['offer_money_added'];
                } else {
                    $optionDetailsPrice = $optionDetails[$key2]['extra_money_added'];
                }

                if ($optionTitleDetails[$key]['option_type'] == "checkbox") {

            ?>
                    <!-- for checkbox button -->
                    <li>
                        <input class="styled-checkbox" id="po<?php echo $optionDetails[$key2]['id']; ?>" type="checkbox" value="<?php echo $optionDetails[$key2]['id']; ?>" name="productOptionIds[]">
                        <label for="po<?php echo $optionDetails[$key2]['id']; ?>"><?php echo $optionDetails[$key2]['name']; ?><?php echo "+৳" . $optionDetailsPrice; ?></label>
                    </li>
                    <!-- for checkbox button -->
                <?php
                } else {
                ?>

                    <!-- for radio button -->
                    <li>
                        <input class="styled-checkbox" id="po<?php echo $optionDetails[$key2]['id']; ?>" type="radio" value="<?php echo $optionDetails[$key2]['id']; ?>" name="productOptionIds[]">
                        <label for="po<?php echo $optionDetails[$key2]['id']; ?>"><?php echo $optionDetails[$key2]['name']; ?><?php echo "+৳" . $optionDetailsPrice; ?></label>
                    </li>
                    <!-- for radio button -->
            <?php
                }
            }
            ?>

        </ul>

    <?php
    }

    //product addons
    $productAddonDetails = getAllDataOfProductAddonTableFromProductId($_REQUEST['productId']);
    ?>
    <!-- for title -->
    <span class="fk-addons-table__info-text text-capitalize text-primary" style="font-size: larger; background: yellow; ">
        <?php if (count($productAddonDetails) > 0) echo "Addons"; ?>
    </span>
    <!-- for title -->
    <ul class="unstyled centered">
        <?php
        foreach ($productAddonDetails as $key => $value) {
            $productAddonPrice = 0;
            $currentDate = date("Y-m-d H:i:s");

            if ($productAddonDetails[$key]['offer_money_from'] < $currentDate && $productAddonDetails[$key]['offer_money_to'] > $currentDate) {
                $productAddonPrice = $productAddonDetails[$key]['offer_money_added'];
            } else {
                $productAddonPrice = $productAddonDetails[$key]['extra_money_added'];
            }

        ?>

            <!-- for checkbox button -->
            <li>
                <input class="styled-checkbox" id="pc<?php echo $productAddonDetails[$key]['id']; ?>" type="checkbox" value="<?php echo $productAddonDetails[$key]['id']; ?>" name="productAddonIds[]">
                <label for="pc<?php echo $productAddonDetails[$key]['id']; ?>"><?php echo $productAddonDetails[$key]['name']; ?><?php echo "+৳" . $productAddonPrice; ?></label>
            </li>
            <!-- for checkbox button -->
        <?php

        }
        ?>

    </ul>

    <?php
    // product sub category addons
    $productDetails = getProductDetailsFromId($_REQUEST['productId']);
    $subCategoryAddonDetails = getAllDataOfSubCategoryAddonTableFromSubCategoryId($productDetails['sub_category_id']);
    ?>
    <!-- for title -->
    <span class="fk-addons-table__info-text text-capitalize text-primary" style="font-size: larger; background: yellow; ">
        <?php if (count($subCategoryAddonDetails) > 0) echo "Addons From Sub Category"; ?>
    </span>
    <!-- for title -->
    <ul class="unstyled centered">
        <?php
        foreach ($subCategoryAddonDetails as $key2 => $value) {
            $optionDetailsPrice = 0;
            $currentDate = date("Y-m-d H:i:s");

            if ($subCategoryAddonDetails[$key2]['offer_money_from'] < $currentDate && $subCategoryAddonDetails[$key2]['offer_money_to'] > $currentDate) {
                $optionDetailsPrice = $subCategoryAddonDetails[$key2]['offer_money_added'];
            } else {
                $optionDetailsPrice = $subCategoryAddonDetails[$key2]['extra_money_added'];
            }



        ?>
            <!-- for checkbox button -->
            <li>
                <input class="styled-checkbox" id="po<?php echo $subCategoryAddonDetails[$key2]['id']; ?>" type="checkbox" value="<?php echo $subCategoryAddonDetails[$key2]['id']; ?>" name="subCategoryAddonIds[]">
                <label for="po<?php echo $subCategoryAddonDetails[$key2]['id']; ?>"><?php echo $subCategoryAddonDetails[$key2]['name']; ?><?php echo "+৳" . $optionDetailsPrice; ?></label>
            </li>
            <!-- for checkbox button -->
        <?php

        }
        ?>

    </ul>

<?php

}

function removeSingleOption()
{
    $tableId = "table" . $_REQUEST['tableId'];
    $arrayName = $_REQUEST['arrayName'];
    $outereArrayIndex = $_REQUEST['outereArrayIndex'];
    $innerArrayIndex = $_REQUEST['innerArrayIndex'];

    $arrayName1 = $arrayName . "_ids";
    $arrayName2 = $arrayName . "_prices";


    $a = $_SESSION[$tableId][$outereArrayIndex][$arrayName1];
    $array = array_diff_key($a, [$innerArrayIndex]);
    $_SESSION[$tableId][$outereArrayIndex][$arrayName1] = $array;


    $a = $_SESSION[$tableId][$outereArrayIndex][$arrayName2];
    $array = array_diff_key($a, [$innerArrayIndex]);
    $_SESSION[$tableId][$outereArrayIndex][$arrayName2] = $array;
}

function updateCartQuantity()
{
    global $con;

    $productId = $_REQUEST['productId'];
    $productSizeId = $_REQUEST['productSizeId'];
    if ($_REQUEST['productOptionIds'] == "") {
        $productOptionIds = array();
    } else {
        $productOptionIds = explode(",", $_REQUEST['productOptionIds']); //comma seperated string
    }

    if ($_REQUEST['productAddonIds'] == "") {
        $productAddonIds = array();
    } else {
        $productAddonIds = explode(",", $_REQUEST['productAddonIds']); //comma seperated string
    }

    if ($_REQUEST['subCategoryAddonIds'] == "") {
        $subCategoryAddonIds = array();
    } else {
        $subCategoryAddonIds = explode(",", $_REQUEST['subCategoryAddonIds']); //comma seperated string
    }

    $productQuantity = $_REQUEST['productQuantity'];

    foreach ($_SESSION['cart'] as $i => $value) {
        if ($productId == $_SESSION['cart'][$i]['product_id']) {
            if ($productSizeId == $_SESSION['cart'][$i]['product_size_id']) {
                if ($productOptionIds === $_SESSION['cart'][$i]['product_option_ids']) {
                    if ($productAddonIds === $_SESSION['cart'][$i]['product_addon_ids'] && $subCategoryAddonIds === $_SESSION['cart'][$i]['sub_category_addon_ids']) {
                        $foundInArrayIndex = $i;
                        //$addNew = 0;
                    }
                }
            }
        }
    }

    $previousQuantity = $_SESSION['cart'][$foundInArrayIndex]['quantity'];
    $unitPrice = $_SESSION['cart'][$foundInArrayIndex]['product_price'] / $previousQuantity;

    if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "cartPage") {
        $_SESSION['cart'][$foundInArrayIndex]['quantity'] = $productQuantity;
    } else {
        $_SESSION['cart'][$foundInArrayIndex]['quantity'] = $productQuantity;
        //$_SESSION['cart'][$foundInArrayIndex]['quantity'] = $_SESSION['cart'][$foundInArrayIndex]['quantity'] + $productQuantity;
    }

    $_SESSION['cart'][$foundInArrayIndex]['product_price'] = $unitPrice * $_SESSION['cart'][$foundInArrayIndex]['quantity'];

    if ($_SESSION['cart'][$foundInArrayIndex]['quantity'] <= 0) {
        unset($_SESSION['cart'][$foundInArrayIndex]);
    }

    if (isset($_REQUEST['updateFrom']) && $_REQUEST['updateFrom'] == "direct") {
        reloadMiniCart();
    }
}

function getTotalProductOnCart()
{
    echo totalCartProduct();
}


function reloadMiniCart()
{
    global $con;

?>

    <span id="miniCartDetails">
        <h2>Order Summery <span class="count"><?php echo totalCartProduct(); ?></span></h2>
        <ul class="products">
            <?php
            $i = 1;
            $cartDetails = $_SESSION['cart'];
            $totalPrice = 0;
            //print_r($cartDetails);
            foreach ($cartDetails as $key => $value) {

            ?>
                <li class="product">
                    <a href="#" class="product-link">
                        <span class="product-image">
                            <img src="erp/images/<?php echo $cartDetails[$key]['product_image']; ?>" alt="<?php echo $cartDetails[$key]['product_name']; ?>">
                        </span>
                        <span class="product-details">
                            <h3><?php echo $cartDetails[$key]['product_name']; ?></h3>
                            <p><b>Size:</b> <?php echo $cartDetails[$key]['product_size_name']; ?></p>
                            <p><b>Options:</b>


                                <?php
                                $productOptions = $cartDetails[$key]['product_option_ids'];
                                if (count($productOptions) == 0) {
                                    echo "N/A";
                                } else {
                                    $c = 1;
                                    foreach ($productOptions as $productOptionsIndex => $value) {
                                        $productOptionName = getDetailsOfProductOptionTableFromId($productOptions[$productOptionsIndex]);
                                        if ($c == 1) {
                                            echo $productOptionName['name'];
                                        } else {
                                            echo " , " . $productOptionName['name'];
                                        }
                                        $c++;
                                    }
                                }
                                ?>

                            </p>
                            <p><b>Addons:</b>
                                <?php
                                $productAddons = $cartDetails[$key]['product_addon_ids'];
                                $subCategoryAddons = $cartDetails[$key]['sub_category_addon_ids'];

                                if (count($productAddons) == 0 && count($subCategoryAddons) == 0) {
                                    echo "N/A";
                                } else {
                                    foreach ($productAddons as $productAddonsIndex => $value) {
                                        $productAddonName = getProductAddonDetailsFromAddonId($productAddons[$productAddonsIndex]);
                                        if (current($productAddons) == end($productAddons)) {
                                            echo $productAddonName['name'];
                                        } else {
                                            echo $productAddonName['name'] . " , ";
                                        }
                                    }

                                    if (count($productAddons) > 0) {
                                        echo ", ";
                                    }

                                    foreach ($subCategoryAddons as $subCategoryAddonsIndex => $value) {
                                        $subCategoryAddonName = getSubCategoryAddonDetailsFromSubCategoryAddonId($subCategoryAddons[$subCategoryAddonsIndex]);
                                        if (current($subCategoryAddons) == end($subCategoryAddons)) {
                                            echo $subCategoryAddonName['name'];
                                        } else {
                                            echo $subCategoryAddonName['name'] . " , ";
                                        }
                                    }
                                }
                                ?>
                            </p>
                            <p>
                                <b>Extra Addons Price(<?php echo $cartDetails[$key]['product_extra_option']; ?>):</b>
                                <?php echo "৳" . $cartDetails[$key]['product_extra_option_price']; ?>
                            </p>
                            <?php
                            $productId = $cartDetails[$key]['product_id'];
                            $productSizeId = $cartDetails[$key]['product_size_id'];
                            $productOptionIds = implode(",", $cartDetails[$key]['product_option_ids']);
                            $productAddonIds = implode(",", $cartDetails[$key]['product_addon_ids']);
                            $subCategoryAddonIds = implode(",", $cartDetails[$key]['sub_category_addon_ids']);
                            ?>
                            <span class="qty-price">
                                <span class="qty">
                                    <p><b>Quantity:</b> </p>
                                    <button class="minus-button" id="minus-button-1">-</button>
                                    <input type="number" id="quantity<?php echo $i; ?><?php echo $productId; ?><?php echo $productSizeId; ?>" class="qty-input" step="1" min="1" max="50" name="qty-input" value="<?php echo  $cartDetails[$key]['quantity']; ?>" pattern="[0-9]*" title="Quantity" inputmode="numeric" productId='<?php echo $productId; ?>' productSizeId='<?php echo $productSizeId; ?>' productOptionIds='<?php echo $productOptionIds; ?>' productAddonIds='<?php echo $productAddonIds; ?>' subCategoryAddonIds='<?php echo $subCategoryAddonIds; ?>'>
                                    <button class="plus-button" id="plus-button-1">+</button>
                                </span>
                                <span class="price">৳ <?php echo  $cartDetails[$key]['product_price']; ?></span>
                            </span>
                        </span>
                    </a>


                    <a href="#remove" class="remove-button" onclick="removeSingleCartItem('<?php echo $productId; ?>', '<?php echo $productSizeId; ?>', '<?php echo $productOptionIds; ?>', '<?php echo $productAddonIds; ?>', '<?php echo $subCategoryAddonIds; ?>');return false;"><span class="remove-icon">X</span></a>

                    <!-- <button class="remove-button"><span class="remove-icon">X</span></button> -->
                </li>

            <?php
                $i++;
                $totalPrice = $totalPrice + $cartDetails[$key]['product_price'];
            }
            $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
            $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];
            ?>
        </ul>
        <div class="totals">
            <div class="subtotal">
                <span class="label">Total:</span> <span class="amount">৳ <?php echo  $totalPrice; ?></span>
            </div>

            <!--<div class="subtotal">
                        <span class="label">Service Charge:</span> <span class="amount">৳ <?php echo  $serviceCharge = totalServiceCharge($totalPrice, $serviceChargePercentage);
                                                                                            $beforeVat = $totalPrice + $serviceCharge; ?></span>
                    </div>
                    <div class="subtotal">
                        <span class="label">VAT:</span> <span class="amount">৳ <?php echo  totalTax($beforeVat, $taxPercentage); ?></span>
                    </div>
                    <div class="subtotal">
                        <span class="label"><strong>Total:</strong></span> <span class="amount"><strong>৳ <?php echo  grandTotalFromBasicAmount($totalPrice, $serviceChargePercentage, $taxPercentage); ?></strong></span>
                    </div> -->
        </div>
    </span>

<?php

}


function updateOrderDistribution()
{
    global $con;
    $orderId = $_REQUEST['uniqueOrderId'];
    $subBranchId = $_REQUEST['subBranchId'];
    $transferTime = date("Y-m-d H:i:s");

    $sql = "UPDATE `order_process` SET `sub_branch_id` = '$subBranchId', `transfer_time` = '$transferTime' WHERE `order_process`.`unique_order_id` = $orderId";

    $processTable = getOrderProcessDetailsFromUniqueOrderId($orderId);

    if ($processTable['sub_branch_id'] == 0) {
        if ($con->query($sql)) {
            stopCommonNotification($orderId);
            echo "1";
        } else {
            echo "0";
        }
    } else {
        echo "0";
    }
}


function updatePaymentStatus()
{
    global $con;
    $orderId = $_REQUEST['orderId'];
    $paymentStatus = $_REQUEST['paymentStatus'];

    $sql = "UPDATE `order_process` SET `payment_status` = '$paymentStatus' WHERE `order_process`.`unique_order_id` = $orderId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}



function getOrderDetailsForCheffFromUniqueOrderId()
{
    global $con;
    $tableId = $_REQUEST['tableId']; //'TABLE-07'; //
    $uniqueOrderId = $_REQUEST['uniqueOrderId']; // '16098465960032'; //
    $orderProcessTableDetails = getOrderProcessDetailsFromUniqueOrderId($uniqueOrderId);
?>

    <!-- edit Requisition Modal -->
    <div class="modal fade" id="viewOrderDetails">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Order ID : <?php echo $tableId; ?> Total Item : <?php echo $orderProcessTableDetails['total_items']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php

                        $orderItemTableDetails = getAllDataOfOrderItemTableFromUniqueOrderId($uniqueOrderId);

                        foreach ($orderItemTableDetails as $oitdKey => $value) {
                            $productDetails = getProductDetailsFromId($orderItemTableDetails[$oitdKey]['product_id']);
                            $productSizeDetails = getProductSizeDetailsFromProductSizeId($orderItemTableDetails[$oitdKey]['product_size_id']);
                        ?>

                            <div class="col-md-11" style="margin: auto;">
                                <!-- Widget: user widget style 1 -->
                                <div class="card card-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-info">
                                        <h1 class="widget-user-usernam"><?php echo $productDetails['name']; ?></h1>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="images/<?php echo $productDetails['photo']; ?>" alt="<?php echo $productDetails['name']; ?>" style="object-fit: cover;">

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Product Size</h5>
                                                    <span class="description-text"><?php echo $productSizeDetails['name']; ?></span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <?php

                                                    $temporaryProductOptionIds = unserialize($orderItemTableDetails[$oitdKey]['product_option_ids']);
                                                    $groupedIdTitle = groupOptionNameByOptionTitleFromOptionIds($temporaryProductOptionIds);
                                                    //$myArray = explode(',', $myString);
                                                    if (count($groupedIdTitle) == 0) {
                                                        //echo "N/A";
                                                    ?>
                                                        <h5 class="description-header"></h5>
                                                        <span class="description-text"><?php echo $productSizeDetails['name']; ?></span>


                                                        <?php
                                                    } else {
                                                        foreach ($groupedIdTitle as $gitKey => $value) {
                                                        ?>
                                                            <h5 class="description-header"><?php echo $groupedIdTitle[$gitKey]['title_name']; ?></h5>
                                                            <?php
                                                            $productOptionNames = explode(',', $groupedIdTitle[$gitKey]['option_name']);
                                                            foreach ($productOptionNames as $ponKey => $value) {
                                                            ?>
                                                                <span class="description-text"><?php echo $productOptionNames[$ponKey]; ?></span>
                                                                <br>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Product Addon</h5>
                                                    <?php
                                                    $productAddons = unserialize($orderItemTableDetails[$oitdKey]['product_addon_ids']);
                                                    $subCategoryAddons = unserialize($orderItemTableDetails[$oitdKey]['sub_category_addon_ids']);

                                                    if (count($productAddons) == 0 && count($subCategoryAddons) == 0) {
                                                        echo "N/A";
                                                    } else {
                                                        foreach ($productAddons as $productAddonsIndex => $value) {
                                                            $productAddonName = getProductAddonDetailsFromAddonId($productAddons[$productAddonsIndex]);

                                                    ?>
                                                            <span class="description-text"><?php echo $productAddonName['name']; ?></span>
                                                            <br>
                                                        <?php
                                                        }

                                                        foreach ($subCategoryAddons as $subCategoryAddonsIndex => $value) {
                                                            $subCategoryAddonName = getSubCategoryAddonDetailsFromSubCategoryAddonId($subCategoryAddons[$subCategoryAddonsIndex]);
                                                        ?>
                                                            <span class="description-text"><?php echo $subCategoryAddonName['name']; ?></span>
                                                            <br>
                                                    <?php
                                                        }
                                                    }
                                                    ?>


                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-3">
                                                <div class="description-block">
                                                    <h5 class="description-header">Order Quantity</h5>
                                                    <span class="description-text"><?php echo $orderItemTableDetails[$oitdKey]['product_quantity']; ?></span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                        </div>
                                        <!-- /.row -->

                                    </div>
                                </div>
                                <!-- /.widget-user -->
                            </div>

                        <?php
                        }
                        ?>

                        <div class="col-md-8" style="margin: auto;">
                            <div class="card card-outline card-danger">
                                <div class="card-header text-center">
                                    <h5 class="card-titl text-center"><b>Remarks</b></h5>
                                </div>
                                <div class="card-body text-center">
                                    <?php echo $orderProcessTableDetails['remarks']; ?>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>


                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div class="row col-md-12" style="height: 100px;">
                        <?php if ($orderProcessTableDetails['status'] < 3) { ?>

                            <button type="button" class="btn btn-success btn-lg col-md-6 " id="cooingFinishedButton" onclick="startCooking('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $uniqueOrderId; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')" style="margin: auto; height: 100px;">Cooking Start(রান্না শুরু)</button>

                        <?php } else if ($orderProcessTableDetails['status'] == 3) { ?>

                            <button type="button" class="btn btn-default btn-lg col-md-6"><i class="fa fa-hourglass-start fa-spin fa-4x"></i></button>

                            <button type="button" class="btn btn-danger btn-lg col-md-6" id="cooingFinishedButton" onclick="finishCooking('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $uniqueOrderId; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Cooking Finished(রান্না শেষ)</button>
                        <?php } else if ($orderProcessTableDetails['status'] > 3) { ?>

                            <div class="col-md-12 text-center"><b>Order Completed at <?php echo $orderProcessTableDetails['cooking_finish_time']; ?></b></div>

                        <?php } ?>



                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- add Requisition Modal -->

<?php
}

function changeWebsiteView()
{
    global $con;
    $productId = $_REQUEST['productId'];
    $changeToStatus = $_REQUEST['changeToStatus'];

    $sql = "UPDATE `products` SET `website_view` = '$changeToStatus' WHERE `products`.`id` = $productId";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function updateClietOrderStatusView()
{
    global $con;
    $uniqueOrderId = $_REQUEST['uniqueOrderId'];
    $orderProcess = getOrderProcessDetailsFromUniqueOrderId($uniqueOrderId);
?>
    <?php
    if ($orderProcess['table_id'] == 0) {
    ?>
        <div class="section-title">
            <h2>Order Status</h2>
        </div>
        <div class="order-status">
            <div class="single-order-status success">
                <i class="fa fa-check"></i>
                Order Placed at <?php echo $orderProcess['order_time']; ?>
            </div>
            <div class="single-order-status <?php if ($orderProcess['cooking_start_time'] != null) {
                                                echo "success";
                                                $cooking_started = true;
                                            } else {
                                                echo "notsuccess";
                                                $cooking_started = false;
                                            } ?>">
                <i class="<?php
                            if ($cooking_started) {
                                echo "fa fa-check";
                            } else {
                                echo "fa fa-times";
                            }
                            ?>"></i>
                <?php
                if ($cooking_started) {
                    echo "Accepted by Kithcen at " . $orderProcess['cooking_start_time'];
                } else {
                    echo "Not Yet Accepted By kitchen";
                }
                ?>

            </div>
            <div class="single-order-status <?php if ($orderProcess['cooking_finish_time'] != null) {
                                                echo "success";
                                                $cooking_started = true;
                                            } else {
                                                echo "notsuccess";
                                                $cooking_started = false;
                                            } ?>">
                <i class="<?php
                            if ($cooking_started) {
                                echo "fa fa-check";
                            } else {
                                echo "fa fa-times";
                            }
                            ?>"></i>
                <?php
                if ($cooking_started) {
                    echo "Food is ready to be delivered !";
                } else {
                    echo "Preparing Your Order !";
                }
                ?>

            </div>
            <div class="single-order-status <?php if ($orderProcess['delivery_start_time'] != null) {
                                                echo "success";
                                                $cooking_started = true;
                                            } else {
                                                echo "notsuccess";
                                                $cooking_started = false;
                                            } ?>">
                <i class="<?php
                            if ($cooking_started) {
                                echo "fa fa-check";
                            } else {
                                echo "fa fa-times";
                            }
                            ?>"></i>
                <?php
                if ($cooking_started) {
                    echo "Food is on the way!";
                } else {
                    echo "Delivery Not yet Started !";
                }
                ?>

            </div>

            <div class="single-order-status <?php if ($orderProcess['delivery_finish_time'] != null) {
                                                echo "success";
                                                $cooking_started = true;
                                            } else {
                                                echo "notsuccess";
                                                $cooking_started = false;
                                            } ?>">
                <i class="<?php
                            if ($cooking_started) {
                                echo "fa fa-check";
                            } else {
                                echo "fa fa-times";
                            }
                            ?>"></i>
                <?php
                if ($cooking_started) {
                    echo "Food is delivered !";
                } else {
                    echo "Delivery Not yet Finished !";
                }
                ?>

            </div>

        </div>
    <?php
    } else {
    ?>
        <div class="section-title">
            <h2>Order Status</h2>
        </div>
        <div class="order-status">
            <div class="single-order-status success">
                <i class="fa fa-check"></i>
                Order Taken at <?php echo $orderProcess['order_time']; ?>
            </div>
            <div class="single-order-status <?php if ($orderProcess['cooking_start_time'] != null) {
                                                echo "success";
                                                $cooking_started = true;
                                            } else {
                                                echo "notsuccess";
                                                $cooking_started = false;
                                            } ?>">
                <i class="<?php
                            if ($cooking_started) {
                                echo "fa fa-check";
                            } else {
                                echo "fa fa-times";
                            }
                            ?>"></i>
                <?php
                if ($cooking_started) {
                    echo "Cooking started at " . $orderProcess['cooking_start_time'];
                } else {
                    echo "Your order has not started processing";
                }
                ?>

            </div>
            <div class="single-order-status <?php if ($orderProcess['cooking_finish_time'] != null) {
                                                echo "success";
                                                $cooking_started = true;
                                            } else {
                                                echo "notsuccess";
                                                $cooking_started = false;
                                            } ?>">
                <i class="<?php
                            if ($cooking_started) {
                                echo "fa fa-check";
                            } else {
                                echo "fa fa-times";
                            }
                            ?>"></i>
                <?php
                if ($cooking_started) {
                    echo "Cooking finished at " . $orderProcess['cooking_finish_time'];
                } else {
                    echo "Cooking not yet finished !";
                }
                ?>

            </div>
        </div>
    <?php
    }
    ?>
<?php
}



function showNotification()
{
    global $con;

    $number = 0;

    $productProcess = getAllDataOfOrderProcessTable("");

    foreach ($productProcess as $key => $value) {
        if ($productProcess[$key]['status'] == 2) {
            $number = $number + $productProcess[$key]['show_notification'];
        }
    }

    echo $number;
}


function stopNotification()
{
    global $con;
    $uniqueOrderId = $_REQUEST['uniqueOrderId'];

    $sql = "UPDATE `order_process` SET `show_notification` = '0' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}

function showCommonNotification()
{
    global $con;

    $number = 0;

    $productProcess = getAllDataOfOrderProcessTable("");

    foreach ($productProcess as $key => $value) {
        if ($productProcess[$key]['status'] < 2) {
            $number = $number + $productProcess[$key]['show_common_notification'];
        }
    }

    echo $number;
}


function stopCommonNotification($uniqueOrderId = "")
{
    global $con;

    if ($uniqueOrderId != "") {
        $uniqueOrderId = $_REQUEST['uniqueOrderId'];
    }


    $sql = "UPDATE `order_process` SET `show_common_notification` = '0' WHERE `order_process`.`unique_order_id` = '$uniqueOrderId'";

    $con->query($sql);
}


function orderManagementTable()
{
    global $con;
?>

    <?php

    $result = getAllDataOfOrderProcessTable(" AND sub_branch_id = '" . $_SESSION['user_sub_branch_id'] . "' ORDER BY `order_process`.`order_time` DESC LIMIT 100");

    $j = 1;
    $showNotification = 0;
    foreach ($result as $key => $value) {

        $showNotification = $showNotification + $result[$key]['show_notification'];



        $id = $result[$key]['id'];
    ?>
        <tr <?php if ($result[$key]['status'] == 7) { ?> style="background-color: #ff2020;" <?php } else if ($result[$key]['status'] == 6 || ($result[$key]['table_id'] > 0 && $result[$key]['status'] == 4)) { ?> style="background-color: lime; ;" <?php } else if ($result[$key]['status'] == 1) { ?> style="background-color: #ffc107;" <?php } ?>>
            <td class="text-center" style="min-width: 90px;">

                <?php
                if ($result[$key]['table_id'] > 0) {
                    echo $tableId = "#T"  . $result[$key]['id'] . "-" . $result[$key]['table_id'];
                } else {
                    echo $tableId = "#O" . $result[$key]['id'];
                }

                ?>

                <?php
                if ($result[$key]['show_notification'] == 1) {
                ?>

                    <br>

                    <span onclick="stopNotification('<?php echo $result[$key]['unique_order_id']; ?>');"><i class="fas fa-volume-mute fa-2x"></i></span>
                <?php
                }
                ?>
            </td>

            <td class="text-center">
                <div style="max-height:150px; max-width: 550px; overflow: auto;">

                    <?php $orderDetails = getOrderProcessDetailsFromUniqueOrderId($result[$key]['unique_order_id']);
                    $productItems = getAllDataOfOrderItemTableFromUniqueOrderId($result[$key]['unique_order_id']); ?>

                    <table class="table table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Options</th>
                                <th scope="col">Addons</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $orderItemCount = 1;
                            foreach ($productItems as $index => $value) {

                                $productItemDetails = getProductDetailsFromId($productItems[$index]['product_id']);
                            ?>
                                <tr>


                                    <td><?php echo $orderItemCount; ?></th>
                                    <td><?php echo $productItemDetails['name']; ?><br><?php $sizeDetails = getProductSizeDetailsFromProductSizeId($productItems[$index]['product_size_id']);
                                                                                        echo "(" . $sizeDetails['name'] . ")"; ?></td>
                                    <td><?php echo $productItems[$index]['product_quantity'] ?></td>
                                    <td>
                                        <?php
                                        $productOptions = unserialize($productItems[$index]['product_option_ids']);
                                        if (count($productOptions) == 0) {
                                            echo "N/A";
                                        } else {
                                            $c = 1;
                                            foreach ($productOptions as $productOptionsIndex => $value) {
                                                $productOptionName = getDetailsOfProductOptionTableFromId($productOptions[$productOptionsIndex]);
                                                if ($c == 1) {
                                                    echo $productOptionName['name'];
                                                } else {
                                                    echo " , " . $productOptionName['name'];
                                                }
                                                $c++;
                                            }
                                        }
                                        ?>

                                    </td>

                                    <td>
                                        <?php
                                        $productAddons = unserialize($productItems[$index]['product_addon_ids']);
                                        $subCategoryAddons = unserialize($productItems[$index]['sub_category_addon_ids']);

                                        if (count($productAddons) == 0 && count($subCategoryAddons) == 0) {
                                            echo "N/A";
                                        } else {
                                            foreach ($productAddons as $productAddonsIndex => $value) {
                                                $productAddonName = getProductAddonDetailsFromAddonId($productAddons[$productAddonsIndex]);
                                                if (current($productAddons) == end($productAddons)) {
                                                    echo $productAddonName['name'];
                                                } else {
                                                    echo $productAddonName['name'] . " , ";
                                                }
                                            }

                                            if (count($productAddons) > 0) {
                                                echo ", ";
                                            }

                                            foreach ($subCategoryAddons as $subCategoryAddonsIndex => $value) {
                                                $subCategoryAddonName = getSubCategoryAddonDetailsFromSubCategoryAddonId($subCategoryAddons[$subCategoryAddonsIndex]);
                                                if (current($subCategoryAddons) == end($subCategoryAddons)) {
                                                    echo $subCategoryAddonName['name'];
                                                } else {
                                                    echo $subCategoryAddonName['name'] . " , ";
                                                }
                                            }
                                        }
                                        ?>

                                    </td>




                                </tr>
                            <?php $orderItemCount++;
                            } ?>
                        </tbody>
                    </table>
                </div>



            </td>

            <td class="text-center"><?php $clientDetails = getClientDetailsFromUniqueOrderId($result[$key]['unique_order_id']);
                                    echo $clientDetails['name']; ?></td>

            <td class="text-center"><b><?php echo $result[$key]['delivery_address']; ?></b>
                <hr><?php echo $result[$key]['remarks']; ?>
            </td>
            <td class="text-center"><b><?php echo $clientDetails['mobile']; ?></b></td>

            <td class="text-center"><?php echo $result[$key]['order_time']; ?></td>

            <td class="text-center">
                <?php if ($result[$key]['status'] == 7) {
                    echo "Order Cancelled";
                } else { ?>
                    Start: <?php echo $result[$key]['status'] < 3 ? "N/A" : $result[$key]['cooking_start_time']; ?>
                    <br>
                    End: <?php echo $result[$key]['status'] < 4 ? "N/A" : $result[$key]['cooking_finish_time'];
                        } ?>
            </td>

            <td class="text-center">

                <?php if ($result[$key]['status'] == 7) {

                    echo "Order Cancelled";
                } else if ($result[$key]['table_id'] > 0 && $result[$key]['status'] < 4) {

                    echo "Serve To Table: " . $result[$key]['table_id'];
                } else if ($result[$key]['table_id'] == 0 && $result[$key]['status'] < 6) { ?>

                    <select class="form-control text-center" onchange="startDeliveryProcess('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>',this.value);">

                        <?php if ($result[$key]['delivery_man_id'] != '0') {
                            $currentDeliveryMan = getUserDetailsFromId($result[$key]['delivery_man_id']);
                        ?>

                            <option selected disabled value=""><b><?php echo $currentDeliveryMan['full_name'] . " -- " . $currentDeliveryMan['mobile_number']; ?></b></option>

                        <?php } else { ?>

                            <option selected disabled value="">--Select Delivery Man--</option>

                        <?php } ?>

                        <?php $deliveryMen = getAllDataOfUserTable(" and user_type = '8'");

                        for ($i = 0; $i < count($deliveryMen); $i++) { ?>

                            <option value="<?php echo $deliveryMen[$i]['id']; ?>"><?php echo $deliveryMen[$i]['full_name'] . " -- " . $deliveryMen[$i]['mobile_number']; ?></option>
                        <?php } ?>
                    </select>

                <?php } else echo "<b>Order Completed!</b>"; ?>





            </td>
            <td class="text-center bg-gradient-warning"><b>
                    <?php $status = $result[$key]['status'];
                    if ($status == "1") echo "Ordered From Guest";
                    else if ($status == "2") echo "Manager Approved";
                    else if ($status == "3") echo "Cooking Started";
                    else if ($status == "4") echo "Cooking Finished";
                    else if ($status == "5") echo "Delivery Started";
                    else if ($status == "6") echo "Delivery Finished";
                    else if ($status == "7") echo "Order Cancelled";
                    ?>
                </b>
            </td>
            <td>
                <?php echo $result[$key]['total_bill']; ?>
                <br>
                <?php
                $paymentMethodDetails = getPaymentMethodDetailsFromId($result[$key]['payment_method_id']);
                if ($paymentMethodDetails['id'] == 1) {
                    echo "Cash From Online Delivery";
                } elseif ($paymentMethodDetails['id'] == 2) {
                    echo "Online Payment From Online Delivery";
                } else {
                    echo $paymentMethodDetails['name'];
                }
                ?>
            </td>
            <td class="text-center">
                <?php if ($result[$key]['status'] == 7) {
                    echo "Order Cancelled";
                } else { ?>

                    <a target="_blank" href="print/kot.php?orderId=<?php echo $result[$key]['unique_order_id']; ?>" class="btn btn-primary btn-sm">KOT</a>
                    <i class="fa fa-print"></i>
                    <a target="_blank" href="print/bill.php?orderId=<?php echo $result[$key]['unique_order_id']; ?>" class="btn btn-primary btn-sm">Bill</a>
                    <br><br>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Action</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                            <div class="dropdown-menu text-center" role="menu">

                                <?php if ($result[$key]['status'] == 1) { ?>
                                    <a class="dropdown-item bg-success" href="#" onclick="acceptOrder('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Accept</a>
                                    <a class="dropdown-item bg-danger" href="#" onclick="declineOrder('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Cancel</a>

                                <?php } elseif (($result[$key]['status'] < 3) && ($result[$key]['status'] > 1)) { ?>
                                    <a class="dropdown-item bg-danger" href="#" onclick="declineOrder('<?php echo $_SESSION['user_branch_id'] ?>','<?php echo $_SESSION['user_sub_branch_id'] ?>','<?php echo $result[$key]['unique_order_id']; ?>','<?php echo $_SESSION['user_type'] ?>','<?php echo $_SESSION['user_id'] ?>')">Cancel</a>
                                <?php } else { ?>
                                    <a class="dropdown-item disabled" disabled href="#">No Actions To Take</a>
                                <?php } ?>

                            </div>
                        </button>
                    </div>
                <?php } ?>
            </td>


        </tr>
    <?php
        $j++;
    }
    ?>

<?php
}


function reloadListPos($tableId = "")
{
    global $con;
    if (isset($_REQUEST['tableId'])) {
        $tableId = $_REQUEST['tableId'];
    }
?>

    <div class="fk-price-table">
        <div class="fk-price-table__head">
            <div class="row gx-0 align-items-center">
                <div class="col-12 text-right">
                    <span class="d-block sm-text font-weight-bold text-uppercase">
                        <?php //$tableId = '05';
                        ?>
                        Table No: <?php echo $tableId;
                                    //print_r($_SESSION); 
                                    ?>

                    </span>
                </div>
            </div>
        </div>
        <div class="fk-price-table__body t-mt-10">
            <div class="fk-price-table__body-top">
                <div class="fk-table">
                    <div class="fk-table__head">
                        <div class="row g-0 border">
                            <div class="col-1 text-center border-right">
                                <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">S/L</span>
                            </div>
                            <div class="col-5 text-center border-right">
                                <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                    Food Details
                                </span>
                            </div>
                            <div class="col-2 text-center border-right">
                                <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">QTY</span>
                            </div>
                            <div class="col-2 text-center"><span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">Price</span>
                            </div>
                            <div class="col-2 text-center"><span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">Action</span>
                            </div>
                        </div>
                    </div>
                    <div class="fk-table__body border-bottom" data-simplebar="init">
                        <div class="simplebar-track vertical" style="visibility: hidden;">
                            <div class="simplebar-scrollbar"></div>
                        </div>
                        <div class="simplebar-track horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar"></div>
                        </div>
                        <div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;">
                            <div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
                                <div class="sky-is-blue reverse-this">
                                    <div class="text-primary text-center font-weight-bold xsm-text text-uppercase" id="cardHolder">
                                        <?php
                                        $i = 1;
                                        $sessionName = "table" . $tableId;
                                        $cartDetails = $_SESSION[$sessionName];
                                        $totalPrice = 0;
                                        //print_r($cartDetails);
                                        foreach ($cartDetails as $key => $value) {

                                        ?>
                                            <!-- single item in cart -->
                                            <div class="row g-0 border">
                                                <div class="col-1 text-center border-right">
                                                    <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                                        <?php echo $i; ?>
                                                    </span>
                                                </div>
                                                <div class="col-5 text-center border-right">
                                                    <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">

                                                        <h6><?php echo $cartDetails[$key]['product_name']; ?></h6>
                                                        <p><b>Size:</b> <?php echo $cartDetails[$key]['product_size_name']; ?></p>
                                                        <p><b>Options:</b>


                                                            <?php
                                                            $productOptions = $cartDetails[$key]['product_option_ids'];
                                                            if (count($productOptions) == 0) {
                                                                echo "N/A";
                                                            } else {
                                                                //$c = 1;
                                                                foreach ($productOptions as $productOptionsIndex => $value) {
                                                                    $productOptionName = getDetailsOfProductOptionTableFromId($productOptions[$productOptionsIndex]);
                                                            ?>
                                                                    <span class="optionsClass" onclick="removeOption('product_option', '<?php echo $key; ?>', '<?php echo $productOptionsIndex; ?>')"><?php echo $productOptionName['name']; ?> <i class="fas fa-times"></i></span>
                                                            <?php

                                                                }
                                                            }
                                                            ?>

                                                        </p>
                                                        <p><b>Addons:</b>
                                                            <?php
                                                            $productAddons = $cartDetails[$key]['product_addon_ids'];
                                                            $subCategoryAddons = $cartDetails[$key]['sub_category_addon_ids'];

                                                            if (count($productAddons) == 0 && count($subCategoryAddons) == 0) {
                                                                echo "N/A";
                                                            } else {
                                                                foreach ($productAddons as $productAddonsIndex => $value) {
                                                                    $productAddonName = getProductAddonDetailsFromAddonId($productAddons[$productAddonsIndex]);


                                                            ?>
                                                                    <span class="optionsClass" onclick="removeOption('product_addon', '<?php echo $key; ?>', '<?php echo $productAddonsIndex; ?>')"><?php echo  $productAddonName['name']; ?> <i class="fas fa-times"></i></span>
                                                                <?php

                                                                }

                                                                if (count($productAddons) > 0) {
                                                                    echo ", ";
                                                                }

                                                                foreach ($subCategoryAddons as $subCategoryAddonsIndex => $value) {
                                                                    $subCategoryAddonName = getSubCategoryAddonDetailsFromSubCategoryAddonId($subCategoryAddons[$subCategoryAddonsIndex]);

                                                                ?>
                                                                    <span class="optionsClass" onclick="removeOption('sub_category_addon', '<?php echo $key; ?>', '<?php echo $subCategoryAddonsIndex; ?>')"><?php echo  $subCategoryAddonName['name']; ?> <i class="fas fa-times"></i></span>
                                                            <?php

                                                                }
                                                            }
                                                            ?>
                                                        </p>
                                                    </span>
                                                </div>
                                                <div class="col-2 text-center border-right">
                                                    <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                                        <span class="qty">
                                                            <?php
                                                            $productId = $cartDetails[$key]['product_id'];
                                                            $productSizeId = $cartDetails[$key]['product_size_id'];
                                                            $productOptionIds = implode(",", $cartDetails[$key]['product_option_ids']);
                                                            $productAddonIds = implode(",", $cartDetails[$key]['product_addon_ids']);
                                                            $subCategoryAddonIds = implode(",", $cartDetails[$key]['sub_category_addon_ids']);
                                                            ?>
                                                            <p><b></b> <input type="number" value="<?php echo  $cartDetails[$key]['quantity']; ?>" style="overflow: hidden; width:70px;" onfocusout="cartUpdate('<?php echo $productId; ?>', '<?php echo $productSizeId; ?>', '<?php echo $productOptionIds; ?>', '<?php echo $productAddonIds; ?>', '<?php echo $subCategoryAddonIds; ?>', this.value)"></p>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                                        <span class="price">৳ <?php echo  $cartDetails[$key]['product_price']; ?></span>
                                                    </span>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <span class="text-capitalize sm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">

                                                        <?php
                                                        $productId = $cartDetails[$key]['product_id'];
                                                        $productSizeId = $cartDetails[$key]['product_size_id'];
                                                        $productOptionIds = implode(",", $cartDetails[$key]['product_option_ids']);
                                                        $productAddonIds = implode(",", $cartDetails[$key]['product_addon_ids']);
                                                        $subCategoryAddonIds = implode(",", $cartDetails[$key]['sub_category_addon_ids']);
                                                        ?>
                                                        <a href="#remove" class="remove-button" onclick="removeSingleCartItemPos('<?php echo $tableId; ?>','<?php echo $productId; ?>', '<?php echo $productSizeId; ?>', '<?php echo $productOptionIds; ?>', '<?php echo $productAddonIds; ?>', '<?php echo $subCategoryAddonIds; ?>');return false;"><span class="remove-icon">X</span></a>

                                                    </span>
                                                </div>
                                            </div>
                                            <!-- single item in cart -->
                                        <?php
                                            $i++;
                                            $totalPrice = $totalPrice + $cartDetails[$key]['product_price'];
                                        }
                                        $grandTotal = $totalPrice;
                                        $serviceChargePercentage = getValueFromExtraTableByItemName("service_charge"); //$_REQUEST['seviceChargePercentage'];
                                        $taxPercentage = getValueFromExtraTableByItemName("VAT"); //$_REQUEST['taxPercentage'];
                                        $totalPrice = basePriceFromFinalBill($grandTotal, $serviceChargePercentage, $taxPercentage);
                                        $serviceCharge = totalServiceCharge($totalPrice, $serviceChargePercentage);
                                        $beforeVat = $totalPrice + $serviceCharge;
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fk-price-table__body-bottom t-mt-10">
                <div class="fk-table__head">
                    <div class="row g-0 border">
                        <div class="col-12 text-center border-right">
                            <div class="row g-0">
                                <div class="col-2">
                                    <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        Sub Total
                                    </span>
                                </div>
                                <div class="col-2">
                                    <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        ৳ <?php echo  round($totalPrice, 2); ?>
                                    </span>
                                </div>
                                <div class="col-2">
                                    <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        Service Charge
                                    </span>
                                </div>
                                <div class="col-2">
                                    <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        ৳ <?php echo  round($serviceCharge, 2); ?>
                                    </span>
                                </div>
                                <div class="col-2">
                                    <span class="text-uppercase xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        VAT (<?php echo  $taxPercentage; ?>%)
                                    </span>
                                </div>
                                <div class="col-2">
                                    <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        ৳ <?php echo  round(totalTax($beforeVat, $taxPercentage), 2); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 border">
                        <div class="col-7 text-center border-right">
                            <div class="row g-0">
                                <div class="col-5">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                                G. Total
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                                ৳ <?php echo  round($grandTotal, 2); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <div class="col-6">
                                            <span class="text-capitalize xsm-text d-inline-block font-weight-bold">
                                                Pay Mode
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <select name="paymentMethod" id="paymentMethod" class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5 form-control rounded-0 text-center">
                                                <?php
                                                $paymentMethods = getAllDataOfPaymentMethodTable(" AND show_in_pos = 1 ORDER BY id");
                                                foreach ($paymentMethods as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $paymentMethods[$key]['id']; ?>"><?php echo $paymentMethods[$key]['name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-5 text-center">
                            <div class="row g-0">
                                <div class="col-4">
                                    <span class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5">
                                        Discount
                                    </span>
                                </div>
                                <div class="col-4">
                                    <select name="discountType" id="discountType" class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5 form-control rounded-0 text-center">
                                        <option value="direct">Direct</option>
                                        <option value="percentage">Percantage</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="number" step="1" min="0" class="text-capitalize xsm-text d-inline-block font-weight-bold t-pt-5 t-pb-5 form-control rounded-0 text-center" value="0" id="discountAmount" onkeyup="discountPressed(this.value)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="t-bg-epsilon t-pl-10 t-pr-10">
                    <div class="row">
                        <div class="col-6">
                            <span class="text-capitalize font-weight-bold text-light d-block t-pt-8 t-pb-10">
                                Total Bill
                            </span>
                        </div>
                        <div class="col-6 text-right">
                            <input type="hidden" name="totalBill" id="totalBill" value="<?php echo  round($grandTotal, 2); ?>">
                            <span class="text-capitalize font-weight-bold text-light d-block t-pt-8 t-pb-10">
                                ৳ <span id="shownBill"><?php echo  round($grandTotal, 2); ?></span>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- <div class="t-bg-light-2 t-pr-10">
                                                                    <div class="row gx-2 align-items-center">
                                                                        <div class="col-6"></div>
                                                                        <div class="col-6 text-right">
                                                                            <div class="row gx-2 align-items-center">
                                                                                <div class="col-6 text-left"><span class="text-capitalize font-weight-bold d-block">Return</span>
                                                                                </div>
                                                                                <div class="col-6"><span class="text-capitalize font-weight-bold d-block">BDT
                                                                                        0.00</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                <div class="row g-0 align-items-center t-mt-10">

                    <div class="col-12">
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="t-mr-8">
                                <button type="button" class="btn btn-danger sm-text text-uppercase font-weight-bold finishingButtons" onclick="finalFunctions('kot');">
                                    KOT
                                </button>
                            </div>
                            <div class="t-mr-8">
                                <button type="button" class="btn btn-secondary sm-text text-uppercase font-weight-bold finishingButtons" onclick="finalFunctions('print');">
                                    Print
                                </button>
                            </div>
                            <!-- <div class="t-mr-8">
                                                                                <button type="button" class="btn btn-secondary sm-text text-uppercase font-weight-bold finishingButtons" onclick="finalFunctions('saveprint');">
                                                                                    Save & Print
                                                                                </button>
                                                                            </div>
                                                                            <div class="t-mr-8">
                                                                                <button type="button" class="btn btn-secondary sm-text text-uppercase font-weight-bold finishingButtons" onclick="finalFunctions('savebillkot');">
                                                                                    Save, Bill & KOT
                                                                                </button>
                                                                            </div> -->
                            <div>
                                <button type="button" class="btn btn-success sm-text text-uppercase font-weight-bold finishingButtons" onclick="finalFunctions('saveclear');">
                                    Save, Bill & Clear
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php

}

function reloadTableList()
{
?>

    <?php
    foreach ($_SESSION as $key => $index) {
        if (strpos($key, "table0") === 0  ||  strpos($key, "table1") === 0  ||  strpos($key, "table2") === 0) {
            if (count($_SESSION[$key]) > 0) {
    ?>
                <li class="li-table" style="background-color: #ff114d;">
                    <input class="styled-checkbox" id="ti<?php echo $key; ?>" type="radio" value="<?php echo substr($key, -2); ?>" name="tableId" onclick="reloadListPos(this.value)">
                    <label for="ti<?php echo $key; ?>">T-<?php echo substr($key, -2); ?></label>
                </li>
            <?php
            } else {
            ?>
                <li class="li-table" style="background-color: #47f347;">
                    <input class="styled-checkbox" id="ti<?php echo $key; ?>" type="radio" name="tableId" value="<?php echo substr($key, -2); ?>" onclick="reloadListPos(this.value)">
                    <label for="ti<?php echo $key; ?>">T-<?php echo substr($key, -2); ?></label>
                </li>
    <?php
            }
        }
    }
    ?>

<?php
}

function itemWisePurchaseReport()
{
    global $con;
    $ingredientId = $_REQUEST['ingredientId'];
    $subBranchId = $_REQUEST['subBranchId']; //give zero if needed for all
    $fromDate = $_REQUEST['fromDate'] . " 00:00:00";
    $toDate = $_REQUEST['toDate'] . " 23:59:59";

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
?>

    <thead>
        <tr>
            <th>Sl No</th>
            <th>Item Name</th>
            <th>Purchase Date</th>
            <th>Purchase Amount</th>
            <th>Unit Price</th>
            <th>Total Price</th>
            <th>Current Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
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
            }
        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><?php $ingDetails = getIngredientDetailsFromId($stockTableData[$key]['ingredient_id']);
                                        echo $ingDetails['ingredient_name']; ?></td>
                <td class="text-center"><?php echo $stockTableData[$key]['purchase_date']; ?></td>
                <td class="text-center"><?php echo $purchasedAmount . " " . getDefaultWeightInNameFromIngredientId($stockTableData[$key]['ingredient_id']); ?></td>
                <td class="text-center"><?php echo $ingredientUnitPrice; ?></td>
                <td class="text-center"><?php echo round($purchasedAmount * $ingredientUnitPrice, 2); ?></td>
                <td class="text-center"><?php echo $stockTableData[$key]['ingredient_amount'] . " " . getDefaultWeightInNameFromIngredientId($stockTableData[$key]['ingredient_id']); ?></td>
            </tr>
        <?php $i++;
        } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Sl No</th>
            <th>Item Name</th>
            <th>Purchase Date</th>
            <th>Purchase Amount</th>
            <th>Unit Price</th>
            <th>Total Price</th>
            <th>Current Stock</th>
        </tr>
    </tfoot>

<?php
}


function itemWiseSalesReport()
{

    global $con;
    $productId = $_REQUEST['productId'];
    $subBranchId = $_REQUEST['subBranchId']; //give zero if needed for all
    $fromDate = $_REQUEST['fromDate'];
    $toDate = $_REQUEST['toDate'];
    $finalProductsArray = getItemwiseSalesReport($productId, $subBranchId, $fromDate, $toDate);


?>

    <thead>
        <tr>
            <th>Sl No</th>
            <th>Item Name</th>
            <th>Total Sold Unit</th>
            <th>Average Selling Price</th>
            <th>Total Sold (Taka)</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($finalProductsArray as $key => $value) {
        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><?php echo $finalProductsArray[$key]['product_name'] . "(" . $finalProductsArray[$key]['product_size_name'] . ")"; ?></td>
                <td class="text-center"><?php echo $finalProductsArray[$key]['quantity']; ?></td>
                <td class="text-center"><?php echo round($finalProductsArray[$key]['product_price'] / $finalProductsArray[$key]['quantity'], 2); ?></td>
                <td class="text-center"><?php echo $finalProductsArray[$key]['product_price']; ?></td>
            </tr>
        <?php $i++;
        } ?>

    </tbody>
    <tfoot>
        <tr>
            <th>Sl No</th>
            <th>Item Name</th>
            <th>Total Sold Unit</th>
            <th>Average Selling Price</th>
            <th>Total Sold (Taka)</th>

        </tr>
    </tfoot>

<?php
}

function dailyReport()
{
    global $con;
    $subBranchId = $_REQUEST['subBranchId']; //give zero if needed for all
    $nullSubBranchId = null;
    $fromDate = $_REQUEST['fromDate'];
    $toDate = $_REQUEST['toDate'];

    if ($subBranchId != 0) {
        $nullSubBranchId = $subBranchId;
    }

?>
    <!-- ticket wise report -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Ticket Report</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="paymentMethodwiseReport" class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Branch Name</th>
                        <th>Total Ticket</th>
                        <th>Total Bill</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    $totalTicket = 0;
                    $totalBill = 0;
                    $ticketReportDetails = orderCountReport($nullSubBranchId, $fromDate, $toDate);
                    foreach ($ticketReportDetails as $key => $value) {

                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>

                            <td class="text-center">
                                <?php
                                echo $ticketReportDetails[$key]['sub_branch_name'];
                                ?>
                            </td>

                            <td class="text-center">
                                <?php
                                echo $ticketReportDetails[$key]['total_orders'];
                                ?>
                            </td>

                            <td class="text-center">
                                <?php
                                echo $ticketReportDetails[$key]['total_bill'];
                                ?>
                            </td>
                        </tr>
                    <?php
                        $totalBill = $totalBill + $ticketReportDetails[$key]['total_bill'];
                        $totalTicket = $totalTicket + $ticketReportDetails[$key]['total_orders'];
                        $i++;
                    }
                    ?>

                    <tr class="bg-info">
                        <td colspan="2">
                            <b>Summary</b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo $totalTicket;
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo $totalBill;
                                ?>
                            </b>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl No</th>
                        <th>Branch Name</th>
                        <th>Total Ticket</th>
                        <th>Total Bill</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- ticket wise report -->

    <!-- payment method wise report -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Payment Methodwise Report</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="paymentMethodwiseReport" class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Payment Method</th>
                        <th>Total Bill</th>
                        <th>Total Paid Amount</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $i = 1;
                    $paymentMethodReportDetails = getPaymentMethodwiseReport($nullSubBranchId, null, $fromDate, $toDate);
                    foreach ($paymentMethodReportDetails as $key => $value) {

                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center">
                                <?php
                                if ($paymentMethodReportDetails[$key]['payment_method_id'] == 1) {
                                    echo "Cash From Online Delivery";
                                } elseif ($paymentMethodReportDetails[$key]['payment_method_id'] == 2) {
                                    echo "Online Payment From Online Delivery";
                                } else {
                                    echo $paymentMethodReportDetails[$key]['payment_method_name'];
                                }

                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                echo $paymentMethodReportDetails[$key]['total_bill'];
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                if ($paymentMethodReportDetails[$key]['payment_method_id'] == 1) {
                                    echo $paymentMethodReportDetails[$key]['total_bill'];
                                } elseif ($paymentMethodReportDetails[$key]['payment_method_id'] == 2) {
                                    echo $paymentMethodReportDetails[$key]['total_bill'];
                                } else {
                                    echo $paymentMethodReportDetails[$key]['total_paid_amount'];
                                }
                                ?>
                            </td>

                        </tr>
                    <?php
                        $i++;
                    }
                    ?>

                    <tr class="bg-info">
                        <td colspan="2">
                            <b>Summary</b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo $paymentMethodReportDetails[$key]['grand_total_bill'];
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo $paymentMethodReportDetails[$key]['grand_paid_amount'];
                                ?>
                            </b>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl No</th>
                        <th>Payment Method</th>
                        <th>Total Bill</th>
                        <th>Total Paid Amount</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- payment method wise report -->
    <?php if ($_SESSION['user_type'] == 1 && $_SESSION['user_type'] == 6) { ?>
        <!-- customer wise report -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Customer Wise Report</h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="customerwiseReport" class="table table-bordered text-center table-striped">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Customer Name</th>
                            <th>Total Orders</th>
                            <th>Total Bill</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;
                        $customerReportDetails = getCustomerwiseReport($nullSubBranchId, null, $fromDate, $toDate);
                        foreach ($customerReportDetails as $key => $value) {

                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
                                    <?php

                                    echo $customerReportDetails[$key]['customer_name'];

                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php

                                    echo $customerReportDetails[$key]['number_of_order'];

                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    echo $customerReportDetails[$key]['total_bill'];
                                    ?>
                                </td>

                            </tr>
                        <?php
                            $i++;
                        }
                        ?>

                        <tr class="bg-info">
                            <td colspan="3">
                                <b>Summary</b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    echo $customerReportDetails[$key]['grand_total_bill'];
                                    ?>
                                </b>
                            </td>

                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sl No</th>
                            <th>Customer Method</th>
                            <th>Total Orders</th>
                            <th>Total Bill</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- customer wise report -->
    <?php } ?>
    <!-- item wise report -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Item Wise Sales Report</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="itemwiseSalesReport" class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Item Name</th>
                        <th>Total Sold Unit</th>
                        <th>Average Selling Price</th>
                        <th>Total Sold (Taka)</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $itemwiseReportDetails = getItemwiseSalesReport(0, $subBranchId, $fromDate, $toDate);
                    $totalItemWiseSalesQuantity = 0;
                    $totalItemWiseSalesAmount = 0;
                    foreach ($itemwiseReportDetails as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $itemwiseReportDetails[$key]['product_name'] . "(" . $itemwiseReportDetails[$key]['product_size_name'] . ")"; ?></td>
                            <td class="text-center"><?php echo $itemwiseReportDetails[$key]['quantity']; ?></td>
                            <td class="text-center"><?php echo round($itemwiseReportDetails[$key]['product_price'] / $itemwiseReportDetails[$key]['quantity'], 2); ?></td>
                            <td class="text-center"><?php echo $itemwiseReportDetails[$key]['product_price']; ?></td>
                        </tr>
                    <?php
                        $totalItemWiseSalesQuantity = $totalItemWiseSalesQuantity + $itemwiseReportDetails[$key]['quantity'];
                        $totalItemWiseSalesAmount = $totalItemWiseSalesAmount + $itemwiseReportDetails[$key]['product_price'];
                        $i++;
                    } ?>

                    <tr class="bg-info">
                        <td colspan="2">
                            <b>Summary</b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo $totalItemWiseSalesQuantity;
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo round($totalItemWiseSalesAmount / $totalItemWiseSalesQuantity);
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo $totalItemWiseSalesAmount;
                                ?>
                            </b>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl No</th>
                        <th>Item Name</th>
                        <th>Total Sold Unit</th>
                        <th>Average Selling Price</th>
                        <th>Total Sold (Taka)</th>

                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- item wise report -->

    <!-- item wise purchase report -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Item Wise Purchase Report</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="itemwisePurchaseReport" class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Item Name</th>
                        <th>Purchase Date</th>
                        <th>Purchase Amount</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Current Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $totalPurchaseAmount = 0;
                    $itemwisePurchaseReportDetails = getItemwisePurchaseReport(0, $subBranchId,  $fromDate, $toDate);
                    foreach ($itemwisePurchaseReportDetails as $key => $value) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['ingredient_name']; ?></td>
                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['purchase_date']; ?></td>
                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['purchase_amount']; ?></td>
                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['ingredient_unit_price']; ?></td>
                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['ingredient_price']; ?></td>
                            <td class="text-center"><?php echo $itemwisePurchaseReportDetails[$key]['current_stock']; ?></td>
                        </tr>
                    <?php
                        $totalPurchaseAmount = $totalPurchaseAmount + $itemwisePurchaseReportDetails[$key]['ingredient_price'];
                        $i++;
                    }
                    ?>

                    <tr class="bg-info">
                        <td colspan="6">
                            <b>Total Purchase</b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo "BDT " . $totalPurchaseAmount;
                                ?>
                            </b>
                        </td>

                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <th>Sl No</th>
                        <th>Item Name</th>
                        <th>Purchase Date</th>
                        <th>Purchase Amount</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Current Stock</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- item wise purchase report -->
<?php
}


function saveExpenseDetails()
{
    global $con;


    $addExpenseSubBranch = $_REQUEST['addExpenseSubBranch'];
    $addExpenseRemarks = $_REQUEST['addExpenseRemarks'];
    $addExpenseExpenseType = $_REQUEST['addExpenseExpenseType'];
    $addExpenseDate = $_REQUEST['addExpenseDate'];
    $addExpenseAmount = $_REQUEST['addExpenseAmount'];

    $userId = $_SESSION['user_id'];


    $sql = "INSERT INTO `expense_details` (`branch_id`, `sub_branch_id`, `expense_name_id`, `expense_time`, `amount`, `remarks`, `created_by`) VALUES ('1', '$addExpenseSubBranch', '$addExpenseExpenseType', '$addExpenseDate', '$addExpenseAmount', '$addExpenseRemarks', '$userId')";

    if ($con->query($sql)) {
        echo "1";
    } else {
        echo "0";
    }
}


function expenseReport()
{
    global $con;
    $subBranchId = $_REQUEST['subBranchId']; //give zero if needed for all
    $fromDate = $_REQUEST['fromDate'];
    $toDate = $_REQUEST['toDate'];
?>
    <thead>
        <tr>
            <th>Sl No</th>
            <th>Branch Name</th>
            <th>Expense Type</th>
            <th>Expense Date</th>
            <th>Expense Amount</th>
            <th>Expense Remarks</th>
            <th>Edit Code</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalAmount = 0;
        if ($subBranchId == 0) {
            $subBranchQuery = "";
        } else {
            $subBranchQuery = " AND sub_branch_id = " . $subBranchId;
        }


        $result = getAllDataOfExpenseDetailsTable($subBranchQuery . " AND expense_time BETWEEN '$fromDate' AND '$toDate'");
        $i = 1;
        foreach ($result as $key => $value) {

            $expenseTypeDetails = getExpenseNameTableDetailsFromId($result[$key]['expense_name_id']);
            $subBranchDetails = getSubBranchDetailsFromId($result[$key]['sub_branch_id']);
        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><?php echo $subBranchDetails['name']; ?></td>
                <td class="text-center">
                    <b>
                        <?php echo $expenseTypeDetails['name']; ?>
                    </b>
                </td>
                <td class="text-center">
                    <?php
                    $time = strtotime($result[$key]['expense_time']);
                    $newformat = date('d-m-Y', $time);
                    echo $newformat;
                    ?>
                </td>
                <td class="text-center"><?php $totalAmount = $totalAmount + $result[$key]['amount'];
                                        echo $result[$key]['amount']; ?></td>
                <td class="text-center"><?php echo $result[$key]['remarks']; ?></td>

                <td class="text-center">
                    <?php
                    echo "sliated" . strtolower(numberTowords($result[$key]['id'])) . "esnepxe";
                    ?>
                </td>
            </tr>

            <tr class="bg-info text-center">
                <td colspan="4">Total Amount</td>
                <td colspan="3"><?php echo $totalAmount; ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Sl No</th>
            <th>Branch Name</th>
            <th>Expense Type</th>
            <th>Expense Date</th>
            <th>Expense Amount</th>
            <th>Expense Remarks</th>
            <th>Edit Code</th>
        </tr>
    </tfoot>
<?php
}


//this will always be the last fucntion
function showProcessingWindow()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adding to Cart</title>
        <style>
            @import url("https://fonts.googleapis.com/css?family=Amatic+SC");

            body {
                background-color: #ffde6b;
                height: 100vh;
                width: 100vw;
                overflow: hidden;
            }

            h1 {
                position: relative;
                margin: 0 auto;
                top: 25vh;
                width: 100vw;
                text-align: center;
                font-family: 'Amatic SC';
                font-size: 6vh;
                color: #333;
                opacity: .75;
                animation: pulse 2.5s linear infinite;
            }

            h1 .custom {
                position: relative;
                margin: 0 auto;
                top: 25vh;
                width: 100vw;
                text-align: center;
                font-family: 'Amatic SC';
                font-size: 6vh;
                color: #333;
                opacity: .75;
            }

            #cooking {
                position: relative;
                margin: 0 auto;
                top: 0;
                width: 75vh;
                height: 75vh;
                overflow: hidden;
            }

            #cooking .bubble {
                position: absolute;
                border-radius: 100%;
                box-shadow: 0 0 0.25vh #4d4d4d;
                opacity: 0;
            }

            #cooking .bubble:nth-child(1) {
                margin-top: 2.5vh;
                left: 58%;
                width: 2.5vh;
                height: 2.5vh;
                background-color: #454545;
                animation: bubble 2s cubic-bezier(0.53, 0.16, 0.39, 0.96) infinite;
            }

            #cooking .bubble:nth-child(2) {
                margin-top: 3vh;
                left: 52%;
                width: 2vh;
                height: 2vh;
                background-color: #3d3d3d;
                animation: bubble 2s ease-in-out .35s infinite;
            }

            #cooking .bubble:nth-child(3) {
                margin-top: 1.8vh;
                left: 50%;
                width: 1.5vh;
                height: 1.5vh;
                background-color: #333;
                animation: bubble 1.5s cubic-bezier(0.53, 0.16, 0.39, 0.96) 0.55s infinite;
            }

            #cooking .bubble:nth-child(4) {
                margin-top: 2.7vh;
                left: 56%;
                width: 1.2vh;
                height: 1.2vh;
                background-color: #2b2b2b;
                animation: bubble 1.8s cubic-bezier(0.53, 0.16, 0.39, 0.96) 0.9s infinite;
            }

            #cooking .bubble:nth-child(5) {
                margin-top: 2.7vh;
                left: 63%;
                width: 1.1vh;
                height: 1.1vh;
                background-color: #242424;
                animation: bubble 1.6s ease-in-out 1s infinite;
            }

            #cooking #area {
                position: absolute;
                bottom: 0;
                right: 0;
                width: 50%;
                height: 50%;
                background-color: transparent;
                transform-origin: 15% 60%;
                animation: flip 2.1s ease-in-out infinite;
            }

            #cooking #area #sides {
                position: absolute;
                width: 100%;
                height: 100%;
                transform-origin: 15% 60%;
                animation: switchSide 2.1s ease-in-out infinite;
            }

            #cooking #area #sides #handle {
                position: absolute;
                bottom: 18%;
                right: 80%;
                width: 35%;
                height: 20%;
                background-color: transparent;
                border-top: 1vh solid #333;
                border-left: 1vh solid transparent;
                border-radius: 100%;
                transform: rotate(20deg) rotateX(0deg) scale(1.3, 0.9);
            }

            #cooking #area #sides #pan {
                position: absolute;
                bottom: 20%;
                right: 30%;
                width: 50%;
                height: 8%;
                background-color: #333;
                border-radius: 0 0 1.4em 1.4em;
                transform-origin: -15% 0;
            }

            #cooking #area #pancake {
                position: absolute;
                top: 24%;
                width: 100%;
                height: 100%;
                transform: rotateX(85deg);
                animation: jump 2.1s ease-in-out infinite;
            }

            #cooking #area #pancake #pastry {
                position: absolute;
                bottom: 26%;
                right: 37%;
                width: 40%;
                height: 45%;
                background-color: #333;
                box-shadow: 0 0 3px 0 #333;
                border-radius: 100%;
                transform-origin: -20% 0;
                animation: fly 2.1s ease-in-out infinite;
            }

            @keyframes jump {
                0% {
                    top: 24%;
                    transform: rotateX(85deg);
                }

                25% {
                    top: 10%;
                    transform: rotateX(0deg);
                }

                50% {
                    top: 30%;
                    transform: rotateX(85deg);
                }

                75% {
                    transform: rotateX(0deg);
                }

                100% {
                    transform: rotateX(85deg);
                }
            }

            @keyframes flip {
                0% {
                    transform: rotate(0deg);
                }

                5% {
                    transform: rotate(-27deg);
                }

                30%,
                50% {
                    transform: rotate(0deg);
                }

                55% {
                    transform: rotate(27deg);
                }

                83.3% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(0deg);
                }
            }

            @keyframes switchSide {
                0% {
                    transform: rotateY(0deg);
                }

                50% {
                    transform: rotateY(180deg);
                }

                100% {
                    transform: rotateY(0deg);
                }
            }

            @keyframes fly {
                0% {
                    bottom: 26%;
                    transform: rotate(0deg);
                }

                10% {
                    bottom: 40%;
                }

                50% {
                    bottom: 26%;
                    transform: rotate(-190deg);
                }

                80% {
                    bottom: 40%;
                }

                100% {
                    bottom: 26%;
                    transform: rotate(0deg);
                }
            }

            @keyframes bubble {
                0% {
                    transform: scale(0.15, 0.15);
                    top: 80%;
                    opacity: 0;
                }

                50% {
                    transform: scale(1.1, 1.1);
                    opacity: 1;
                }

                100% {
                    transform: scale(0.33, 0.33);
                    top: 60%;
                    opacity: 0;
                }
            }

            @keyframes pulse {
                0% {
                    transform: scale(1, 1);
                    opacity: .25;
                }

                50% {
                    transform: scale(1.2, 1);
                    opacity: 1;
                }

                100% {
                    transform: scale(1, 1);
                    opacity: .25;
                }
            }
        </style>
    </head>

    <body>

        <h1>Things Being Cooked !</h1>
        <h1 class="custom">This Is Not Your Place, Redirecting to your Page</h1>


        <div id="cooking">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div id="area">
                <div id="sides">
                    <div id="pan"></div>
                    <div id="handle"></div>
                </div>
                <div id="pancake">
                    <div id="pastry"></div>
                </div>
            </div>
        </div>

        <script>
            setTimeout(function() {
                window.history.back();
            }, 5000);
        </script>
    </body>

    </html>
<?php
}






?>