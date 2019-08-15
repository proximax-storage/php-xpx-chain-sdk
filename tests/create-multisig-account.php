<?php
    require "vendor/autoload.php";

    use NEM\Model\Deadline;
    use NEM\Model\Account;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Model\MultisigCosignatoryModification;
    use NEM\Model\MultisigCosignatoryModificationType;
    use NEM\Model\Transaction\ModifyMultisigAccountTransaction;
    use NEM\Model\Transaction\AggregateTransaction;
    use NEM\Model\Transaction\LockFundsTransaction;
    use NEM\Model\Transaction\CosignatureTransaction;
    use NEM\Model\Mosaic;
    use NEM\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.105:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $multisigPrivateKey = "3401374277C42290570A8B88B86BCFCC190DF7808B4F14079F798B0F7D66B9E3";
	// Cosignature private keys
    $cosignatoryOnePrivateKey   = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
	$cosignatoryTwoPrivateKey   = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
	$cosignatoryThreePrivateKey = "D0512165DCF74137B0D6876FC0F6F0E5BAC9F82882A56ADEBA52DBD73C13A025";
	// Minimal approval count
	$minimalApproval = 3;
	// Minimal removal count
    $minimalRemoval = 2;

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $multisigAccount = (new Account)->newAccountFromPrivateKey($multisigPrivateKey,$networkType);
    $cosignerOneAccount = (new Account)->newAccountFromPrivateKey($cosignatoryOnePrivateKey,$networkType);
    $cosignerTwoAccount = (new Account)->newAccountFromPrivateKey($cosignatoryTwoPrivateKey,$networkType);
    $cosignerThreeAccount = (new Account)->newAccountFromPrivateKey($cosignatoryThreePrivateKey,$networkType);

    $multisigCosignatoryModifications = array(
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::ADD,
            $cosignerOneAccount->getPublicAccount()
        ),
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::ADD,
            $cosignerTwoAccount->getPublicAccount()
        ),
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::ADD,
            $cosignerThreeAccount->getPublicAccount()
        )
    );

    $multisigTransaction = new ModifyMultisigAccountTransaction(
        new Deadline(1), //1 is time include blockchain, unit hour
        $minimalApproval,
        $minimalRemoval,
        $multisigCosignatoryModifications,
        $networkType
    );

    $multisigTransaction->ToAggregate($multisigAccount->getPublicAccount());
    $aggregateBoundedTransaction = new AggregateTransaction(
        new Deadline(1),
        array($multisigTransaction),
        $networkType
    );
    $aggregateBoundedTransaction->createBonded();

    $signedAggregateBoundedTransaction = $multisigAccount->sign($aggregateBoundedTransaction,$generationHash);

    $mosaic = new Mosaic("xpx",10000000); //deposit mosaic
    $duration = (new Utils)->fromBigInt(100);
    $lockFundsTrx = new LockFundsTransaction(
        new Deadline(1),
        $mosaic,
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


    $signatureOneCosignatureTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureOneCosignatureTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureOneCosignatureTransaction = $cosignerOneAccount->signCosignatureTransaction($signatureOneCosignatureTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureOneCosignatureTransaction);
    sleep(30);// 30 seconds


    $signatureTwoCosignatureTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureTwoCosignatureTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureTwoCosignatureTransaction = $cosignerTwoAccount->signCosignatureTransaction($signatureTwoCosignatureTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureTwoCosignatureTransaction);
    sleep(30);// 30 seconds


    $signatureThreeCosignatureTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureThreeCosignatureTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureThreeCosignatureTransaction = $cosignerThreeAccount->signCosignatureTransaction($signatureThreeCosignatureTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureThreeCosignatureTransaction);
    sleep(30);// 30 seconds

?>