<?php
namespace NEM\Model;
use NEM\Utils\Utils;

class HeightDTO{
    private $height; //big int  

    public function __construct($height){
        if (is_numeric($height)){
            $utils = new Utils;
            $this->height = $utils->fromBigInt($height);
        }
        else if(is_array($height)){
            $this->height = $height;
        }
    }

    public function getHeight(){
        return $this->height;
    }

    public function getHeightValue(){
        return ($this->height[1] << 32) | $this->height[0];
    }
}
?>