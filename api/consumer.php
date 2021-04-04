<?php
    require 'kafka_php/vendor/autoload.php';

    include("database/requests.php");

    //to add request's informations to database
    $request = new Requests();

    //configs kafka for this consumer
    $config = \Kafka\ConsumerConfig::getInstance();
    $config->setMetadataRefreshIntervalMs(10000);
    $config->setMetadataBrokerList('127.0.0.1:9092');
    $config->setGroupId('log');
    $config->setBrokerVersion('1.0.0');
    $config->setTopics(['LogTopic']);
    
    //creates a new consumer
    $consumer = new \Kafka\Consumer();

    //runs consumer
    $consumer->start(function ($topic, $part, $message) use ($request){
        //parses incoming message for database
        parse_str($message["message"]["value"], $tempArray);

        //adds the informations about requests to database
        $request->addNewData($tempArray["requestMethod"], $tempArray["responseTime"], $tempArray["timestamp"]);
    });
?>