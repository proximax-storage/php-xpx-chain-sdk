<?php

namespace NEM\Model;

//define network type
define("Mijin",96);
define("MijinTest",144);
define("Public",184);
define("PublicTest",168);
define("Private",200);
define("PrivateTest",176);
define("NotSupportedNet",0);
define("AliasAddress",145);

Class NetworkType{
    public $networkType;

    public function setNetworkType(string $networkType){
        $this->networkType = $networkType;
    }
    public function getNetworkType(){
        return constant($this->networkType);
    }
    public function NetworkTypeFromString(string $networkType){
        switch ($networkType) {
            case "mijin":
                $this->networkType = "Mijin";
                break;
            case "mijinTest":
                $this->networkType = "MijinTest";
                break;
            case "public":
                $this->networkType = "Public";
                break;
            case "publicTest":
                $this->networkType = "PublicTest";
                break;
            case "private":
                $this->networkType = "Private";
                break;
            case "privateTest":
                $this->networkType = "PrivateTest";
                break;
            default: 
                $this->networkType = "NotSupportedNet";
        }
        return $this->networkType;   
    }
    
    
    // public function ExtractNetworkType($version){
    //     $b = make([]byte, 8)
    //     binary.LittleEndian.PutUint64(b, version)
    
    //     return NetworkType(b[1])
    // }
}
?>
