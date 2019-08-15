<?php
    require "vendor/autoload.php";
    use NEM\Model\Config;
    use NEM\Sdk\Account;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.105:3000";
    $wsReconnectionTimeout = 5000;
    $pKey = "803BD90020E0BB5F0B03AC75C86056A4D4AB5940F2A3A520694D8E7FF217E961";
    $netType = Network::getIdfromName("MijinTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Account = new Account;
    $account = $Account->Transactions($config,$pKey);
    var_dump($account);
?>