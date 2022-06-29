<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Deadline;
    use Proximax\Model\NetworkCurrencyMosaic;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MultisigCosignatoryModification;
    use Proximax\Model\MultisigModificationTypeEnum;
    use Proximax\Model\Transaction\ModifyMultisigAccountTransaction;
    use Proximax\Model\Transaction\AggregateTransaction;
    use Proximax\Model\Transaction\LockFundsTransaction;
    use Proximax\Model\Transaction\CosignatureTransaction;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $multisigPublicKey = "357966ED5562BAEBF4CBF9D4CB1C7EC30F910C9ADC1B72093C6FEBAF9A75A8C6";
	// Cosignature public keys
	$cosignatoryOnePrivateKey      = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
	$cosignatoryTwoPrivateKey      = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
	$cosignatoryToRemovePublicKey  = "952C2E8302D2C657BC96A6FC8D72018A55F8B521A3AFC7903C88023D92CEF205";
	// Minimal approval count
	$minimalApproval = -1;
	// Minimal removal count
    $minimalRemoval = -1;

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $multisigAccount = (new Account)->newAccountFromPublicKey($multisigPublicKey,$networkType);
    $cosignerOneAccount = (new Account)->newAccountFromPrivateKey($cosignatoryOnePrivateKey,$networkType);
    $cosignerTwoAccount = (new Account)->newAccountFromPrivateKey($cosignatoryTwoPrivateKey,$networkType);
    $cosignerRemoveAccount = (new Account)->newAccountFromPublicKey($cosignatoryToRemovePublicKey,$networkType);

    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $multisigCosignatoryModifications = array(
        new MultisigCosignatoryModification(
            MultisigModificationTypeEnum::REMOVE,
            $cosignerRemoveAccount
        )
    );

    $multisigTransaction = new ModifyMultisigAccountTransaction(
        new Deadline(1),
        $minimalApproval,
        $minimalRemoval,
        $multisigCosignatoryModifications,
        $networkType
    );

    $multisigTransaction->ToAggregate($multisigAccount);

    $aggregateBoundedTransaction = new AggregateTransaction(
        new Deadline(1),
        array($multisigTransaction),
        $networkType
    );
    $aggregateBoundedTransaction->createBonded();
    $signedAggregateBoundedTransaction = $cosignerOneAccount->sign($aggregateBoundedTransaction,$generationHash);

    $duration = (new Utils)->fromBigInt(100);
    $lockFundsTrx = new LockFundsTransaction(
        new Deadline(1),
        new NetworkCurrencyMosaic(10000000),
        $duration,
        $signedAggregateBoundedTransaction,
        $networkType
    );

    $signedTransaction = $cosignerOneAccount->sign($lockFundsTrx,$generationHash);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedTransaction);
    sleep(30);// 30 seconds


    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedTransaction($config, $signedAggregateBoundedTransaction);
    sleep(30);// 30 seconds


    $signatureTwoCosignatureTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureTwoCosignatureTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureTwoCosignatureTransaction = $cosignerTwoAccount->signCosignatureTransaction($signatureTwoCosignatureTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureTwoCosignatureTransaction);
    sleep(30);// 30 seconds

?>