<?php
    require "vendor/autoload.php";

    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\Transaction\BlockchainUpgradeTransaction;
    use Proximax\Model\Account;
    use Proximax\Model\Deadline;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\BlockchainVersion;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.1.23:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    
    $privateKey = "C06B2CC5D7B66900B2493CF68BE10B7AA8690D973B7F0B65D0DAE4F7AA464716";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";
    
    $blockchainVersion = new BlockchainVersion(1,2,3,4);

    $upgradeTransaction = new BlockchainUpgradeTransaction(
        new Deadline(1),
        (new Utils)->fromBigInt(1000),
        $blockchainVersion,
        $networkType
    );
    
    $signed = $account->sign($upgradeTransaction,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);

?>