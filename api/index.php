<?php
    include("database/users.php");
    include("logger.php");

    $user = new Users();
    $logger = new Logger();

    //gets request method type (Is it POST, GET, PUT, DELETE ?)
    $requestMethod = $_SERVER["REQUEST_METHOD"];

    $startTime = microtime(true);

    //takes action according by request method type
    switch($requestMethod)
    {
        case 'GET':
            if(!empty($_GET["id"]))
            {
                $id = intval($_GET["id"]);

                $response = $user->getWithId($id);

                $logger->log($startTime, $requestMethod);

                echo $response;
            }
            else
            {
                $response = $user->getAll();

                $logger->log($startTime, $requestMethod);

                echo $response;
            }
        break;

        case 'POST':
            $response = $user->addNewUser();
            
            $logger->log($startTime, $requestMethod);

            echo $response;

        break;

        case 'PUT':
            $datas = json_decode(file_get_contents("php://input"), true);
            $id = $datas["id"];
            $userName = $datas["userName"];
            $userSurname = $datas["userSurname"];
            $gender = $datas["gender"];

            $response = $user->updateUser($id, $userName, $userSurname, $gender);

            $logger->log($startTime, $requestMethod);

            echo $response;
        break;
        
        case 'DELETE':
            $datas = json_decode(file_get_contents("php://input"), true);
            $id = $datas["id"];

            $response = $user->deleteUser($id);

            $logger->log($startTime, $requestMethod);

            echo $response;
        break;
    }
?>