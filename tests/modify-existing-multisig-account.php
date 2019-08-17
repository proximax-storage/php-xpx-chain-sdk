<?php
    require "vendor/autoload.php";

    use Proximax\Model\Deadline;
    use Proximax\Model\Mosaic;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MultisigCosignatoryModification;
    use Proximax\Model\MultisigCosignatoryModificationType;
    use Proximax\Model\Transaction\ModifyMultisigAccountTransaction;
    use Proximax\Model\Transaction\AggregateTransaction;
    use Proximax\Model\Transaction\LockFundsTransaction;
    use Proximax\Model\Transaction\CosignatureTransaction;
    use Proximax\Utils\Utils;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.105:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
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

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $multisigAccount = (new Account)->newAccountFromPublicKey($multisigPublicKey,$networkType);
    $cosignerOneAccount = (new Account)->newAccountFromPrivateKey($cosignatoryOnePrivateKey,$networkType);
    $cosignerTwoAccount = (new Account)->newAccountFromPrivateKey($cosignatoryTwoPrivateKey,$networkType);
    $cosignerRemoveAccount = (new Account)->newAccountFromPublicKey($cosignatoryToRemovePublicKey,$networkType);

    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $multisigCosignatoryModifications = array(
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::REMOVE,
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
    var_dump("-------------Lockfund---------------");
    var_dump($signedTransaction);
    var_dump("-------------End Lockfund---------------");

    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedTransaction($config, $signedAggregateBoundedTransaction);
    sleep(30);// 30 seconds
    var_dump("-------------Aggregate---------------");
    var_dump($signedAggregateBoundedTransaction);
    var_dump("-------------End Aggregate---------------");

    $signatureTwoCosignatureTransaction = new CosignatureTransaction($aggregateBoundedTransaction);
    $signatureTwoCosignatureTransaction->setHash($signedAggregateBoundedTransaction->getHash());
    $signedSignatureTwoCosignatureTransaction = $cosignerTwoAccount->signCosignatureTransaction($signatureTwoCosignatureTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceAggregateBondedCosignatureTransaction($config, $signedSignatureTwoCosignatureTransaction);
    sleep(30);// 30 seconds

?>