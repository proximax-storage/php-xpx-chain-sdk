<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Sdk\Config as Sdk;
    use Proximax\Model\Transaction\BlockchainConfigTransaction;
    use Proximax\Model\Account;
    use Proximax\Model\Deadline;
    use Proximax\Sdk\Transaction;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    $height = 297;

    $configInfo = (new Sdk)->GetConfigByHeight($config,$height);
    
    $privateKey = "C06B2CC5D7B66900B2493CF68BE10B7AA8690D973B7F0B65D0DAE4F7AA464716";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";
    
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