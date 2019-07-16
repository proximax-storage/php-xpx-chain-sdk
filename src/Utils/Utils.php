<?php
namespace NEM\Utils;

Class Utils{

    public $hex;

    public function __construct(){
        $this->hex = new Hex();
    }

    /**
     * ReverseByteArray rearranges the bytes in reverse order
     *
     * @param  byte array $a
     *
     * @return byte array $a
     */
    public function ReverseByteArray($a) {
        $lenA = count($a);
        $j = $lenA;

        for ($i=$lenA/2;$i<$lenA;$i++) {
            $j--;
            $temp = $a[$i];
            $a[$i] = $a[$j];
            $a[$j] = $temp;
        }
        return $a;
    }

    
    /**
     * MustHexDecodeString return hex representation of string
     *
     * @param  String $s
     *
     * @return byte array $b
     */
    public function MustHexDecodeString($s){
        $b = $this->hex->DecodeString($s);
        return $b;
    }

    /**
     * HexDecodeStringOdd return padding hex representation of string
     *
     * @param  String $s
     *
     * @return byte array $b
     */
    public function HexDecodeStringOdd($s){
        if (count($s)%2 != 0) {
            $s = "0" + $s;
        }
        return $this->hex->DecodeString($s);
    }

    /**
     * BigIntToByteArray converts a BigInteger to a little endian byte array.
     *
     * @param  BigInt $value
     *
     * @param  int $numBytes
     * 
     * @return byte array $outputBytes
     */
    public function BigIntToByteArray($value, $numBytes){
        // output must have length NumBytes!
        $outputBytes = array();
        $bigIntegerBytes = value.Bytes();
        $copyStartIndex = 0;

        if (count($bigIntegerBytes) == 0) {
            return $outputBytes;
        }
        if (0x00 == $bigIntegerBytes[0]) {
            $copyStartIndex = 1;
        }
        $numBytesToCopy = count($bigIntegerBytes) - $copyStartIndex;
        if ($numBytesToCopy > $numBytes) {
            $copyStartIndex += $numBytesToCopy - $numBytes;
            $numBytesToCopy = $numBytes;
        }

        //reverse & copy
        for ($i=0;$i<$numBytesToCopy;$i++) {
            $outputBytes[$i] = $bigIntegerBytes[$copyStartIndex+$numBytesToCopy-$i-1];
        }

        return $outputBytes;
    }

    /**
     * BytesToBigInteger converts a little endian byte array to a BigInteger.
     *
     * @param  byte array $bytes
     * 
     * @return bigInt
     */
    // public function BytesToBigInteger($bytes){

    //     $bigEndianBytes = array();
    //     //reverse & copy
    //     for ($i=0;$i<count($bytes);$i++) {
    //         $bigEndianBytes[$i+1] = $bytes[count($bytes)-$i-1];
    //     }
    //     return (&big.Int{}).SetBytes($bigEndianBytes);
    // }

    /**
     * EqualsBigInts return true is first & second equals
     *
     * @param  BigInt $first
     *
     * @param  BigInt $second
     * 
     * @return bool
     */
    // public function EqualsBigInts($first, $second ) {
    //     if ($first == null && $second == null) {
    //         return true;
    //     }

    //     if ($first != null) {
    //         return $first.Cmp(second) == 0;
    //     }

    //     return $second.Cmp(first) == 0;
    // }

    public function fromBigInt($int){
        if ($int == null) {
            return array(0, 0);
        }
        $l = $int & 0xFFFFFFFF;
        $r = $int >> 32;
        return array($l, $r);
    }

    public function bigIntToHexString(array $arr){
       $str = dechex(($arr[1] << 32) | $arr[0]);
       if (strlen($str) < 16){
           for ($i=0;$i<16-strlen($str);$i++){
               $str = "0" . $str;
           }
       }
       return $str;
    }
}
?>