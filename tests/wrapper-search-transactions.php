<?php
    require "../vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Transaction;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $typeTransaction = "confirmed";
    $netType = Network::getIdfromName("publictest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->SearchTransactions($config,$typeTransaction);
    var_dump($transaction);
?>