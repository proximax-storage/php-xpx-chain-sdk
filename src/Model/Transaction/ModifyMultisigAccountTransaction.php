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

namespace Proximax\Model\Transaction;
use Proximax\Model\TransactionType;
use Proximax\Model\Deadline;
use Proximax\Model\TransactionVersion;
use Proximax\Model\TransactionInfo;
use Proximax\Model\PublicAccount;
use Proximax\Infrastructure\Network;
use Proximax\Model\Transaction\Schema\ModifyMultisigAccountTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\MessageBuffer;
use \Catapult\Buffers\MosaicBuffer;
use \Catapult\Buffers\ModifyMultisigAccountTransactionBuffer;
use \Catapult\Buffers\TransferTransactionBuffer;
use \Catapult\Buffers\CosignatoryModificationBuffer;
use Proximax\Utils\Hex;
use Proximax\Utils\Utils;
use Proximax\Model\AbstractTransaction;

/**
 * ModifyMultisigAccountTransaction class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ModifyMultisigAccountTransaction extends \Proximax\Model\Transaction{

    private $minApprovalDelta; //int

    private $minRemovalDelta; //int

    private $modifications; //MultisigCosignatoryModification
     
    public function __construct($deadline, $minApprovalDelta, $minRemovalDelta, $modifications, $networkType){
        $version = TransactionVersion::MODIFY_MULTISIG_VERSION;
        $type = hexdec(TransactionType::MODIFY_MULTISIG);
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

        $this->minApprovalDelta = $minApprovalDelta;
        $this->minRemovalDelta = $minRemovalDelta;
        $this->modifications = $modifications;
    }

    public function generateBytes() {
        $networkType = $this->getAbstractTransaction()->getNetworkType();
        $version = $this->getAbstractTransaction()->getVersion();
        $deadline = $this->getAbstractTransaction()->getDeadline();
        $signature = $this->getAbstractTransaction()->getSignature();
        $signer = $this->getAbstractTransaction()->getSigner();
        $maxFee = $this->getAbstractTransaction()->getMaxFee();
        $type = $this->getAbstractTransaction()->getType();

        $minApprovalDelta = $this->minApprovalDelta;
        $minRemovalDelta = $this->minRemovalDelta;
        $modifications = $this->modifications;

        $builder = new FlatbufferBuilder(1);
        
        // Create Modifications
        for ($i=0;$i<count($modifications);++$i) {
            $multisigCosignatoryModification = $modifications[$i];
            $byteCosignatoryPublicKey = (new Hex)->DecodeString($multisigCosignatoryModification->getPublicAccount()->getPublicKey());
            $cosignatoryPublicKey = CosignatoryModificationBuffer::createCosignatoryPublicKeyVector($builder, $byteCosignatoryPublicKey);
            CosignatoryModificationBuffer::startCosignatoryModificationBuffer($builder);
            CosignatoryModificationBuffer::addType($builder, $multisigCosignatoryModification->getType());
            CosignatoryModificationBuffer::addCosignatoryPublicKey($builder, $cosignatoryPublicKey);
            $modificationsBuffers[$i] = CosignatoryModificationBuffer::endCosignatoryModificationBuffer($builder);
        }
        $modificationsVector = ModifyMultisigAccountTransactionBuffer::createModificationsVector($builder, $modificationsBuffers);
        
        $v = ($networkType << 24) + $version;

        // Create Vectors
        $signatureVector = ModifyMultisigAccountTransactionBuffer::createSignatureVector($builder, (new Utils)->createArrayZero(64));
        $signerVector = ModifyMultisigAccountTransactionBuffer::createSignerVector($builder, (new Utils)->createArrayZero(32));
        $deadlineVector = ModifyMultisigAccountTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        $feeVector = ModifyMultisigAccountTransactionBuffer::createMaxFeeVector($builder, $maxFee);
        
        // header, min approval, min removal, mod count, mod (type, pub key) * count
        $size = self::HEADER_SIZE + 1 + 1 + 1 + (1 + 32) * count($modifications);

        ModifyMultisigAccountTransactionBuffer::startModifyMultisigAccountTransactionBuffer($builder);
        ModifyMultisigAccountTransactionBuffer::addSize($builder, $size);
        ModifyMultisigAccountTransactionBuffer::addSignature($builder, $signatureVector);
        ModifyMultisigAccountTransactionBuffer::addSigner($builder, $signerVector);
        ModifyMultisigAccountTransactionBuffer::addVersion($builder, $v);
        ModifyMultisigAccountTransactionBuffer::addType($builder, $type);
        ModifyMultisigAccountTransactionBuffer::addMaxFee($builder, $feeVector);
        ModifyMultisigAccountTransactionBuffer::addDeadline($builder, $deadlineVector);

        ModifyMultisigAccountTransactionBuffer::addMinRemovalDelta($builder, $minRemovalDelta);
        ModifyMultisigAccountTransactionBuffer::addMinApprovalDelta($builder, $minApprovalDelta);
        ModifyMultisigAccountTransactionBuffer::addNumModifications($builder, count($modifications));
        ModifyMultisigAccountTransactionBuffer::addModifications($builder, $modificationsVector);
        
        $codedTransaction = ModifyMultisigAccountTransactionBuffer::endModifyMultisigAccountTransactionBuffer($builder);
        
        $builder->finish($codedTransaction);
        $ModifyMultisigAccountTransactionSchema = new ModifyMultisigAccountTransactionSchema;
        
        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $ModifyMultisigAccountTransactionSchema->serialize($builder_byte);
        return $output;
    }
}
?>