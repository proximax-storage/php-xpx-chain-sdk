<?php
    require "vendor/autoload.php";

    use NEM\Model\Deadline;
    use NEM\Model\Mosaic;
    use NEM\Model\Account;
    use NEM\Model\PublicAccount;
    use NEM\Sdk\Transaction;
    use NEM\Model\Config;
    use NEM\Infrastructure\Network;
    use NEM\Model\MultisigCosignatoryModification;
    use NEM\Model\MultisigCosignatoryModificationType;
    use NEM\Model\Transaction\ModifyMultisigAccountTransaction;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://bctestnet1.xpxsirius.io:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("PublicTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $multisigPrivateKey = "5D3A701DFFD2C70051162D56C6981DC0402B827B93213BC3CD853D7D11835D4D";
	// Cosignature public keys
	$cosignatoryOnePublicKey   = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";
	$cosignatoryTwoPublicKey   = "803BD90020E0BB5F0B03AC75C86056A4D4AB5940F2A3A520694D8E7FF217E961";
	$cosignatoryThreePublicKey = "952C2E8302D2C657BC96A6FC8D72018A55F8B521A3AFC7903C88023D92CEF205";
	// Minimal approval count
	$minimalApproval = 3;
	// Minimal removal count
    $minimalRemoval = 2;


    $multisigAccount = (new Account)->newAccountFromPrivateKey($multisigPrivateKey,$networkType);
    $cosignerOneAccount = (new Account)->newAccountFromPublicKey($cosignatoryOnePublicKey,$networkType);
    $cosignerTwoAccount = (new Account)->newAccountFromPublicKey($cosignatoryTwoPublicKey,$networkType);
    $cosignerThreeAccount = (new Account)->newAccountFromPublicKey($cosignatoryThreePublicKey,$networkType);

    //var_dump($cosignerOneAccount->getPublicAccount()->getPublicKey()->getHex());
    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $multisigCosignatoryModifications = array(
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::ADD,
            $cosignerOneAccount
        ),
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::ADD,
            $cosignerTwoAccount
        ),
        new MultisigCosignatoryModification(
            MultisigCosignatoryModificationType::ADD,
            $cosignerThreeAccount
        )
    );

    $multisigTransaction = new ModifyMultisigAccountTransaction(
        $deadline,
        $minimalApproval,
        $minimalRemoval,
        $multisigCosignatoryModifications,
        $networkType
    );

    $signedTransaction = $multisigAccount->sign($multisigTransaction);

    var_dump($signedTransaction);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedTransaction->payload);

?>