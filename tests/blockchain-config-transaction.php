<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Config as Sdk;
    use Proximax\Model\Transaction\BlockchainConfigTransaction;
    use Proximax\Model\Account;
    use Proximax\Model\Deadline;
    use Proximax\Sdk\Transaction;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $height = 297;

    $configInfo = (new Sdk)->GetConfigByHeight($config,$height);
    
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";
    
    $applyHeightDelta = $configInfo->getCatapultConfig()->getHeight()->getArray();
    $blockchainConfig = $configInfo->getCatapultConfig()->getBlockchainConfig();
    $supportedEntityVersions = $configInfo->getCatapultConfig()->getSupportedEntityVersions();

    $configTransaction = new BlockchainConfigTransaction(
        new Deadline(1),
        $applyHeightDelta,
        $blockchainConfig,
        $supportedEntityVersions,
        $networkType
    );
    
    $signed = $account->sign($configTransaction,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);

?>