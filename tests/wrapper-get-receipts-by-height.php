<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Blockchain;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $height = 4654;
    $receipts = (new Blockchain)->GetReceiptsByHeight($config,$height);
    var_dump($receipts);

?>