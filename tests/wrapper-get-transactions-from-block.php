<?php
    require "vendor/autoload.php";

    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Sdk\Blockchain;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.105:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $height = 6891;
    $transactions = (new Blockchain)->GetBlockTransactions($config,$height);
    var_dump($transactions);

?>
