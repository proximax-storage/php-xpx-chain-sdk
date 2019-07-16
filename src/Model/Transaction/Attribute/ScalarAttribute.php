<?php
namespace NEM\Model\Transaction\Attribute;

class ScalarAttribute extends SchemaAttribute {
    private $size;

    public function __construct($name, $typeSize) {
        parent::__construct($name);
        $this->size = $typeSize;
    }

    protected function serialize3Params($buffer, $position, $innerObjectPosition) {
        // echo "ScalarAttribute\n";
        // var_dump($buffer);
        // echo $innerObjectPosition . "\n";
        return $this->findParam($innerObjectPosition, $position, $buffer, $this->size);
    }
}
?>