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
    use NEM\Model\Transaction\LockFundsTransaction;
    use NEM\Model\Transaction\CosignatureTransaction;
    use NEM\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    // Cosignature public keys
	$firstAccountPrivateKey      = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $secondAccountPrivateKey      = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
    
    $firstAccount = (new Account)->newAccountFromPrivateKey($firstAccountPrivateKey,$networkType);
    $secondAccount = (new Account)->newAccountFromPrivateKey($secondAccountPrivateKey,$networkType);


    $firstTransaction = new TransferTransaction(
        new Deadline(1),
        $secondAccount->getPublicAccount()->getAddress(),
        array(new Mosaic("xpx",10)),
        new Message("send mosaic"),
        $networkType
    );

    $secondTransaction = new TransferTransaction(
        new Deadline(1),
        $firstAccount->getPublicAccount()->getAddress(),
        array(new Mosaic("xpx",20)),
        new Message("ok"),
        $networkType
    );

    $firstTransaction->ToAggregate($firstAccount->getPublicAccount());
    $secondTransaction->ToAggregate($secondAccount->getPublicAccount());

    $aggregateBoundedTransaction = new AggregateTransaction(
        new Deadline(1),
        array($firstTransaction, $secondTransaction),
        $networkType
    );
    $aggregateBoundedTransaction->createBonded();
    $signedAggregateBoundedTransaction = $firstAccount->sign($aggregateBoundedTransaction);

    $lockFundsTrx = new LockFundsTransaction(
        new Deadline(1),
        new Mosaic("xpx",10000000), //deposit mosaic
        (new Utils)->fromBigInt(1000),
        $signedAggregateBoundedTransaction,
        $networkType
    );

    $signedTransaction = $firstAccount->sign($lockFundsTrx);

    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedTransaction);
    sleep(30);// 30 seconds


    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedTransaction($config, $signedAggregateBoundedTransaction);
    
    sleep(30);// 30 seconds

    $signatureSecondAccountTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureSecondAccountTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureSecondAccountTransaction = $secondAccount->signCosignatureTransaction($signatureSecondAccountTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureSecondAccountTransaction);
    sleep(30);// 30 seconds

?>