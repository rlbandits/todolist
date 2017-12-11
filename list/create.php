<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate list object
include_once '../objects/list.php';

$database = new Database();
$db = $database->getConnection();

$list = new Todolist($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set reminder property values
$list->text = $data->textReminder;
$list->dateTimeCreated = date('Y-m-d H:i:s');
$list->dateTimeReminder = date_format(date_create($data->dateTimeReminder),'Y-m-d H:i:s');

// create the reminder
if($list->create()){
    echo '{';
    echo '"message": "Reminder was created."';
    echo '}';
}

// if unable to create the reminder, tell the user
else{
    echo '{';
    echo '"message": "Unable to create reminder."';
    echo '}';
}
?>