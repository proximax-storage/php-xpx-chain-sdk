<?php
namespace NEM\Utils;

class Hex{
    const hextable = "0123456789abcdef";
    
    /**
     * ErrLength reports an attempt to decode an odd-length input
     * using Decode or DecodeString.
     * The stream-based Decoder returns io.ErrUnexpectedEOF instead of ErrLength.
     * 
     */
    
    const ErrLength = "encoding/hex: odd length hex string";
    
    /**
     * EncodedLen returns the length of an encoding of n source bytes.
     * Specifically, it returns n * 2.
     * @param int $n 
     * 
     * @return int $n*2
     */
    public function EncodedLen($n){ 
        return $n * 2 ;
    }
    /** 
     * Encode encodes src into EncodedLen(len(src))
     * bytes of dst. As a convenience, it returns the number
     * of bytes written to dst, but this value is always EncodedLen(len(src)).
     * Encode implements hexadecimal encoding.
     * 
     * @param byte array $src
     * 
     * @return int 
     */
    public function Encode($src){
        for ($i=0;$i<count($src);$i++){
            $dst[$i*2] = self::hextable[$src[$i]>>4];
            $dst[$i*2+1] = self::hextable[$src[$i]&0x0f];
        }
        return $dst;
    }
    /**
     * DecodedLen returns the length of a decoding of x source bytes.
     * 
     * @param int $x
     * 
     * @return int $x/2
     */
    public function DecodedLen($x){ 
        return $x / 2; 
    }

    /**
     * EncodeToString returns the hexadecimal encoding of src.
     * 
     * @param byte array $src
     * 
     * @return string
     */
    public function EncodeToString($src){
        $dst = $this->Encode($src);
        return implode("",$dst);;
    }
 
    /**
     * DecodeString returns the bytes represented by the hexadecimal string s.
     *
     * DecodeString expects that src contains only hexadecimal
     * characters and that src has even length.
     * If the input is malformed, DecodeString returns
     * the bytes decoded before the error.
     * @param string $str
     * 
     * @return byte array 
     **/
    public function DecodeString(string $str){
        $byte_arr = unpack('C*', $str);
        return $this->Decode($byte_arr);
    }


    /** Decode decodes src into DecodedLen(len(src)) bytes,
     *  returning the actual number of bytes written to dst.
     *  Decode expects that src contains only hexadecimal
     *  characters and that src has even length.
     *  If the input is malformed, Decode returns the number
     *  of bytes decoded before the error.
     * @param string $str
     * 
     * @return byte array $src
     **/
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

    /**
     * fromHexChar converts a hex character into its value and a success flag.
     * @param char $c
     * 
     * @return char $c
     **/
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
     * 
     * @return byte array $new_arr
     */
    public function GenerateCheckSum($arr){
        $string = implode(array_map("chr", $arr));
        $new_str = hash("sha3-256",$string);

        $new_arr = $this->DecodeString($new_str);
        return array_slice($new_arr,0,4);
    }

    /**
     * HexDecodeStringOdd return padding hex representation of string
     * 
     * @param string s
     * 
     * @return byte array $new_arr
     */
    public function HexDecodeStringOdd($s){
        if (count($s)%2 != 0) {
            $s = "0" + $s;
        }
        return $this->DecodeString($s);
    }
}
?>