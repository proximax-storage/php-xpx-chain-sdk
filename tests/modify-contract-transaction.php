<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Transaction\ModifyContractTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MetadataModification;
    use Proximax\Model\MetadataModificationType;
    use Proximax\Model\MultisigCosignatoryModification;
    use Proximax\Model\MultisigModificationTypeEnum;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $customerPrivateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $contractPrivateKey = "5D3A701DFFD2C70051162D56C6981DC0402B827B93213BC3CD853D7D11835D4D";
    $replicatorPrivateKey = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
    $verificatorPrivateKey = "D0512165DCF74137B0D6876FC0F6F0E5BAC9F82882A56ADEBA52DBD73C13A025";
    
    $customer = (new Account)->newAccountFromPrivateKey($customerPrivateKey,$networkType);
    $contract = (new Account)->newAccountFromPrivateKey($contractPrivateKey,$networkType);
    $replicator = (new Account)->newAccountFromPrivateKey($replicatorPrivateKey,$networkType);
    $verificator = (new Account)->newAccountFromPrivateKey($verificatorPrivateKey,$networkType);

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $fileHash = "cf893ffcc47c33e7f68ab1db56365c156b0736824a0c1e273f9e00b8df8f01eb";

    $modifyContract = new ModifyContractTransaction(
        new Deadline(1),
        (new Utils)->fromBigInt(1000),
        $fileHash,
        array(
            new MultisigCosignatoryModification(
                MultisigModificationTypeEnum::ADD,
                $customer->getPublicAccount()
            )
        ),
        array(
            new MultisigCosignatoryModification(
                MultisigModificationTypeEnum::ADD,
                $replicator->getPublicAccount()
            )
        ),
        array(
            new MultisigCosignatoryModification(
                MultisigModificationTypeEnum::ADD,
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