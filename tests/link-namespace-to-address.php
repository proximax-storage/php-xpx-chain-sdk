<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\AliasTransaction;
    use Proximax\Model\AliasActionEnum;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Utils\Utils;
    use Proximax\Model\Address;

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
    $publicKey = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";
    $address = Address::fromPublicKey($publicKey,$networkType);

    $transfer = (new AliasTransaction)->NewAddressAliasTransaction(
        new Deadline(1),
        AliasActionEnum::LINK,
        $namespace,
        $address,
        $networkType
    );
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);

?>