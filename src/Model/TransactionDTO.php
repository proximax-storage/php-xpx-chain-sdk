<?php
namespace NEM\Model;

class TransactionDTO{
    private $AbstractTransaction; //object

    private $Mosaics; //array Mosaic

    private $Recipient; //Address

    private $Message; //Message

    public function __construct($arrayData){
        $this->AbstractTransaction = $arrayData["AbstractTransaction"];
        $this->Mosaics = $arrayData["Mosaics"];
        $this->Recipient = $arrayData["Recipient"];
        $this->Message = $arrayData["Message"];
    }

    public function getAbstractTransaction(){
        return $this->AbstractTransaction;
    }

    public function getMosaics(){
        return $this->Mosaics;
    }

    public function getRecipient(){
        return $this->Recipient;
    }

    public function getMessage(){
        return $this->Message;
    }
}
?>