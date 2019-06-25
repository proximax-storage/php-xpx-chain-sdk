<?php
namespace NEM\Model;

use NEM\Crypto as Crypto;


Class Address{

    public $address = "";
    public $networkType = "";

    public function NewAddressFromPublicKey($pKey, $networkType){
        $ad = $this->generateEncodedAddress($pKey, $networkType);
        return $this->NewAddress($ad, $networkType);
    } 

    public function NewAddress($ad,$networkType){
        $this->address = $ad;
        $this->networkType = $networkType;
    }

    // generateEncodedAddress convert publicKey to address
    private function generateEncodedAddress($pKey, $version){
        $sha3 = new Crypto\Sha3Hasher();
        $base32 = new Crypto\Base32();
        $ripemd160 = new Crypto\Ripemd160Hasher();

        // step 1: sha3 hash of the public key
        $pKeyD = $this->DecodeString($pKey);
        $sha3PublicKeyHash = $sha3->hash("sha3-256",implode(array_map("chr", $pKeyD)));

        // step 2: ripemd160 hash of (1)
        $sha3PublicKeyHashD = $this->DecodeString($sha3PublicKeyHash);
        $ripemd160StepOneHash= $ripemd160->hash(implode(array_map("chr", $sha3PublicKeyHashD)));

        // step 3: add version byte in front of (2)
        $ver_arr = array($version);
        $ripemd160StepOneHashD = $this->DecodeString($ripemd160StepOneHash);
        $versionPrefixedRipemd160Hash = array_merge($ver_arr,$ripemd160StepOneHashD);

        // step 4: get the checksum of (3)
        $stepThreeChecksum = $this->GenerateChecksum($versionPrefixedRipemd160Hash);

        // step 5: concatenate (3) and (4)       
        $concatStepThreeAndStepSix = array_merge($versionPrefixedRipemd160Hash,$stepThreeChecksum);

        // step 6: base32 encode (5)
        $concatStepThreeAndStepSixD = implode(array_map("chr", $concatStepThreeAndStepSix));

        return $base32->encode($concatStepThreeAndStepSixD);
    }

    /**
     * @param string $str
     * @return byte array 
     **/
    private function DecodeString(string $str){
        $byte_arr = unpack('C*', $str);
        return $this->Decode($byte_arr);
    }
    private function Decode ($src){
        for ($i = 1; $i < count($src)/2 + 1; $i++) {
            $a = $this->fromHexChar($src[$i*2-1]);
            if ($a == -1) {
                return "Error: Invalid Byte Error 1";
            }
            $b = $this->fromHexChar($src[$i*2]);
            if ($b == -1) {
                return "Error: Invalid Byte Error 2";
            }
            $src[$i] = ($a << 4) | $b;
        }
        if (count($src)%2 == 1) {
            // Check for invalid char before reporting bad length,
            // since the invalid char (if present) is an earlier problem.
            return "Error: Error Lenght";
        }
        return array_slice($src,0,$i-1);
    }

    private function fromHexChar($c){
        if ($c >= ord('0') && $c <= ord('9')){
            return $c - ord('0');
        }
        else if ($c >= ord('a') && $c <= ord('f')){
            return $c - ord('a') + 10;
        }
        else if ($c >= ord('A') && $c <= ord('F')){
            return $c - ord('A') + 10;
            
        }
        return -1;
    }
    /**
     * @param byte array $arr
     * @return byte array 
     **/
    private function GenerateCheckSum($arr){
        $string = implode(array_map("chr", $arr));
        $new_str = hash("sha3-256",$string);

        $new_arr = $this->DecodeString($new_str);
        return array_slice($new_arr,0,4);
    }
}
?>