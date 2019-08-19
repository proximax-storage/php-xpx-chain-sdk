<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\ModifyMetadataTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MetadataModification;
    use Proximax\Model\MetadataModificationType;
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

    $modifyMetadata = new ModifyMetadataTransaction(
        new Deadline(1),
        new MosaicId(array(2227523919,1484419338)),
        array(
            new MetadataModification(
                MetadataModificationType::ADD,
                "my_key_name",
                "my_data"
            )
        ),
        $networkType
    );
    $modifyMetadata->createForMosaic();
    
    $signed = $account->sign($modifyMetadata,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
?>