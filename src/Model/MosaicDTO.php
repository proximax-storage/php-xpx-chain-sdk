<?php

namespace NEM\Model;
use NEM\Utils\Utils;

class MosaicDTO{
    private $id; //big Int

    private $amount;//big Int

    public function __construct(array $id,array $amount){
        $this->id = $id;
        $this->amount = $amount;
    }

    public function getId(){
        return  $this->id;
    }
    
    public function getIdValue(){
        $utils = new Utils;
        return $utils->bigIntToHexString($this->id);
    }

    public function getAmount(){
        return  $this->amount;
    }

    public function getAmountValue(){
        return  ($this->amount[1] << 32) | $this->amount[0];
    }
}


