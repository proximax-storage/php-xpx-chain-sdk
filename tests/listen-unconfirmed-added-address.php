<?php
    require "vendor/autoload.php";
    use Proximax\Infrastructure\Listener;

    function callBack($data){
        var_dump($data);
        return true;
    }

    $address = "SC6UUGZLEIAGRXCJXMEUEH2QE7VVMYC3Z55I3QJW"; 
    $listener = (new Listener)->unconfirmedAdded("192.168.1.41","3000",$address,"callBack");
?>