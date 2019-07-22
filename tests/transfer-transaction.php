<?php
    require "vendor/autoload.php";

    use NEM\Model\Transaction\TransferTransaction;
    use NEM\Model\Deadline;
    use NEM\Model\Address;
    use NEM\Model\Message;
    use NEM\Model\Mosaic;
    use NEM\Model\Account;
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
    $address = new Address("VB7Z7YQFUNNLOUOJN3M5VDACBJTDANEQZVSZBU7B", $networkType);
    $mosaic = new Mosaic("xpx",10);
    $mosaic2 = new Mosaic("xpx",10);
    $message = new Message("Hello world");

    $transfer = new TransferTransaction($deadline,$address,array($mosaic,$mosaic2),$message,$networkType);

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer);

    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed->payload);

?>