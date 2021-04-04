<?php
    require 'kafka_php/vendor/autoload.php';

    class Producer
    {
        private $config;
        private $producer;

        public function __construct()
        {
            //configs kafka for this producer
            $this->config = \Kafka\ProducerConfig::getInstance();
            $this->config->setMetadataRefreshIntervalMs(10000);
            $this->config->setMetadataBrokerList('127.0.0.1:9092');
            $this->config->setBrokerVersion('1.0.0');
            $this->config->setRequiredAck(1);
            $this->config->setIsAsyn(false);
            $this->config->setProduceInterval(500);
        }

        //sends messages that taked as parameter to kafka
        public function sendToKafka($value)
        {
            $this->producer = new \Kafka\Producer(
                function() use ($value){
                    return [
                        [
                            'topic' => 'LogTopic',
                            'value' => "$value",
                            'key' => 'log',
                        ],
                    ];
                }
            );      
            
            $this->producer->send(true);
        }
    }    
?>