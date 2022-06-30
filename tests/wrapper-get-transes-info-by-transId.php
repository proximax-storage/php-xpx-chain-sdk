<?php
    require "../vendor/autoload.php";
    use Proximax\Model\Config;
    use Proximax\Sdk\Transaction;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\GroupTypeEnum;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $transId = array("5D4BDF9BD650BA000125B896","5D4BDAA1D650BA000125B7E4");
    $arr_hash = array("555C32CAECA8626A0DBB665CEB708F64C2BF7E8C8C4B6E5FB6FEA0C23EA13C94", "DB86BC55973059FFBFB4C55FD5D442984F45EFC2526C275A36B0946D529EDDE8");
    $netType = Network::getIdfromName("publictest");

    if ($netType){
        $config = $config->NewConfig($baseUrl,$netType,$wsReconnectionTimeout);
    }
    $Transaction = new Transaction;
    $transaction = $Transaction->GetTransactions($config,$transId, GroupTypeEnum::PARTIAL);
    var_dump($transaction);
?>