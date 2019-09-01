<?php
    require "vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Transaction;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.1.41:3000";
    $wsReconnectionTimeout = 5000;
    $hash = "4B203F8E02F4B776FD5C1C62C6CCD70DE57AE1F22266F3764BF6E82838343940";
    $netType = Network::getIdfromName("MijinTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransactionStatus($config,$hash);
    var_dump($transaction);
?>