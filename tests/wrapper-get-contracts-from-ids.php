<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Contract;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $contractId = "F5FB54E9A2AC5B616C92D5FCC52A98A5FA03B4E0ECE0C51B2ABB7FA25D75B9DA";
    $contractInfo = (new Contract)->GetContracts($config,array($contractId));
    var_dump($contractInfo);
?>