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
    use Proximax\Model\Address;
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
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $address1 = "VC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z67RVRIN";
    $address2 = "VCTSYT3SPBID36GQDZRC3E4XOUQGIGF5CG6EQXRT";
    
    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);


    $firstTransaction = new TransferTransaction(
        new Deadline(1),
        new Address($address1, $networkType),
        array(new NetworkCurrencyMosaic(10)),
        new Message("send mosaic"),
        $networkType
    );

    $secondTransaction = new TransferTransaction(
        new Deadline(1),
        new Address($address2, $networkType),
        array(new NetworkCurrencyMosaic(10)),
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
    var_dump($signedAggregateBoundedTransaction);
?>