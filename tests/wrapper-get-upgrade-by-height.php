<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Upgrade;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.1.23:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $height = 697;
    $upgradeInfo = (new Upgrade)->GetUpgradeByHeight($config,$height);
    var_dump($upgradeInfo);

?>