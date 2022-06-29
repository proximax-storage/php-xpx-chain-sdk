<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Contract;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $contractId = "F5FB54E9A2AC5B616C92D5FCC52A98A5FA03B4E0ECE0C51B2ABB7FA25D75B9DA";
    $contractInfo = (new Contract)->GetContract($config,$contractId);
    var_dump($contractInfo);
?>