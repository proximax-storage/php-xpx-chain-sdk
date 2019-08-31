<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\ModifyAccountPropertyTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\AccountPropertyModification;
    use Proximax\Model\AccountPropertyTypeEnum;
    use Proximax\Model\AccountPropertiesModificationTypeEnum;
    use Proximax\Model\MosaicId;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $mosaicId = new MosaicId(array(2227523919,1484419338));
    $accountProperty = new ModifyAccountPropertyTransaction(
        new Deadline(1),
        AccountPropertyTypeEnum::ALLOW_MOSAIC,
        array(
            new AccountPropertyModification(
                AccountPropertiesModificationTypeEnum::ADD,
                $mosaicId
            )
        ),
        $networkType
    );
    $accountProperty->createForMosaic();
    
    $signed = $account->sign($accountProperty,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
?>