<?php
namespace NEM\Model;
use NEM\Utils\Utils;
class HeightDTO{
    private $height; //big int  

    private $heightValue; //int

    public function __construct($height){
        if (is_numeric($height)){
            $this->heightValue = $height;
            $utils = new Utils;
            $this->height = $utils->fromBigInt($height);
        }
        else if(is_array($height)){
            $this->height = $height;
            $this->heightValue = ($height[1] << 32) | $height[0];
        }
    }

    public function getHeight(){
        return $this->height;
    }

    public function getHeightValue(){
        return $this->heightValue;
    }
}
?>