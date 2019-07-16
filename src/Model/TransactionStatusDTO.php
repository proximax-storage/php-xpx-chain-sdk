<?php

namespace NEM\Model;

use \ArrayAccess;
use \NEM\ObjectSerializer;

class TransactionStatusDTO {
    private $group;

    private $status;

    private $hash;

    private $deadline;

    private $height;

    public function __construct($dataArray){
        $this->group = $dataArray["group"];
        $this->status = $dataArray["status"];
        $this->hash = $dataArray["hash"];
        $this->deadline = $dataArray["deadline"];
        $this->height = $dataArray["height"];
    }

    public function getGroup(){
        return $this->group;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getHash(){
        return $this->hash;
    }

    public function getDeadline(){
        return $this->deadline;
    }

    public function getHeight(){
        return $this->height;
    }
}


