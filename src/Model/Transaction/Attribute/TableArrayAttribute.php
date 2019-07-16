<?php
namespace NEM\Model\Transaction\Attribute;

class TableArrayAttribute extends SchemaAttribute {
    private $schema; //array SchemaAttribute

    public function __construct($name, $schema){
        parent::__construct($name);
        $this->schema = $schema;
    }

    protected function serialize3Params($buffer, $position, $innerObjectPosition) {
        // echo "TableArrayAttribute\n";
        // echo $innerObjectPosition . "\n";
        $resultBytes = array();
        $arrayLength = $this->findArrayLength($innerObjectPosition, $position, $buffer);

        for ($i=0;$i<$arrayLength;$i++) {
            $startArrayPosition = $this->findObjectArrayElementStartPosition($innerObjectPosition, $position, $buffer, $i);
            for ($j=0;$j<count($this->schema); ++$j){
                $tmp = $this->schema[$j]->serialize($buffer, 4 + ($j * 2), $startArrayPosition);
                $resultBytes = array_merge($resultBytes, $tmp);
            }
        }
        return $resultBytes;
    }
}
?>