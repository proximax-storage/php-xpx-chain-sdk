<?php
    require "vendor/autoload.php";

    $networkType = "MijinTest"; 
    $publicKey = "952C2E8302D2C657BC96A6FC8D72018A55F8B521A3AFC7903C88023D92CEF205";
    $address = \NEM\Model\Address::fromPublicKey($publicKey,$networkType);
    var_dump($address->address);
?>