<?php
    require "../vendor/autoload.php";

    use Proximax\Sdk\Metadata;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MosaicId;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $mosaic = new MosaicId(array(3020295898));
    $metadataInfo = (new Metadata)->GetMetadataMosaic($config,$mosaic->getIdValue());
    var_dump($metadataInfo);

?>