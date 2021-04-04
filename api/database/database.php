<?php

    //this class includes database informations and a function that for connecting to the database
    class Database
    {
        private $serverName;
        private $userName;
        private $password;
        private $databaseName;
        private $connection;

        public function __construct()
        {
            //sets the database information
            $this->serverName = "localhost";
            $this->userName = "phpuser";
            $this->password = "phpuser";
            $this->databaseName = "APIDB"; 
        }

        public function connect()
        {
            //creates connection
            $this->connection = mysqli_connect($this->serverName, $this->userName, $this->password, $this->databaseName);

            //checks connection
            if(!$this->connection)
            {
                die("failed_connection");
                return;
            }
            
            return $this->connection;
        }
    }   
?>
