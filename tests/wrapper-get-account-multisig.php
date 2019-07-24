<?php
    require "vendor/autoload.php";
    use NEM\Model\Config;
    use NEM\Sdk\Account;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $pKey = "E25F5E9B56973E53B7D1EE4017175A632D5E92807FA6615E9EA12498CE3DDAEB";
    $netType = Network::getIdfromName("PublicTest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Account = new Account;
    $acc = $Account->GetAccountMultisig($config,$pKey);
    var_dump($acc);
?>