<?php
class Todolist{

    // database connection and table name
    private $conn;
    private $table_name = "list";

    // object properties
    public $id;
    public $text;
    public $dateTimeCreated;
    public $dateTimeReminder;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create list
    function create(){
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                text=:text, dateTimeCreated=:dateTimeCreated, dateTimeReminder=:dateTimeReminder";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->text=htmlspecialchars(strip_tags($this->text));
        $this->dateTimeCreated=htmlspecialchars(strip_tags($this->dateTimeCreated));
        $this->dateTimeReminder=htmlspecialchars(strip_tags($this->dateTimeReminder));

        // bind values
        $stmt->bindParam(":text", $this->text);
        $stmt->bindParam(":dateTimeCreated", $this->dateTimeCreated);
        $stmt->bindParam(":dateTimeReminder",date_format(date_create($this->dateTimeReminder),'Y-m-d H:i:s'));

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // read reminders
    function read(){
        // select all query
        $query = "SELECT * FROM " . $this->table_name;

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read one record
    function readOne(){
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind id of reminder to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->text = $row['text'];
        $this->dateTimeCreated = $row['dateTimeCreated'];
        $this->dateTimeReminder = $row['dateTimeReminder'];
    }

    // search lists
    function search($keywords){

        // select all query
        $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            WHERE
                text LIKE ?
            ORDER BY
                dateTimeCreated DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // update reminder
    function update(){
        // update query
        $query = "UPDATE " . $this->table_name . " SET text = :text, dateTimeCreated = :dateTimeCreated, dateTimeReminder = :dateTimeReminder WHERE id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->text=htmlspecialchars(strip_tags($this->text));
        $this->dateTimeCreated=htmlspecialchars(strip_tags($this->dateTimeCreated));
        $this->dateTimeReminder=htmlspecialchars(strip_tags($this->dateTimeReminder));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':text', $this->text);
        $stmt->bindParam(':dateTimeCreated', $this->dateTimeCreated);
        $stmt->bindParam(':dateTimeReminder', $this->dateTimeReminder);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // delete the reminder
    function delete(){

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }

}