<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Lock;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $hash = "B8C1A5FBAA5AB8AB62444212CABB59E2E357DD9099001A29E81C166606810AA6";
    $exchangeInfo = (new Lock)->GetLockHash($config,$hash);
    var_dump($exchangeInfo);
?>