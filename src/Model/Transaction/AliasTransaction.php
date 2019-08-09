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
use NEM\Infrastructure\Network;
use NEM\Model\Transaction\Schema\AliasTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\MosaicBuffer;
use \Catapult\Buffers\AliasTransactionBuffer;
use NEM\Utils\Utils;
use NEM\Model\AbstractTransaction;
use NEM\Model\Transaction\IdGenerator;
use Base32\Base32;

/**
 * AliasTransaction class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AliasTransaction extends \NEM\Model\Transaction{

    private $mosaicId;//mosaic <optional>
    private $address; //address <optional>
    private $namespaceId; //NamespaceId
    private $aliasActionType; //AliasActionType
     
    public function NewAddressAliasTransaction($deadline, $aliasActionType, $namespace, $address, $networkType){
        $version = TransactionVersion::ADDRESS_ALIAS_VERSION;
        $type = hexdec(TransactionType::ADDRESS_ALIAS);
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        else if (is_numeric($networkType) && !in_array($networkType, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkType . "'");
        } 
        $maxFee = array(0,0);
        $signature = ""; 
        $signer = new PublicAccount;
        $transactionInfo = new TransactionInfo;

        $abstractTransaction = new AbstractTransaction($transactionInfo,$deadline,$networkType,
                                                    $type,$version,$maxFee,$signature,$signer);
        $this->setAbstractTransaction($abstractTransaction);
        $this->namespaceId = IdGenerator::NewNamespaceIdFromName($namespace);
        $this->address = $address;
        $this->aliasActionType = $aliasActionType;
        $this->mosaicId = array(0,0);

        return $this;
    }

    public function NewMosaicAliasTransaction($deadline, $aliasActionType, $namespace, $mosaicId, $networkType){
        $version = TransactionVersion::MOSAIC_ALIAS_VERSION;
        $type = hexdec(TransactionType::MOSAIC_ALIAS);
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        else if (is_numeric($networkType) && !in_array($networkType, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkType . "'");
        } 
        $maxFee = array(0,0);
        $signature = ""; 
        $signer = new PublicAccount;
        $transactionInfo = new TransactionInfo;

        $abstractTransaction = new AbstractTransaction($transactionInfo,$deadline,$networkType,
                                                    $type,$version,$maxFee,$signature,$signer);
        $this->setAbstractTransaction($abstractTransaction);
        $this->namespaceId = IdGenerator::NewNamespaceIdFromName($namespace);
        $this->address = null;
        $this->aliasActionType = $aliasActionType;
        $this->mosaicId = $mosaicId;

        return $this;
    }

    public function generateBytes() {
        $networkType = $this->getAbstractTransaction()->getNetworkType();
        $version = $this->getAbstractTransaction()->getVersion();
        $deadline = $this->getAbstractTransaction()->getDeadline();
        $signature = $this->getAbstractTransaction()->getSignature();
        $signer = $this->getAbstractTransaction()->getSigner();
        $maxFee = $this->getAbstractTransaction()->getMaxFee();
        $type = $this->getAbstractTransaction()->getType();

        $namespaceId = $this->namespaceId;
        $address = $this->address;
        $aliasActionType = $this->aliasActionType;
        $mosaicId = $this->mosaicId;

        $builder = new FlatbufferBuilder(1);
        if ($type == hexdec(TransactionType::ADDRESS_ALIAS)){
            var_dump("1");
            $tmp = Base32::decode($address->toClean());
            $aliasIdBytes = (new Utils)->stringToByteArray($tmp);
        }
        else if ($type == hexdec(TransactionType::MOSAIC_ALIAS)){
            var_dump("2");
            $aliasIdBytes = (new Utils)->getBytes($mosaicId->getId());
        }
        $v = ($networkType << 8) + $version;
        // Create Vectors
        $signatureVector = AliasTransactionBuffer::createSignatureVector($builder, (new Utils)->createArrayZero(64));
        $signerVector = AliasTransactionBuffer::createSignerVector($builder, (new Utils)->createArrayZero(32));
        $deadlineVector = AliasTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        $feeVector = AliasTransactionBuffer::createMaxFeeVector($builder, $maxFee);

        $namespaceIdVector = AliasTransactionBuffer::createNamespaceIdVector($builder,$namespaceId->getId());
        $aliasIdOffset = AliasTransactionBuffer::createAliasIdVector($builder, $aliasIdBytes);
      
        $size = 120 + count($aliasIdBytes) + 8 + 1;
        AliasTransactionBuffer::startAliasTransactionBuffer($builder);
        AliasTransactionBuffer::addSize($builder, $size);
        AliasTransactionBuffer::addSignature($builder, $signatureVector);
        AliasTransactionBuffer::addSigner($builder, $signerVector);
        AliasTransactionBuffer::addVersion($builder, $v);
        AliasTransactionBuffer::addType($builder, $type);
        AliasTransactionBuffer::addMaxFee($builder, $feeVector);
        AliasTransactionBuffer::addDeadline($builder, $deadlineVector);

        AliasTransactionBuffer::addAliasId($builder, $aliasIdOffset);
        AliasTransactionBuffer::addNamespaceId($builder, $namespaceIdVector);
        AliasTransactionBuffer::addActionType($builder, $aliasActionType);

        $codedTransaction = AliasTransactionBuffer::endAliasTransactionBuffer($builder);
        $builder->finish($codedTransaction);
        $AliasTransactionSchema = new AliasTransactionSchema;
        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $AliasTransactionSchema->serialize($builder_byte);
        return $output;
    }
}
?>