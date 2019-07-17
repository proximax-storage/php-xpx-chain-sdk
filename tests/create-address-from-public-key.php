<?php
    require "vendor/autoload.php";

    $networkType = "PublicTest"; 
    $publicKey = "990585BBB7C97BB61D90410B67552D82D30738994BA7CF2B1041D1E0A6E4169B";
    $address = \NEM\Model\Address::fromPublicKey($publicKey,$networkType);
    var_dump($address->address);
?>