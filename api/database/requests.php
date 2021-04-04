<?php
    include("database.php");

    //this class includes "request" table CRUD operations
    class Requests
    {
        private $connection;

        public function __construct(){
            $database = new Database();
            $this->connection = $database->connect();
        }

        //this method adds new request to table
        public function addNewData($requestType, $responseTime, $responseTimestamp)
        {       
            $query= "INSERT INTO request (requestType, responseTime, responseTimestamp) VALUES ('$requestType', '$responseTime', '$responseTimestamp')";

            mysqli_query($this->connection, $query);
        }
    }
?>