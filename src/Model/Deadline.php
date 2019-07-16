<?php
namespace NEM\Model;
use NEM\Utils\Utils;
class Deadline{
    const TimeBegin = 1459468800000;

    private $time; //DateTime

    private $time_date;

    private $time_mili_second;

    private $time_array;

    public function __construct($addTime = null){
        $time = new \DateTime();
        if ($addTime != null){
            $interval = 'PT' . $addTime . 'H';
            $time->add(new \DateInterval($interval));
        }        
        $this->time = $time;
        $this->time_date = $time->format("Y-m-d H:i:s.u O");
        $this->time_mili_second = date_timestamp_get($time)*1000;

        $tmp = $this->getInstant($this->time_mili_second);
        $utils = new Utils;
        $this->time_array = $utils->fromBigInt($tmp);
    }

    private function getInstant($time){
        $timeBegin = self::TimeBegin;
        return $time - $timeBegin;
    }

    public function getDate(){
        return $this->time_date;
    }

    public function getTimestamp(){
        return $this->time_mili_second;
    }
    public function getTimeArray(){
        return $this->time_array;
    }

    public function createDeadlineByTimestamp($sub_timestamp){
        $timestamp = ($sub_timestamp + self::TimeBegin)/1000;
        $time = new \DateTime();
        $time->setTimestamp($timestamp);
        $this->time = $time;
        $this->time_date = $time->format("Y-m-d H:i:s.u O");
        $this->time_mili_second = date_timestamp_get($time)*1000;

        $tmp = $this->getInstant($this->time_mili_second);
        $utils = new Utils;
        $this->time_array = $utils->fromBigInt($tmp);
        return $this;
    }
}

?>