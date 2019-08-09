<?php
    require "vendor/autoload.php";
    use NEM\Model\Config;
    use NEM\Sdk\Transaction;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://13.229.183.224:3000";
    $wsReconnectionTimeout = 5000;
    $hash = "7C0056F27904C28A26AAA908667C99565FFB8E1962A4706E8D107EB0CB6E4A5C";
    $netType = Network::getIdfromName("PublicTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransactionStatus($config,$hash);
    var_dump($transaction);
?>