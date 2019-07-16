<?php
namespace NEM\Model\Transaction\Attribute;

class ArrayAttribute extends SchemaAttribute {
    private $typeSize;

    public function __construct($name, $typeSize) {
        parent::__construct($name);
        $this->typeSize = $typeSize;
    }

    protected function serialize3Params($buffer, $position, $innerObjectPosition) {
        // echo "ArrayAttribute\n";
        // echo $innerObjectPosition . "\n";
        return $this->findVector($innerObjectPosition, $position, $buffer, $this->typeSize);
    }
}
?>