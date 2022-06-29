<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Transaction\TransferTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Address;
    use Proximax\Model\Message;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\NetworkCurrencyMosaic;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $address = new Address("VCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CG6EQXRT", $networkType);
    $mosaic = new NetworkCurrencyMosaic(9000000000000);
    $message = new Message("Hello world");

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $transfer = new TransferTransaction($deadline,$address,array($mosaic),$message,$networkType);

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    
    
?>