<?php
namespace NEM\Model;
use NEM\Utils\Utils;

class MaxFee{
    public $maxFee; //array

    public function __construct($maxFee){
        if (is_array($maxFee)){
            $this->maxFee = $maxFee;
        }
        else if (is_numeric($maxFee)){
            $utils = new Utils;
            $this->fee_array = $utils->fromBigInt($maxFee);
        }
        else return "Wrong fee format";
    }

    public function getFeeValue(){
        return (($maxFee[1] << 32) | ($maxFee[0]));
    }


}
?>