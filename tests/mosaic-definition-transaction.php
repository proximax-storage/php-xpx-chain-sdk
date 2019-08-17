<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\MosaicDefinitionTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Utils\Utils;
    use Proximax\Model\Address;
    use Proximax\Model\MosaicId;
    use Proximax\Model\MosaicProperties;
    use Proximax\Model\MosaicNonce;

    $config = new Config;
    $network = new Network;

    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";
    
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);

    $mosaicProperties = new MosaicProperties(
        true,
        true,
        4,
        (new Utils)->fromBigInt(10000)
    );

    $nonce = MosaicNonce::createRandom();
    $transfer = new MosaicDefinitionTransaction(
        new Deadline(1),
        $nonce,
        $account->getPublicAccount()->getPublicKey(),
        $mosaicProperties,
        $networkType
    );
    
    $signed = $account->sign($transfer,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);

?>