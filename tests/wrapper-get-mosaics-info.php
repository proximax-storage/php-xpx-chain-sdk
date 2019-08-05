<?php
    require "vendor/autoload.php";

    use NEM\Sdk\Mosaic;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Infrastructure\Mosaic as MosaicDefine;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaicHexId = MosaicDefine::getHexfromName("xpx");
    $mosaicInfo = (new Mosaic)->GetMosaicsInfo($config,array($mosaicHexId));
    var_dump($mosaicInfo);

?>