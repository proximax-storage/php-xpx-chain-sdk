<?php
namespace NEM\Model\Transaction\Attribute;

class TableAttribute extends SchemaAttribute {
    private $schema; //array SchemaAttribute

    public function __construct($name, $schema) {
        parent::__construct($name);
        $this->schema = $schema;
    }

    protected function serialize3Params($buffer, $position, $innerObjectPosition) {
        // echo "TableAttribute\n";
        // echo $innerObjectPosition . "\n";
        
        $resultBytes = array();
        $tableStartPosition = $this->findObjectStartPosition($innerObjectPosition, $position, $buffer);
        for ($i=0;$i<count($this->schema);++$i) {
            $tmp = $this->schema[$i]->serialize($buffer, 4 + ($i * 2), $tableStartPosition);
            $resultBytes = array_merge($resultBytes, $tmp);
        }
        return $resultBytes;
    }
}
?>