<?php
    require "vendor/autoload.php";

    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Sdk\Network as NetworkSdk;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $type = (new NetworkSdk)->GetNetworkType($config);
    var_dump($type);
?>