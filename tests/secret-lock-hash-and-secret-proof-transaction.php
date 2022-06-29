<?php
    require "../vendor/autoload.php";

    use Proximax\Model\Transaction\SecretLockTransaction;
    use Proximax\Model\Transaction\SecretProofTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Utils\Utils;
    use Proximax\Model\HashAlgorithmEnum;
    use Proximax\Model\NetworkCurrencyMosaic;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "https://bctestnet3.brimstone.xpxsirius.io";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("publictest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $alicePrivateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $bobPrivateKey = "B55478C892A6476760C5E77E443FE411F2D62B0F42496FC12EDB37F3306F8D69";
    
    $aliceAccount = (new Account)->newAccountFromPrivateKey($alicePrivateKey,$networkType);
    $bobAccount = (new Account)->newAccountFromPrivateKey($bobPrivateKey,$networkType);

    $generationHash = "56D112C98F7A7E34D1AEDC4BD01BC06CA2276DD546A93E36690B785E82439CA9";

    $seed = random_bytes(20);
    $proof = bin2hex($seed);
    $secret = HashAlgorithmEnum::hash($seed,HashAlgorithmEnum::HASH_256);
    var_dump($proof);
    var_dump($secret);

    $secretLock = new SecretLockTransaction(
        new Deadline(1),
        new NetworkCurrencyMosaic(10),
        (new Utils)->fromBigInt(100),
        HashAlgorithmEnum::HASH_256,
        $secret,
        $bobAccount->getPublicAccount()->getAddress(),
        $networkType
    );
    
    $signedLock = $aliceAccount->sign($secretLock,$generationHash);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedLock);
    var_dump($signedLock);
    sleep(30);

    $secretProof = new SecretProofTransaction(
        new Deadline(1),
        HashAlgorithmEnum::HASH_256,
        $secret,
        $proof,
        $bobAccount->getPublicAccount()->getAddress(),
        $networkType
    );
    
    $signedProof = $bobAccount->sign($secretProof,$generationHash);
    $transaction = new Transaction;
    $transaction->AnnounceTransaction($config, $signedProof);
    var_dump($signedProof);
?>