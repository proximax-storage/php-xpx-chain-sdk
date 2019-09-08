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

    $namespaceId = "a94e1bdeb4060eda";
    $namespaceName = (new Namespaces)->GetNamespacesNames($config,array($namespaceId));
    var_dump($namespaceName);
?>