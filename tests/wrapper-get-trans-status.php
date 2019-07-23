<?php
    require "vendor/autoload.php";
    use NEM\Model\Config;
    use NEM\Sdk\Transaction;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $hash = "555C32CAECA8626A0DBB665CEB708F64C2BF7E8C8C4B6E5FB6FEA0C23EA13C94";
    $netType = Network::getIdfromName("PublicTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransactionStatus($config,$hash);
    var_dump($transaction);
?>