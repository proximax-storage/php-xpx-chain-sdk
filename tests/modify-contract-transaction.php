<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\ModifyContractTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MetadataModification;
    use Proximax\Model\MetadataModificationType;
    use Proximax\Model\MultisigCosignatoryModification;
    use Proximax\Model\MultisigCosignatoryModificationType;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $customerPrivateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $contractPrivateKey = "3401374277C42290570A8B88B86BCFCC190DF7808B4F14079F798B0F7D66B9E3";
    $replicatorPrivateKey = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
    $verificatorPrivateKey = "D0512165DCF74137B0D6876FC0F6F0E5BAC9F82882A56ADEBA52DBD73C13A025";
    
    $customer = (new Account)->newAccountFromPrivateKey($customerPrivateKey,$networkType);
    $contract = (new Account)->newAccountFromPrivateKey($contractPrivateKey,$networkType);
    $replicator = (new Account)->newAccountFromPrivateKey($replicatorPrivateKey,$networkType);
    $verificator = (new Account)->newAccountFromPrivateKey($verificatorPrivateKey,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $fileHash = "cf893ffcc47c33e7f68ab1db56365c156b0736824a0c1e273f9e00b8df8f01eb";

    $modifyContract = new ModifyContractTransaction(
        new Deadline(1),
        (new Utils)->fromBigInt(1000),
        $fileHash,
        array(
            new MultisigCosignatoryModification(
                MultisigCosignatoryModificationType::ADD,
                $customer->getPublicAccount()
            )
        ),
        array(
            new MultisigCosignatoryModification(
                MultisigCosignatoryModificationType::ADD,
                $replicator->getPublicAccount()
            )
        ),
        array(
            new MultisigCosignatoryModification(
                MultisigCosignatoryModificationType::ADD,
                $verificator->getPublicAccount()
            )
        ),
        $networkType
    );
    
    $signed = $contract->sign($modifyContract,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
?>