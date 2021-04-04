<?php
    include("producer.php");

    //this class includes a method for logging incoming requests with additional information
    class Logger
    {
        private $producer; //an async job

        public function __construct()
        {        
            $this->producer = new Producer();
        }

        public function log($startTime, $requestMethod)
        {
            //if "log.txt" file doesn't exist, creates it
            if(!file_exists("log.txt"))
            {
                file_put_contents("log.txt", "");
            }
    
            //gets timestamp
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
    
            //calculates the total response time
            $responseTime = round((microtime(true) - $startTime) * 1000, 1);

            //prepares contents
            $contents = "$requestMethod, $responseTime, $timestamp\n";

            //reads "log.txt" file
            $fileContents = file_get_contents("log.txt");
    
            //writes contents into "log.txt" file with "log.txt" file's contents
            file_put_contents("log.txt", $fileContents + $contents);
    
            //sends contents to apache kafka
            $this->producer->sendToKafka("requestMethod=$requestMethod&responseTime=$responseTime&timestamp=$timestamp");
        }    
    }
?>