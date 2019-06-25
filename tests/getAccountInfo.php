<?php
    
    use NEM\Model as Model;

    $networkType = new Model\NetworkType();
    $Address = new Model\Address();

    //Config network blockchain
    $baseURL = "http://bctestnet1.xpxsirius.io:3000";
    $networkType->setNetworkType("PublicTest");
    $publicKey = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";

    //Get Wallet Address from public key
    $netType = $networkType->getNetworkType();
    $Address->NewAddressFromPublicKey($publicKey,$netType);
    var_dump($Address);
?>