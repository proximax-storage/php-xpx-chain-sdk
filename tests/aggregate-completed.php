<?php
    require "vendor/autoload.php";

    use NEM\Model\Deadline;
    use NEM\Model\Mosaic;
    use NEM\Model\Message;
    use NEM\Model\Account;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Model\Transaction\TransferTransaction;
    use NEM\Model\Transaction\AggregateTransaction;
    use NEM\Model\Address;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.105:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    // Cosignature public keys
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $address1 = "SCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CGQVZYMV";
    $address2 = "SCWQJM7WGLMPT57OV52DEE2QT6PJ5SCVXLCDO6O6";
    
    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);


    $firstTransaction = new TransferTransaction(
        new Deadline(1),
        new Address($address1, $networkType),
        array(new Mosaic("xpx",10)),
        new Message("send mosaic"),
        $networkType
    );

    $secondTransaction = new TransferTransaction(
        new Deadline(1),
        new Address($address2, $networkType),
        array(new Mosaic("xpx",10)),
        new Message("send mosaic 2"),
        $networkType
    );

    $firstTransaction->ToAggregate($account->getPublicAccount());
    $secondTransaction->ToAggregate($account->getPublicAccount());

    $aggregateBoundedTransaction = new AggregateTransaction(
        new Deadline(1),
        array($firstTransaction, $secondTransaction),
        $networkType
    );
    $aggregateBoundedTransaction->createCompleted();
    $signedAggregateBoundedTransaction = $account->sign($aggregateBoundedTransaction,$generationHash);

    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedAggregateBoundedTransaction);

?>