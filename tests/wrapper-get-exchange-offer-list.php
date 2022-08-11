<?php
    require "../vendor/autoload.php";

    use Proximax\Sdk\Exchange;
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

    $exchangeList = (new Exchange)->GetOfferList($config);
    var_dump($exchangeList);

?>