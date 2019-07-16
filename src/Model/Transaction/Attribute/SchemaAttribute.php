<?php
namespace NEM\Model\Transaction\Attribute;

abstract class SchemaAttribute {
    private $name;

    public function __construct($name){
        $this->name = $name;
    }

    abstract protected function serialize3Params($buffer, $position, $innerObjectPosition);

    protected function serialize2Params($buffer, $position) {
        return $this->serialize3Params($buffer, $position, $buffer[0]);
    }

    public function __call($method, $arguments) {
        if($method == 'serialize') {
            if(count($arguments) == 2) {
               return call_user_func_array(array($this,'serialize2Params'), $arguments);
            }
            else if(count($arguments) == 3) {
               return call_user_func_array(array($this,'serialize3Params'), $arguments);
            }
        }
    }

    public function getName() {
        return $name;
    }

    protected function findParam($innerObjectPosition, $position, $buffer, $typeSize) {
        $offset = $this->__offset($innerObjectPosition, $position, $buffer);

        $from = $offset + $innerObjectPosition;
        $to = $offset + $innerObjectPosition + $typeSize;
        $noItems = $to - $from;

        return $offset == 0 ? array(0) : array_slice($buffer, $from, $noItems);
    }

    protected function findVector($innerObjectPosition, $position, $buffer, $typeSize) {
        $offset = $this->__offset($innerObjectPosition, $position, $buffer);
        $offsetLong = $offset + $innerObjectPosition;
        $vecStart = $this->__vector($offsetLong, $buffer);
        $vecLength = $this->__vector_length($offsetLong, $buffer) * $typeSize;
        return $offset == 0 ? array(0) : array_slice($buffer, $vecStart, $vecLength);
    }

    protected function findObjectStartPosition($innerObjectPosition, $position, $buffer) {
        $offset = $this->__offset($innerObjectPosition, $position, $buffer);
        return $this->__indirect($offset + $innerObjectPosition, $buffer);
    }

    protected function findArrayLength($innerObjectPosition, $position, $buffer) {
        $offset = $this->__offset($innerObjectPosition, $position, $buffer);
        return $offset == 0 ? 0 : $this->__vector_length($innerObjectPosition + $offset, $buffer);
    }

    protected function findObjectArrayElementStartPosition($innerObjectPosition, $position, $buffer, $startPosition) {
        $offset = $this->__offset($innerObjectPosition, $position, $buffer);
        $vector = $this->__vector($innerObjectPosition + $offset, $buffer);
        return $this->__indirect($vector + $startPosition * 4, $buffer);
    }

    protected function readInt32($offset, $buffer) {
        /*final ByteBuffer bb = ByteBuffer.wrap(new byte[]{buffer[offset], buffer[offset + 1], buffer[offset + 2], buffer[offset + 3]});
        bb.order(ByteOrder.LITTLE_ENDIAN);
        return bb.getInt();*/
        $value = ($buffer[$offset + 3] << (8 * 3));
        $value |= ($buffer[$offset + 2] & 0xFF) << (8 * 2);
        $value |= ($buffer[$offset + 1] & 0xFF) << (8);
        $value |= ($buffer[$offset] & 0xFF);
        return $value;
    }

    protected function readInt16($offset, $buffer) {
        /*final ByteBuffer bb = ByteBuffer.wrap(new byte[]{buffer[offset], buffer[offset + 1]});
        bb.order(ByteOrder.LITTLE_ENDIAN);
        return bb.getShort();*/
        $value = ($buffer[$offset + 1] & 0xFF) << (8);
        $value |= ($buffer[$offset] & 0xFF);
        return $value;
    }

    protected function __offset($innerObjectPosition, $position, $buffer) {
        $vtable = $innerObjectPosition - $this->readInt32($innerObjectPosition, $buffer);
        return $position < $this->readInt16($vtable, $buffer) ? $this->readInt16($vtable + $position, $buffer) : 0;
    }

    protected function __vector_length($offset, $buffer) {
        return $this->readInt32($offset + $this->readInt32($offset, $buffer), $buffer);
    }

    protected function __indirect($offset, $buffer) {
        return $offset + $this->readInt32($offset, $buffer);
    }

    protected function __vector($offset, $buffer) {
        return $offset + $this->readInt32($offset, $buffer) + 4;
    }
}
?>