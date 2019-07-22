<?php
    require "vendor/autoload.php";
    use NEM\Model\Config;
    use NEM\Sdk\Account;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $pKey = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";
    $netType = Network::getIdfromName("PublicTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Account = new Account;
    $account = $Account->Transactions($config,$pKey);
    var_dump($account);
?>