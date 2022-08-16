<?php
    require "../vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Transaction;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $arr_hash = array("A18A4B374F73652276CBEECE4A3D09CD86D937D0BAA21C1C7EA4A7AEA8D5CB71");
    $netType = Network::getIdfromName("publictest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransactionsStatuses($config,$arr_hash);
    var_dump($transaction);
?>