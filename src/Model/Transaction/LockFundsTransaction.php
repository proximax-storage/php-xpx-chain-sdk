<?php
/**
 * NIS2 API
 *
 * This document defines all the nis2 api routes and behaviour
 *
 * OpenAPI spec version: 1.0.0
 * Contact: greg@evias.be
 *
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 * 
 */

namespace NEM\Model\Transaction;

use NEM\Model\TransactionType;
use NEM\Model\Deadline;
use NEM\Model\TransactionVersion;
use NEM\Model\TransactionInfo;
use NEM\Model\PublicAccount;
use NEM\Utils\Hex;
use NEM\Infrastructure\Network;
use NEM\Model\Transaction\Schema\LockFundsTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\MessageBuffer;
use \Catapult\Buffers\MosaicBuffer;
use \Catapult\Buffers\LockFundsTransactionBuffer;
use NEM\Utils\Utils;

/**
 * LockFundsTransaction class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class LockFundsTransaction extends \NEM\Model\Transaction{

    private $mosaic;

    private $duration;

    private $signedTransaction;
     
    public function __construct($deadline, $mosaic, $duration, $signedTransaction ,$networkType){
        $abstractTransaction = new \stdClass();
        $abstractTransaction->version = TransactionVersion::LOCK_VERSION;
        $abstractTransaction->deadline = $deadline;
        $abstractTransaction->type = hexdec(TransactionType::LOCK);
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        else if (is_numeric($networkType) && !in_array($networkType, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkType . "'");
        } 
        $abstractTransaction->networkType = $networkType;

        $abstractTransaction->maxFee = array(0,0);
        $abstractTransaction->signature = ""; 
        $abstractTransaction->signer = new PublicAccount;
        $abstractTransaction->transactionInfo = new TransactionInfo;

        $this->setAbstractTransaction($abstractTransaction);

        $this->mosaic = $mosaic;
        $this->duration = $duration;
        $this->signedTransaction = $signedTransaction;
    }

    public function generateBytes() {
        $networkType = $this->getAbstractTransaction()->networkType;
        $version = $this->getAbstractTransaction()->version;
        $deadline = $this->getAbstractTransaction()->deadline;
        $signature = $this->getAbstractTransaction()->signature;
        $signer = $this->getAbstractTransaction()->signer;
        $maxFee = $this->getAbstractTransaction()->maxFee;
        $type = $this->getAbstractTransaction()->type;

        $duration = $this->duration;
        $mosaic = $this->mosaic;
        $signedTransaction = $this->signedTransaction;

        $builder = new FlatbufferBuilder(1);
        
        $v = ($networkType << 8) + $version;
        // Create Vectors
        $signatureVector = LockFundsTransactionBuffer::createSignatureVector($builder, (new Utils)->createArray64Zero());
        $signerVector = LockFundsTransactionBuffer::createSignerVector($builder, (new Utils)->createArray32Zero());
        $deadlineVector = LockFundsTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        $feeVector = LockFundsTransactionBuffer::createMaxFeeVector($builder, $maxFee);
        $mosaicIdVector = LockFundsTransactionBuffer::createMosaicIdVector($builder, $mosaic->getId());
        $mosaicAmountVector = LockFundsTransactionBuffer::createMosaicAmountVector($builder, $mosaic->getAmount());
        $durationVector = LockFundsTransactionBuffer::createDurationVector($builder, $duration);

        $hashVector = LockFundsTransactionBuffer::createHashVector($builder, (new Hex)->DecodeString($signedTransaction->getHash()));


        LockFundsTransactionBuffer::startLockFundsTransactionBuffer($builder);
        LockFundsTransactionBuffer::addSize($builder, 176);
        LockFundsTransactionBuffer::addSignature($builder, $signatureVector);
        LockFundsTransactionBuffer::addSigner($builder, $signerVector);
        LockFundsTransactionBuffer::addVersion($builder, $v);
        LockFundsTransactionBuffer::addType($builder, $type);
        LockFundsTransactionBuffer::addMaxFee($builder, $feeVector);
        LockFundsTransactionBuffer::addDeadline($builder, $deadlineVector);
        LockFundsTransactionBuffer::addMosaicId($builder, $mosaicIdVector);
        LockFundsTransactionBuffer::addMosaicAmount($builder, $mosaicAmountVector);
        LockFundsTransactionBuffer::addDuration($builder, $durationVector);
        LockFundsTransactionBuffer::addHash($builder, $hashVector);

        $codedTransaction = LockFundsTransactionBuffer::endLockFundsTransactionBuffer($builder);
        
        $builder->finish($codedTransaction);
        $LockFundsTransactionSchema = new LockFundsTransactionSchema;

        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $LockFundsTransactionSchema->serialize($builder_byte,0);
        return $output;
    }
}
?>