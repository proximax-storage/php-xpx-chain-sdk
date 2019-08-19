<?php
    require "vendor/autoload.php";

    use Proximax\Model\Transaction\SecretProofTransaction;
    use Proximax\Model\Deadline;
    use Proximax\Model\Account;
    use Proximax\Sdk\Transaction;
    use Proximax\Model\Config;
    use Proximax\Infrastructure\Network;
    use Proximax\Model\MetadataModification;
    use Proximax\Model\MetadataModificationType;
    use Proximax\Model\MultisigCosignatoryModification;
    use Proximax\Model\MultisigCosignatoryModificationType;
    use Proximax\Utils\Utils;
    use Proximax\Model\HashType;
    use Proximax\Model\Mosaic;
    use Proximax\Core\Sha3Hasher;

    $config = new Config;
    $network = new Network;
  
    $baseUrl = "http://192.168.0.107:3000";
    $wsReconnectionTimeout = 5000;
    $networkType = Network::getIdfromName("MijinTest");
    if ($networkType){
        $config = $config->NewConfig($baseUrl,$networkType,$wsReconnectionTimeout);
    }

    $alicePrivateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $bobPublicKey = "803BD90020E0BB5F0B03AC75C86056A4D4AB5940F2A3A520694D8E7FF217E961";
    
    $aliceAccount = (new Account)->newAccountFromPrivateKey($alicePrivateKey,$networkType);
    $bobAccount = (new Account)->newAccountFromPublicKey($bobPublicKey,$networkType);

    $generationHash = "7B631D803F912B00DC0CBED3014BBD17A302BA50B99D233B9C2D9533B842ABDF";

    $proof = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $secret = Sha3Hasher::hash(256,"ThisIsProof");

    $secretProof = new SecretProofTransaction(
        new Deadline(1),
        HashType::SHA3_256,
        $secret,
        $proof,
        $bobAccount->getAddress(),
        $networkType
    );
    
    $signed = $aliceAccount->sign($secretProof,$generationHash);
    var_dump($signed);
    $transaction = new Transaction;
    //$transaction->AnnounceTransaction($config, $signed);
?>