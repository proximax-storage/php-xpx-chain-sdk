<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\AccountLinkTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\LinkActionEnum;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.1.41:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $publicKeyRemoveAccount = "F5FB54E9A2AC5B616C92D5FCC52A98A5FA03B4E0ECE0C51B2ABB7FA25D75B9DA";

    $accountOriginal = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    $accountRemove = (new Account)->newAccountFromPublicKey($publicKeyRemoveAccount,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $accountLink = new AccountLinkTransaction(
        new Deadline(1),
        $accountRemove,
        LinkActionEnum::LINK,
        $networkType
    );
    
    $signed = $accountOriginal->sign($accountLink,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    
    
?>