<?php
    include("database.php");
    header('Content-Type: application/json');

    //this class includes methods for CRUD operations
    class Users{
        private $connection;

        public function __construct(){
            $database = new Database();
            $this->connection = $database->connect();
        }

        //this method returns all users from "user" table
        public function getAll()
        {
            $query = "SELECT * FROM user";
            $result = mysqli_query($this->connection, $query);

            $response = array();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $response[] = $row;
                }
            }

            return json_encode($response);
        }

        //this method returns only one user according by "id"
        public function getWithId($id)
        {
            $query = "SELECT * FROM user";

            if($id != 0)
            {
                $query .= " WHERE id = '$id' LIMIT 1";
            }
            
            $result = mysqli_query($this->connection, $query);

            $response = array();

            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $response[] = $row;
                }
            }
            
            return json_encode($response);
        }

        //this method adds a new user to "user" table and returns a response
        public function addNewUser()
        {
            $userName = addslashes($_POST["userName"]);
            $userSurname = addslashes($_POST["userSurname"]);
            $gender = addslashes($_POST["gender"]);

            $response = array();
           
            $query= "INSERT INTO user (userName, userSurname, gender) VALUES ('$userName', '$userSurname', '$gender')";

            if(mysqli_query($this->connection, $query))
            {
                $response = array("status_code" => 1, "status_message" => "User Added Successfully");
            }
            else
            {
                $response = array("status_code" => 0, "status_message" => "User Addition Failed");
            }                
    
            return json_encode($response);
        }

        //this method updates user who given id, and returns a response
        public function updateUser($id, $userName, $userSurname, $gender)
        {
            $query = "UPDATE user SET userName = '$userName', userSurname = '$userSurname', gender = '$gender' WHERE id = '$id'";
            
            $response = array();

            if(mysqli_query($this->connection, $query))
            {
                $response = array("status_code" => 1, "status_message" => "User Updated Successfully");
            }
            else
            {
                $response = array("status_code" => 0, "status_message" => "User Updation Failed");
            }

            return json_encode($response);
        }

        //this method deletes user who given id from "user" table, and returns a response
        public function deleteUser($id)
        {
            $query="DELETE FROM user WHERE id= '$id'";

            $response = array();

            if(mysqli_query($this->connection, $query))
            {
                $response = array("status_code" => 1, "status_message" => "User Deleted Successfully");
            }
            else
            {
                $response = array("status_code" => 0, "status_message" => "User Deletion Failed");
            }

            return json_encode($response);
        }
    }
?>