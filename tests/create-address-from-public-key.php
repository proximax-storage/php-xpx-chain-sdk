<?php
    require "../vendor/autoload.php";

    $networkType = "publictest";
    $publicKey = "990585bbb7c97bb61d90410b67552d82d30738994ba7cf2b1041d1e0a6e4169b";
    $account = \Proximax\Model\Address::fromPublicKey($publicKey,$networkType);
    var_dump($account->address);
?>