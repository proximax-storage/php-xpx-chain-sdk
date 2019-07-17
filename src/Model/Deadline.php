<?php
namespace NEM\Model;
use NEM\Utils\Utils;
class Deadline{
    const TimeBegin = 1459468800000;

    private $time; //DateTime

    public function __construct($addTime = null){
        $time = new \DateTime();
        if ($addTime !== null){
            $interval = 'PT' . $addTime . 'H'; //unit hour
            $time->add(new \DateInterval($interval));
        }
        else {
            $interval = 'PT1M'; //default 1 minute
            $time->add(new \DateInterval($interval));
        }      
        $this->time = $time;
    }

    private function getInstant($time){
        $timeBegin = self::TimeBegin;
        return $time - $timeBegin;
    }

    public function getDate(){
        return $this->time->format("Y-m-d H:i:s.u O");
    }

    public function getTimestamp(){
        return date_timestamp_get($this->time)*1000;
    }
    
    public function getTimeArray(){
        $tmp = $this->getInstant($this->getTimestamp());
        $utils = new Utils;
        return $utils->fromBigInt($tmp);
    }

    public function createDeadlineByTimestamp($sub_timestamp){
        $timestamp = ($sub_timestamp + self::TimeBegin)/1000;
        $time = new \DateTime();
        $time->setTimestamp($timestamp);
        $this->time = $time;
        return $this;
    }
}

?>