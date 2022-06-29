<?php
    require "../vendor/autoload.php";

    use Proximax\Sdk\Mosaic;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaicHexId = (new Utils)->bigIntToHexString(array(3020295898,2840468446));
    $mosaicInfo = (new Mosaic)->GetMosaicsInfo($config,array($mosaicHexId));
    var_dump($mosaicInfo);

?>