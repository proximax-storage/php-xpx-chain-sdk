<?php
    require "vendor/autoload.php";

    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Sdk\Blockchain;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $height = (new Blockchain)->GetBlockchainHeight($config);
    var_dump($height->getHeightValue());

?>