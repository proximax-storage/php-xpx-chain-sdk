<?php
    require "vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Transaction;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://13.229.183.224:3000";
    $wsReconnectionTimeout = 5000;
    $transId = "5D4CDC46C682350001782297";
    $hash = "555C32CAECA8626A0DBB665CEB708F64C2BF7E8C8C4B6E5FB6FEA0C23EA13C94";
    $netType = Network::getIdfromName("PublicTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransaction($config,$transId);
    var_dump($transaction);
?>