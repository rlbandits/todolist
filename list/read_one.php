<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/list.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare list object
$list = new todoList($db);

// set ID property of list to be edited
$list->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of list to be edited
$list->readOne();

// create array
$list_arr = array(
    "id" =>  $list->id,
    "text" => $list->text,
    "dateTimeCreated" => $list->dateTimeCreated,
    "dateTimeReminder" => $list->dateTimeReminder

);

// make it json format
print_r(json_encode($list_arr));
?>