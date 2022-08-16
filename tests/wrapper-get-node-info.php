<?php
    require "../vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Node;
    use Proximax\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $netType = Network::getIdfromName("publictest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }

    $node = new Node;
    $nodeInfo = $node->GetNodeInfo($config);
    var_dump($nodeInfo);
?>