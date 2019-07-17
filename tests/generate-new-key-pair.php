<?php
    require "vendor/autoload.php";

    $keypair = new NEM\Core\KeyPair();
    var_dump($keypair->getPublicKey("hex")); // will output: 
    var_dump($keypair->getPrivateKey("hex"));
?>