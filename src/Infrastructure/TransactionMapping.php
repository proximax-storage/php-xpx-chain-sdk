<?php
namespace NEM\Infrastructure;
use NEM\Model\Deadline;
use NEM\Model\MaxFee;
class TransactionMapping{
    public function ExtractVersion($version){
        $bin = decbin($version);
        return bindec($bin & 0xff);
    } 
    public function ExtractDeadline($deadline){
        $sub_timestamp = (($deadline[1] << 32) | ($deadline[0]));
        $deadline = new Deadline;
        return $deadline->createDeadlineByTimestamp($sub_timestamp); 
    } 

    public function ExtractMaxFee($maxFee){
        return new MaxFee($maxFee);
    }
}
?>