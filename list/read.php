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
$list = new Todolist($db);
 
// query list
$stmt = $list->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // list array
    $list_arr=array();
    $list_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $list_item=array(
            "id" => $id,
            "text" => $text,
            "dateTimeCreated" =>$dateTimeCreated,
            "dateTimeReminder" => $dateTimeReminder
        );
 
        array_push($list_arr["records"], $list_item);
    }
 
    echo json_encode($list_arr);
}
 
else{
    echo json_encode(
        array("message" => "Nothing to do here.")
    );
}
?>