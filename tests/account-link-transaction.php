<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\AccountLinkTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\AccountLinkAction;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $publicKeyRemoveAccount = "803BD90020E0BB5F0B03AC75C86056A4D4AB5940F2A3A520694D8E7FF217E961";

    $accountOriginal = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    $accountRemove = (new Account)->newAccountFromPublicKey($publicKeyRemoveAccount,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $accountLink = new AccountLinkTransaction(
        new Deadline(1),
        $accountRemove,
        AccountLinkAction::LINK,
        $networkType
    );
    
    $signed = $accountOriginal->sign($accountLink,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    
    
?>