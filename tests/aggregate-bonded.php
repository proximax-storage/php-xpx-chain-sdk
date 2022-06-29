<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Deadline;
    use Proximax\Model\Message;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\Transaction\TransferTransaction;
    use Proximax\Model\Transaction\AggregateTransaction;
    use Proximax\Model\Transaction\LockFundsTransaction;
    use Proximax\Model\Transaction\CosignatureTransaction;
    use Proximax\Utils\Utils;
    use Proximax\Model\NetworkCurrencyMosaic;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    // Cosignature public keys
	$firstAccountPrivateKey  = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $secondAccountPrivateKey = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
    
    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $firstAccount = (new Account)->newAccountFromPrivateKey($firstAccountPrivateKey,$networkType);
    $secondAccount = (new Account)->newAccountFromPrivateKey($secondAccountPrivateKey,$networkType);


    $firstTransaction = new TransferTransaction(
        new Deadline(1),
        $secondAccount->getPublicAccount()->getAddress(),
        array(new NetworkCurrencyMosaic(10)),
        new Message("send mosaic"),
        $networkType
    );

    $secondTransaction = new TransferTransaction(
        new Deadline(1),
        $firstAccount->getPublicAccount()->getAddress(),
        array(new NetworkCurrencyMosaic(0)),
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
    $signedAggregateBoundedTransaction = $firstAccount->sign($aggregateBoundedTransaction,$generationHash);

    $lockFundsTrx = new LockFundsTransaction(
        new Deadline(1),
        new NetworkCurrencyMosaic(10000000), //deposit mosaic
        (new Utils)->fromBigInt(1000),
        $signedAggregateBoundedTransaction,
        $networkType
    );

    $signedTransaction = $firstAccount->sign($lockFundsTrx,$generationHash);

    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedTransaction);
    var_dump($signedTransaction);
    sleep(30);// 30 seconds

    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedTransaction($config, $signedAggregateBoundedTransaction);
    var_dump($signedAggregateBoundedTransaction);
    sleep(30);// 30 seconds

    $signatureSecondAccountTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureSecondAccountTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureSecondAccountTransaction = $secondAccount->signCosignatureTransaction($signatureSecondAccountTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureSecondAccountTransaction);
    sleep(30);// 30 seconds

?>