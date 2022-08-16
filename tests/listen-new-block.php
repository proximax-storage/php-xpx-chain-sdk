<?php
    require "../vendor/autoload.php";
    use Proximax\Infrastructure\Listener;

    function callBack($data){
        var_dump($data);
        return true;
    }

    $listener = (new Listener)->newBlock("https://bctestnet3.brimstone.xpxsirius.io","3000","callBack");
?>