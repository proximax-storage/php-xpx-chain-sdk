<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Network as NetworkSdk;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://13.229.183.224:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $type = (new NetworkSdk)->GetNetworkType($config);
    var_dump($type);
?>