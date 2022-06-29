<?php
    require "../vendor/autoload.php";
    use Proximax\Model\Account;
    $privateKey = "760B7E531925FAB015349C12093943E86FBFBE5CB831F14447ED190EC10F6B1B";
    $networkType = "publictest";
    
    $account = (new Account)->newAccountFromPrivateKey($privateKey,$networkType);
    var_dump($account->getKeyPair()->getPublicKey("hex"));
    var_dump($account->getKeyPair()->getPrivateKey("hex"));
    var_dump($account->getPublicAccount()->getAddress());
?>