<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Contract;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $contractId = "8599BA6DB5B81BB69F96B88DD80A3B9EB7BBF8849CBD979100E89D69C30356E0";
    $contractInfo = (new Contract)->GetContract($config,$contractId);
    var_dump($contractInfo);
?>