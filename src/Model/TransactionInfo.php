<?php
namespace NEM\Model;

class TransactionInfo{

    public $height; //HeightDTO

    public $index; //int

    public $id; //string

    public $hash; //string

    public $merkleComponentHash;//string

    public $aggregateHash;//string

    public $aggregateId;//string


    public function __construct($height = null, $index = null, $id = null, $hash = null, 
                                $merkleComponentHash = null, $aggregateHash = null, $aggregateId = null){
        if($height !== null){
            $this->height = $height;
        }
        else  $this->height = array();

        if ($index !== null){
            $this->index = $index;
        }
        else $this->index = null;

        if ($id !== null){
            $this->id = $id;
        }
        else $this->id = null;

        if ($hash !== null){
            $this->hash = $hash;
        }
        else $this->hash = null;

        if ($merkleComponentHash !== null){
            $this->merkleComponentHash = $merkleComponentHash;
        }
        else $this->merkleComponentHash = null;

        if ($aggregateHash !== null){
            $this->aggregateHash = $aggregateHash;
        }
        else $this->aggregateHash = null;

        if ($aggregateId !== null){
            $this->aggregateId = $aggregateId;
        }
        else $this->aggregateId = null;
    }
}
?>