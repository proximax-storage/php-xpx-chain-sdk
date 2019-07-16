<?php
namespace NEM\Model;
use NEM\Model\Address;

class PublicAccount{

    public $address;//Address

    public $publicKey;//string

    public function __construct($address, $publicKey = null){
        $this->address = $address;

        if($publicKey !== null){
            $this->publicKey = $publicKey;
        }
        else $this->publicKey = "";
    }
}
?>