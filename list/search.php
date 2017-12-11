<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/list.php';

// instantiate database and list object
$database = new Database();
$db = $database->getConnection();

// initialize object
$list = new todoList($db);

// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";


// query lists
$stmt = $list->search($keywords);

$num = $stmt->rowCount();


// check if more than 0 record found
if($num>0){

    // list array
    $list=array();
    $lists_arr["records"]=array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);

        $list_item = array(
            "id" => $id,
            "text" => $text,
            "dateTimeCreated" => $dateTimeCreated,
            "dateTimeReminder" => $dateTimeReminder
        );

        array_push($lists_arr["records"], $row);
    }

    echo json_encode($lists_arr);
}

else{
    echo json_encode(
        array("message" => "No reminder found.")
    );
}
?>