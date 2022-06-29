<?php
    require "../vendor/autoload.php";
    use Proximax\Infrastructure\Listener;

    function callBack($data){
        var_dump($data);
        return true;
    }

    $address = "VC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z67RVRIN";
    $listener = (new Listener)->cosignatureAdded("https://bctestnet3.brimstone.xpxsirius.io","3000",$address,"callBack");
?>