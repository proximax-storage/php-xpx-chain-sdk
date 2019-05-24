<?php
// automatically generated by the FlatBuffers compiler, do not modify

namespace Catapult\Buffers;

use \Google\FlatBuffers\Struct;
use \Google\FlatBuffers\Table;
use \Google\FlatBuffers\ByteBuffer;
use \Google\FlatBuffers\FlatBufferBuilder;

class ModifyMultisigAccountTransactionBuffer extends Table
{
    /**
     * @param ByteBuffer $bb
     * @return ModifyMultisigAccountTransactionBuffer
     */
    public static function getRootAsModifyMultisigAccountTransactionBuffer(ByteBuffer $bb)
    {
        $obj = new ModifyMultisigAccountTransactionBuffer();
        return ($obj->init($bb->getInt($bb->getPosition()) + $bb->getPosition(), $bb));
    }

    /**
     * @param int $_i offset
     * @param ByteBuffer $_bb
     * @return ModifyMultisigAccountTransactionBuffer
     **/
    public function init($_i, ByteBuffer $_bb)
    {
        $this->bb_pos = $_i;
        $this->bb = $_bb;
        return $this;
    }

    /**
     * @return uint
     */
    public function getSize()
    {
        $o = $this->__offset(4);
        return $o != 0 ? $this->bb->getUint($o + $this->bb_pos) : 0;
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getSignature($j)
    {
        $o = $this->__offset(6);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getSignatureLength()
    {
        $o = $this->__offset(6);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getSignatureBytes()
    {
        return $this->__vector_as_bytes(6);
    }

    /**
     * @param int offset
     * @return byte
     */
    public function getSigner($j)
    {
        $o = $this->__offset(8);
        return $o != 0 ? $this->bb->getByte($this->__vector($o) + $j * 1) : 0;
    }

    /**
     * @return int
     */
    public function getSignerLength()
    {
        $o = $this->__offset(8);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return string
     */
    public function getSignerBytes()
    {
        return $this->__vector_as_bytes(8);
    }

    /**
     * @return ushort
     */
    public function getVersion()
    {
        $o = $this->__offset(10);
        return $o != 0 ? $this->bb->getUshort($o + $this->bb_pos) : 0;
    }

    /**
     * @return ushort
     */
    public function getType()
    {
        $o = $this->__offset(12);
        return $o != 0 ? $this->bb->getUshort($o + $this->bb_pos) : 0;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getFee($j)
    {
        $o = $this->__offset(14);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getFeeLength()
    {
        $o = $this->__offset(14);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param int offset
     * @return uint
     */
    public function getDeadline($j)
    {
        $o = $this->__offset(16);
        return $o != 0 ? $this->bb->getUint($this->__vector($o) + $j * 4) : 0;
    }

    /**
     * @return int
     */
    public function getDeadlineLength()
    {
        $o = $this->__offset(16);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @return byte
     */
    public function getMinRemovalDelta()
    {
        $o = $this->__offset(18);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    /**
     * @return byte
     */
    public function getMinApprovalDelta()
    {
        $o = $this->__offset(20);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    /**
     * @return byte
     */
    public function getNumModifications()
    {
        $o = $this->__offset(22);
        return $o != 0 ? $this->bb->getByte($o + $this->bb_pos) : 0;
    }

    /**
     * @returnVectorOffset
     */
    public function getModifications($j)
    {
        $o = $this->__offset(24);
        $obj = new CosignatoryModificationBuffer();
        return $o != 0 ? $obj->init($this->__indirect($this->__vector($o) + $j * 4), $this->bb) : null;
    }

    /**
     * @return int
     */
    public function getModificationsLength()
    {
        $o = $this->__offset(24);
        return $o != 0 ? $this->__vector_len($o) : 0;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return void
     */
    public static function startModifyMultisigAccountTransactionBuffer(FlatBufferBuilder $builder)
    {
        $builder->StartObject(11);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return ModifyMultisigAccountTransactionBuffer
     */
    public static function createModifyMultisigAccountTransactionBuffer(FlatBufferBuilder $builder, $size, $signature, $signer, $version, $type, $fee, $deadline, $minRemovalDelta, $minApprovalDelta, $numModifications, $modifications)
    {
        $builder->startObject(11);
        self::addSize($builder, $size);
        self::addSignature($builder, $signature);
        self::addSigner($builder, $signer);
        self::addVersion($builder, $version);
        self::addType($builder, $type);
        self::addFee($builder, $fee);
        self::addDeadline($builder, $deadline);
        self::addMinRemovalDelta($builder, $minRemovalDelta);
        self::addMinApprovalDelta($builder, $minApprovalDelta);
        self::addNumModifications($builder, $numModifications);
        self::addModifications($builder, $modifications);
        $o = $builder->endObject();
        return $o;
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param uint
     * @return void
     */
    public static function addSize(FlatBufferBuilder $builder, $size)
    {
        $builder->addUintX(0, $size, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addSignature(FlatBufferBuilder $builder, $signature)
    {
        $builder->addOffsetX(1, $signature, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createSignatureVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(1, count($data), 1);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->addByte($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startSignatureVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addSigner(FlatBufferBuilder $builder, $signer)
    {
        $builder->addOffsetX(2, $signer, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createSignerVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(1, count($data), 1);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->addByte($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startSignerVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(1, $numElems, 1);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param ushort
     * @return void
     */
    public static function addVersion(FlatBufferBuilder $builder, $version)
    {
        $builder->addUshortX(3, $version, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param ushort
     * @return void
     */
    public static function addType(FlatBufferBuilder $builder, $type)
    {
        $builder->addUshortX(4, $type, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addFee(FlatBufferBuilder $builder, $fee)
    {
        $builder->addOffsetX(5, $fee, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createFeeVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->addUint($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startFeeVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addDeadline(FlatBufferBuilder $builder, $deadline)
    {
        $builder->addOffsetX(6, $deadline, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createDeadlineVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->addUint($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startDeadlineVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addMinRemovalDelta(FlatBufferBuilder $builder, $minRemovalDelta)
    {
        $builder->addByteX(7, $minRemovalDelta, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addMinApprovalDelta(FlatBufferBuilder $builder, $minApprovalDelta)
    {
        $builder->addByteX(8, $minApprovalDelta, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param byte
     * @return void
     */
    public static function addNumModifications(FlatBufferBuilder $builder, $numModifications)
    {
        $builder->addByteX(9, $numModifications, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param VectorOffset
     * @return void
     */
    public static function addModifications(FlatBufferBuilder $builder, $modifications)
    {
        $builder->addOffsetX(10, $modifications, 0);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param array offset array
     * @return int vector offset
     */
    public static function createModificationsVector(FlatBufferBuilder $builder, array $data)
    {
        $builder->startVector(4, count($data), 4);
        for ($i = count($data) - 1; $i >= 0; $i--) {
            $builder->addOffset($data[$i]);
        }
        return $builder->endVector();
    }

    /**
     * @param FlatBufferBuilder $builder
     * @param int $numElems
     * @return void
     */
    public static function startModificationsVector(FlatBufferBuilder $builder, $numElems)
    {
        $builder->startVector(4, $numElems, 4);
    }

    /**
     * @param FlatBufferBuilder $builder
     * @return int table offset
     */
    public static function endModifyMultisigAccountTransactionBuffer(FlatBufferBuilder $builder)
    {
        $o = $builder->endObject();
        return $o;
    }

    public static function finishModifyMultisigAccountTransactionBufferBuffer(FlatBufferBuilder $builder, $offset)
    {
        $builder->finish($offset);
    }
}
