<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/list.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare list object
$list = new TodoList($db);

// get id of reminder to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of reminder to be edited
$list->id = $data->id;

$date = new DateTime("now");
// set reminder property values
$list->text = $data->textReminder;
$list->dateTimeCreated = $date->format('Y-m-d H:i:s');
$list->dateTimeReminder = date_format(date_create($data->dateTimeReminder),'Y-m-d H:i:s');

// update reminder
if($list->update()){
    echo '{';
    echo '"message": "todo was updated."';
    echo '}';
}

// if unable to update the reminder, tell the user
else{
    echo '{';
    echo '"message": "Unable to update reminder."';
    echo '}';
}
?>