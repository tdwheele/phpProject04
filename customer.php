<?php
session_start();
if (!isset($_SESSION["username"])){
    header("Location: login.php");
}
// include the class that handles database connections
require "database.php";

// include the class containing functions/methods for "customer" table
// Note: this application uses "customer" table, not "cusotmers" table
require "customer.class.php";
$cust = new Customer();
 
// set active record field values, if any 
// (field values not set for display_list and display_create_form)
if(isset($_GET["id"]))          $id = $_GET["id"]; 
if(isset($_POST["name"]))       $cust->name = $_POST["name"];
if(isset($_POST["email"]))      $cust->email = $_POST["email"];
if(isset($_POST["mobile"]))     $cust->mobile = $_POST["mobile"];
if(isset($_POST["password"]))   $cust->password = $_POST["password"];
if(isset($_POST["filename"]))   $cust->filename = $_POST["filename"];
if(isset($_POST["filesize"]))   $cust->filesize = $_POST["filesize"];
if(isset($_POST["filetype"]))   $cust->filetype = $_POST["filetype"];
if(isset($_POST["content"]))   $cust->content = $_POST["content"];
if(isset($_POST["description"]))   $cust->description = $_POST["decription"];


// "fun" is short for "function" to be invoked 
if(isset($_GET["fun"])) $fun = $_GET["fun"];
else $fun = "display_list"; 

switch ($fun) {
    case "display_list":        $cust->list_records();
        break;
    case "display_create_form": $cust->create_record(); 
        break;
    case "display_read_form":   $cust->read_record($id); 
        break;
    case "display_update_form": $cust->update_record($id);
        break;
    case "display_delete_form": $cust->delete_record($id); 
        break;
    case "insert_db_record":    $cust->insert_db_record(); 
        break;
    case "update_db_record":    $cust->update_db_record($id);
        break;
    case "delete_db_record":    $cust->delete_db_record($id);
        break;
    default: 
        echo "Error: Invalid function call (customer.php)";
        exit();
        break;
}
