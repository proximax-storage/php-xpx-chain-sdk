<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Transaction\AccountLinkTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\LinkActionEnum;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $publicKeyRemoveAccount = "F5FB54E9A2AC5B616C92D5FCC52A98A5FA03B4E0ECE0C51B2ABB7FA25D75B9DA";

    $accountOriginal = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    $accountRemove = (new Account)->newAccountFromPublicKey($publicKeyRemoveAccount,$networkType);

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

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