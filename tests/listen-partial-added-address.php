<?php
    require "../vendor/autoload.php";
    use Proximax\Infrastructure\Listener;

    function callBack($data){
        var_dump("Call Back");
        var_dump($data);
        return true;
    }

    $address = "SC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z55I3QJW"; 
    $listener = (new Listener)->aggregateBondedAdded("https://bctestnet3.brimstone.xpxsirius.io","3000",$address,"callBack");
?>