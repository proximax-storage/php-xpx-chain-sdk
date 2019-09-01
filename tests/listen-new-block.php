<?php
    require "vendor/autoload.php";
    use Proximax\Infrastructure\Listener;

    function callBack($data){
        var_dump("Call Back");
        var_dump($data);
        return true;
    }

    $listener = (new Listener)->newBlock("192.168.1.41","3000","callBack");
?>