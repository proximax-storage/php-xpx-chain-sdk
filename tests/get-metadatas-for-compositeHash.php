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

    $compositeHash = ["57D649B3FDC7CEE27A621F710492BB01DD8BA812B93B03B6B80044AABC313DB4"];
    $metadataInfo = (new Metadata)->GetMetadatas($config,$compositeHash);
    var_dump($metadataInfo);

?>