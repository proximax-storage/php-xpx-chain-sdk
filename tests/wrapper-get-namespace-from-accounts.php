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

    $accountId1 = "VC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z67RVRIN";
    $accountId2 = "VCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CG6EQXRT";
    $namespaceInfo = (new Namespaces)->GetNamespaceFromAccounts($config,array($accountId1,$accountId2),null, null);
    var_dump($namespaceInfo);
?>