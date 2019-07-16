<?php
namespace NEM\Model;

class MaxFee{
    private $fee_array;

    private $fee_int;

    public function __construct($maxFee){
        if (is_array($maxFee)){
            $this->fee_array = $maxFee;
            $this->fee_int = (($maxFee[1] << 32) | ($maxFee[0]));
        }
        else if (is_numeric($maxFee)){
            $this->fee_int = $maxFee;
            $this->fee_array = (new \NEM\Utils\Utils)->fromBigInt($maxFee);
        }
        else return "Wrong fee format";
    }

    public function getFeeValue(){
        return $this->fee_int;
    }

    public function getFeeArray(){
        return $this->fee_array;
    }

}
?>