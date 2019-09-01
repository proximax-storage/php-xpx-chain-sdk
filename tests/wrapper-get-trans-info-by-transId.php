<?php
    require "vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Transaction;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.1.41:3000";
    $wsReconnectionTimeout = 5000;
    $transId = "5D4CDC46C682350001782297";
    $hash = "52F7221E2269E71CB7C26E5A6A062B74D04B8900E3A4A683ED5B2E6691C4EC40";
    $netType = Network::getIdfromName("MijinTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransaction($config,$hash);
    var_dump($transaction);
?>