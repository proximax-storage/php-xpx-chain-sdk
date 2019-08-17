<?php
    require "vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Account;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.105:3000";
    $wsReconnectionTimeout = 5000;
    $pKey = "357966ED5562BAEBF4CBF9D4CB1C7EC30F910C9ADC1B72093C6FEBAF9A75A8C6";
    $netType = Network::getIdfromName("MijinTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Account = new Account;
    $acc = $Account->GetAccountMultisig($config,$pKey);
    var_dump($acc);
?>