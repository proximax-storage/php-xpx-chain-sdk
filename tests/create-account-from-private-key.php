<?php
    require "vendor/autoload.php";
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $networkType = "PublicTest";

    $keypair = new \NEM\Core\KeyPair($privateKey);
    
    var_dump($keypair->getPublicKey("hex"));
    var_dump($keypair->getPrivateKey("hex"));
    var_dump($keypair->getAddress($networkType));
?>