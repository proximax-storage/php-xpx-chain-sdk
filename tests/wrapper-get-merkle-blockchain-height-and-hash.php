<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Blockchain;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $height = 3999;
    $hash = "52F7221E2269E71CB7C26E5A6A062B74D04B8900E3A4A683ED5B2E6691C4EC40";
    $merkle = (new Blockchain)->GetMerkleReceiptByHeightAndHash($config, $height, $hash);
    var_dump($merkle);

?>