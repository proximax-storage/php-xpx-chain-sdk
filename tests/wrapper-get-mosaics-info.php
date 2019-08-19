<?php
    require "vendor/autoload.php";

    use Proximax\Sdk\Mosaic;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Infrastructure\Mosaic as MosaicDefine;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://13.229.183.224:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaicHexId = MosaicDefine::getHexfromName("xpx");
    $mosaicInfo = (new Mosaic)->GetMosaicsInfo($config,array($mosaicHexId));
    var_dump($mosaicInfo);

?>