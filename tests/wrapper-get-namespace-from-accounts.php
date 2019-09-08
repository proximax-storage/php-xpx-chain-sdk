<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Namespaces;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $accountId1 = "SC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z55I3QJW";
    $accountId2 = "SCWQJM7WGLMPT57OV52DEE2QT6PJ5SCVXLCDO6O6";
    $namespaceInfo = (new Namespaces)->GetNamespaceFromAccounts($config,array($accountId1,$accountId2),null, null);
    var_dump($namespaceInfo);
?>