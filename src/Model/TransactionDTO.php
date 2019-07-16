<?php
namespace NEM\Model;

class TransactionDTO{
    public $AbstractTransaction; //object

    public $Mosaics; //array Mosaic

    public $Recipient; //Address

    public $Message; //Message

    public function __construct($arrayData){
        $this->AbstractTransaction = $arrayData["AbstractTransaction"];
        $this->Mosaics = $arrayData["Mosaics"];
        $this->Recipient = $arrayData["Recipient"];
        $this->Message = $arrayData["Message"];
    }
}
?>