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
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    // Cosignature public keys
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $address1 = "VCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CG6EQXRT";
    $address2 = "VCWQJM7WGLMPT57OV52DEE2QT6PJ5SCVXKXWNH2Q";
    
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
        array(new Mosaic("xpx",20)),
        new Message("ok"),
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
    $signedAggregateBoundedTransaction = $account->sign($aggregateBoundedTransaction);

    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedAggregateBoundedTransaction);

?>