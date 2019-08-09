<?php
    require "vendor/autoload.php";

    use NEM\Model\Transaction\AliasTransaction;
    use NEM\Model\AliasActionType;
    use NEM\Model\Deadline;
    use NEM\Model\Account;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Utils\Utils;
    use NEM\Model\Address;
    use NEM\Model\MosaicId;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $namespace = "mynamespace";
    $mosaicId  = new MosaicId("104ee0b329c5f452");

    $transfer = (new AliasTransaction)->NewMosaicAliasTransaction(
        new Deadline(1),
        AliasActionType::LINK,
        $namespace,
        $mosaicId,
        $networkType
    );
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);

?>