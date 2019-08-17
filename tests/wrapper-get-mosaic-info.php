<?php
    require "vendor/autoload.php";

    use Proximax\Sdk\Mosaic;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Infrastructure\Mosaic as MosaicDefine;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaicHexId = MosaicDefine::getHexfromName("xpx");
    $mosaicInfo = (new Mosaic)->GetMosaicInfo($config,$mosaicHexId);
    var_dump($mosaicInfo);

?>