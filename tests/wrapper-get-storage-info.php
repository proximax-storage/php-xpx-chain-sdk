<?php
    require "vendor/autoload.php";

    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Sdk\Blockchain;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://13.229.183.224:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $storage = (new Blockchain)->GetBlockchainStorage($config);
    var_dump($storage);

?>