<?php
    require "../vendor/autoload.php";

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
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }
    
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";
    
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