<?php  
header('location: 404.php');
exit();
  header("Content-Type: text/plain");

 require "includes/connect.php";

  $string_to_replace  = '.png';
  $new_string = '.webp';


  // List all tables in database
  $database = "konacafe_erp";
  $sql = "SHOW TABLES FROM ".$database;
  $tables_result = mysqli_query($con,$sql);
  $tables_result;

  
  echo "In these fields '$string_to_replace' have been replaced with '$new_string'\n\n";
  while ($table = mysqli_fetch_row($tables_result)) {
    echo "Table: {$table[0]}\n";
    $fields_result = mysqli_query($con,"SHOW COLUMNS FROM ".$table[0]);
    if (!$fields_result) {
      echo 'Could not run query: ' . mysqli_error();
      exit;
    }
    if (mysqli_num_rows($fields_result) > 0) {
      while ($field = mysqli_fetch_assoc($fields_result)) {
        if (stripos($field['Type'], "VARCHAR") !== false || stripos($field['Type'], "TEXT") !== false) {
          echo "  ".$field['Field']."\n";
          $sql = "UPDATE ".$table[0]." SET ".$field['Field']." = replace(".$field['Field'].", '$string_to_replace', '$new_string')";
          mysqli_query($con,$sql);
        }
      }
      echo "\n";
    }
  }

  mysqli_free_result($tables_result);  
?>