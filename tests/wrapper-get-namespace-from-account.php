<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Namespaces;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $accountId = "VC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z67RVRIN";
    $namespaceInfo = (new Namespaces)->GetNamespaceFromAccount($config,$accountId, null, null);
    var_dump($namespaceInfo);
?>