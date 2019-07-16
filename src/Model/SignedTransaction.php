<?php
namespace NEM\Model;

class SignedTransaction{
    public $type;

    public $payload;

    public $hash;

    public function __construct($type, $payload, $hash){
        $this->type = $type;
        $this->payload = $payload;
        $this->hash = $hash;
    }
}
?>