<?php
    require "../vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Account;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $pKey1 = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";
    $pKey2 = "952C2E8302D2C657BC96A6FC8D72018A55F8B521A3AFC7903C88023D92CEF205";

    $netType = Network::getIdfromName("publictest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $add1 = \Proximax\Model\Address::fromPublicKey($pKey1,$netType);
    $add2 = \Proximax\Model\Address::fromPublicKey($pKey2,$netType);

    $arr = array($add1->address,$add2->address);
    $Account = new Account;
    $acc = $Account->GetAccountNames($config,$arr);
    var_dump($acc);
?>