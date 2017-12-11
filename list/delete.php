<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object file
include_once '../config/database.php';
include_once '../objects/list.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare list object
$list = new Todolist($db);

// get reminder id
$data = json_decode(file_get_contents("php://input"));

// set reminder id to be deleted
$list->id = $data->id;

// delete the reminder
if($list->delete()){
    echo '{';
    echo '"message": "Reminder was deleted."';
    echo '}';
}

// if unable to delete the reminder
else{
    echo '{';
    echo '"message": "Unable to delete reminder."';
    echo '}';
}
?>