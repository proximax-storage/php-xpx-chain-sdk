<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Service;
    use Proximax\Model\RolesTypeEnum;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $accountId = "CFC31B3080B36BC3D59DF4AB936AC72F4DC15CE3C3E1B1EC5EA41415A4C33FEE";
    $exchangeInfo = (new Service)->GetDriveByRole($config,$accountId, RolesTypeEnum::Owner);
    var_dump($exchangeInfo);
?>