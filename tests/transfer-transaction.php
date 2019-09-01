<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\TransferTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Address;
    use Proximax\Model\Message;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\NetworkCurrencyMosaic;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $privateKey = "14F8423888AE5F719B06FF5B5B242DDD31CE8003639FC69A2D3EFB82E32A2FBF";
    $deadline = new Deadline(1); //1 is time include blockchain, unit hour
    $address = new Address("SC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z55I3QJW", $networkType);
    $mosaic = new NetworkCurrencyMosaic(9000000000000);
    $message = new Message("Hello world");

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $transfer = new TransferTransaction($deadline,$address,array($mosaic),$message,$networkType);

    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    
    $signed = $account->sign($transfer,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signed);
    
    
?>