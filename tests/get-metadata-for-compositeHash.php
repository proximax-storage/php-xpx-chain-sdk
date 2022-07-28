<?php
    require "../vendor/autoload.php";

    use Proximax\Sdk\Metadata;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $address = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";
    $metadataInfo = (new Metadata)->GetMetadataAccount($config,$address);
    var_dump($metadataInfo);

?>