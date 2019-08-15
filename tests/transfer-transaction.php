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
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $address = new Address("SCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CGQVZYMV", $networkType);
    $mosaic = new Mosaic("xpx",0);
    $message = new Message("Hello world");

    $generationHash = "3D9507C8038633C0EB2658704A5E7BC983E4327A99AC14D032D67F5AACBCCF6A";

    $transfer = new TransferTransaction($deadline,$address,array($mosaic),$message,$networkType);

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer,$generationHash);

    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    var_dump($signed);
    
?>