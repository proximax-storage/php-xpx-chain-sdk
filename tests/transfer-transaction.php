<?php
    require "vendor/autoload.php";

    use NEM\Model\Transaction\TransferTransaction;
    use NEM\Model\Deadline;
    use NEM\Model\Address;
    use NEM\Model\Message;
    use NEM\Model\Mosaic;
    use NEM\Core\KeyPair;
    use NEM\Model\Account;
    use NEM\Model\PublicAccount;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "D0512165DCF74137B0D6876FC0F6F0E5BAC9F82882A56ADEBA52DBD73C13A025";
    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $address = new Address("VCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CG6EQXRT", $networkType);
    $mosaic = new Mosaic("xpx",10);
    $message = new Message("Hello world");

    $transfer = new TransferTransaction($deadline,$address,array($mosaic),$message,$networkType);

    $keyPair = new KeyPair($privateKey);
    $publicAccount = new PublicAccount($keyPair->getAddress($networkType),$keyPair->getPublicKey());
    $account = new Account($keyPair,$publicAccount);
    $signed = $account->sign($transfer);
    
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed->payload);

?>