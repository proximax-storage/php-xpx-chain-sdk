<?php
    require "vendor/autoload.php";

    use Proximax\Sdk\Mosaic;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaicHexId = (new Utils)->bigIntToHexString(array(481110499,231112638));
    $mosaicInfo = (new Mosaic)->GetMosaicInfo($config,$mosaicHexId);
    var_dump($mosaicInfo);

?>