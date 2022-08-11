<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Exchange;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.brimstone.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaicId = "EFF9BC7472263D03EF6362B1F200FD3061BCD1BABE78F82119FB88811227CE85";
    $offerType = 'BUY';
    $offersInfo = (new Exchange)->GetExchangeOffers($config, $offerType,$mosaicId);
    var_dump($offersInfo);
?>