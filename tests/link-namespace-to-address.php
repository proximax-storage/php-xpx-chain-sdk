<?php
    require "../vendor/autoload.php";

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
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $namespace = "mynamespace";
    $publicKey = "990585bbb7c97bb61d90410b67552d82d30738994ba7cf2b1041d1e0a6e4169b";
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