<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Transaction\ModifyAccountPropertyTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\AccountPropertyModification;
    use Proximax\Model\AccountPropertyTypeEnum;
    use Proximax\Model\AccountPropertiesModificationTypeEnum;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $publicKeyBlock = "990585bbb7c97bb61d90410b67552d82d30738994ba7cf2b1041d1e0a6e4169b";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    $accountBlock = (new Account)->newAccountFromPublicKey($publicKeyBlock,$networkType);

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $accountProperty = new ModifyAccountPropertyTransaction(
        new Deadline(1),
        AccountPropertyTypeEnum::BLOCK_ADDRESS,
        array(
            new AccountPropertyModification(
                AccountPropertiesModificationTypeEnum::REMOVE,
                $accountBlock->getAddress()
            )
        ),
        $networkType
    );
    $accountProperty->createForAddress();
    
    $signed = $account->sign($accountProperty,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    
    
?>