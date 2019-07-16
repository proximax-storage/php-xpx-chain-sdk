<?php

namespace NEM\Core;

class ByteArray{

    /**
     * Create a byte array has $number element and all element have value 0
     *
     * @param  int $number
     *
     * @return array $arr
     */
    public function make($number){
        $arr = array();
        for ($i=0;$i<$number;$i++){
            $arr[$i] = 0;
        }
        return $arr;
    }
} 
?>