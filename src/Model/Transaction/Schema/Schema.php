<?php
namespace NEM\Model\Transaction\Schema;

class Schema{
    private $schemaDefinition; //array SchemaAttribute

    public function __construct($schemaDefinition){
        $this->schemaDefinition = $schemaDefinition;
    }

    public function serialize($bytes) {
        $resultBytes = array();
        $arr = $this->schemaDefinition;
        //$tmp = $this->schemaDefinition[0]->serialize($bytes, 4 + (0 * 2));
        for ($i=0;$i<count($arr);++$i) {
            $tmp = $this->schemaDefinition[$i]->serialize($bytes, 4 + ($i * 2));
            $resultBytes = array_merge($resultBytes, $tmp);
        }
        return $resultBytes;
    }
}
?>