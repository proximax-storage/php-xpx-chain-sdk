<?php
    require "vendor/autoload.php";

    use NEM\Model\Transaction\RegisterNamespaceTransaction;
    use NEM\Model\Deadline;
    use NEM\Model\Account;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $namespaceName = "namechild";
    $parentName = "mynamespace";
    $transfer = (new RegisterNamespaceTransaction)->NewRegisterSubNamespaceTransaction(
        new Deadline(1),
        $namespaceName,
        $parentName,
        $networkType
    );
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);

?>