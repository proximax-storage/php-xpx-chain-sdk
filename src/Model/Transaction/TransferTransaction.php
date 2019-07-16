<?php
namespace NEM\Model\Transaction;
use NEM\Model\TransactionType;
use NEM\Model\Deadline;
use NEM\Model\TransactionVersion;
use NEM\Model\TransactionInfo;
use NEM\Model\PublicAccount;
use NEM\Infrastructure\Network;
use NEM\Model\Transaction\Schema\TransferTransactionSchema;
use \Google\FlatBuffers\FlatbufferBuilder;
use \Catapult\Buffers\MessageBuffer;
use \Catapult\Buffers\MosaicBuffer;
use \Catapult\Buffers\TransferTransactionBuffer;

class TransferTransaction{

    public $abstractTransaction; //object

    public $recipient;
    public $mosaics; //array
    public $message;
     
    public function __construct($deadline, $address, $mosaics, $message, $networkType){
        $abstractTransaction = new \stdClass();
        $abstractTransaction->version = TransactionVersion::TRANSFER_VERSION;
        $abstractTransaction->deadline = $deadline;
        $abstractTransaction->type = hexdec(TransactionType::TRANSFER);
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        else if (is_numeric($networkType) && !in_array($networkType, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkType . "'");
        } 
        $abstractTransaction->networkType = $networkType;

        $abstractTransaction->maxFee = array(0,0);
        $abstractTransaction->signature = ""; 
        $abstractTransaction->signer = new PublicAccount($address);
        $abstractTransaction->transactionInfo = new TransactionInfo;

        $this->abstractTransaction = $abstractTransaction;
        $this->recipient = $address;
        $this->mosaics = $mosaics;
        $this->message = $message;
    }

    public function generateBytes() {
        $networkType = $this->abstractTransaction->networkType;
        $version = $this->abstractTransaction->version;
        $deadline = $this->abstractTransaction->deadline;
        $signature = $this->abstractTransaction->signature;
        $signer = $this->abstractTransaction->signer;
        $maxFee = $this->abstractTransaction->maxFee;
        $type = $this->abstractTransaction->type;

        $message = $this->message;
        $mosaics = $this->mosaics;
        $address = $this->recipient;

        $builder = new FlatbufferBuilder(1);
        
        // Create Message
        $bytePayload = $message->payload;
        $payload = MessageBuffer::createPayloadVector($builder, $bytePayload);
        MessageBuffer::startMessageBuffer($builder);
        MessageBuffer::addType($builder, $message->type);
        MessageBuffer::addPayload($builder, $payload);
        $messageVector = MessageBuffer::endMessageBuffer($builder);

        // Create Mosaics
        for ($i = 0; $i < count($mosaics); ++$i) {
            $mosaic = $mosaics[$i];
            $id = MosaicBuffer::createIdVector($builder, $mosaic->id);
            $amount = MosaicBuffer::createAmountVector($builder, $mosaic->amount);

            MosaicBuffer::startMosaicBuffer($builder);
            MosaicBuffer::addId($builder, $id);
            MosaicBuffer::addAmount($builder, $amount);
            $mosaicBuffers[$i] = MosaicBuffer::endMosaicBuffer($builder);
        }
        // serialize the recipient
        $recipientBytes = $this->DecodeString($address->address);
        //var_dump($deadline->getTimeArray());

        $v = ($networkType << 8) + $version;
        // Create Vectors
        $signatureVector = TransferTransactionBuffer::createSignatureVector($builder, array());
        $signerVector = TransferTransactionBuffer::createSignerVector($builder, array());
        $recipientVector = TransferTransactionBuffer::createRecipientVector($builder, $recipientBytes);
        $mosaicsVector = TransferTransactionBuffer::createMosaicsVector($builder, $mosaicBuffers);
        $deadlineVector = TransferTransactionBuffer::createDeadlineVector($builder, $deadline->getTimeArray());
        var_dump($deadlineVector);
        $feeVector = TransferTransactionBuffer::createFeeVector($builder, $maxFee);
        

        // total size of transaction
        $size = 
              // header
              120 + 
              // recipient is always 25 bytes
              25 + 
              // message size is short
              2 +
              // message type byte
              1 + 
              // number of mosaics
              1 + 
              // each mosaic has id and amount, both 8byte uint64
              ((8 + 8) * count($mosaics)) + 
              // number of message bytes
              count($bytePayload);

        TransferTransactionBuffer::startTransferTransactionBuffer($builder);
        TransferTransactionBuffer::addSize($builder, $size);
        TransferTransactionBuffer::addSignature($builder, $signatureVector);
        TransferTransactionBuffer::addSigner($builder, $signerVector);
        TransferTransactionBuffer::addVersion($builder, $v);
        TransferTransactionBuffer::addType($builder, $type);
        TransferTransactionBuffer::addFee($builder, $feeVector);
        TransferTransactionBuffer::addDeadline($builder, $deadlineVector);
        
        TransferTransactionBuffer::addRecipient($builder, $recipientVector);
        TransferTransactionBuffer::addNumMosaics($builder, count($mosaics));
        TransferTransactionBuffer::addMessageSize($builder, count($bytePayload) + 1);
        TransferTransactionBuffer::addMessage($builder, $messageVector);
        TransferTransactionBuffer::addMosaics($builder, $mosaicsVector);
        
        $codedTransfer = TransferTransactionBuffer::endTransferTransactionBuffer($builder);
        
        $builder->finish($codedTransfer);
        $TransferTransactionSchema = new TransferTransactionSchema;
        //var_dump($builder->sizedByteArray());
        $tmp = unpack("C*",$builder->sizedByteArray());
        $builder_byte = array_slice($tmp,0,count($tmp));
        $output = $TransferTransactionSchema->serialize($builder_byte,0);
        return $output;
    }

    public function DecodeString(string $s){
        $CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
        $arr = unpack('C*', $s);
        $convertedBytes = array();
        $index = 0;
        $bitCount = 0;
        $current = 0;
        for ($i=1;$i<=count($arr);$i++){
            //echo "1";
            $symbolValue = strpos($CHARS,chr($arr[$i]));
            if ($symbolValue < 0) {
                throw new Exception("symbol value must bigger than 0");
            }
            for ($j=4;$j>=0;$j--) {
                $current = ($current << 1) + ($symbolValue >> $j & 0x1);
                $bitCount++;
                //echo $bitCount . "\n";
                if ($bitCount == 8) {
                    //echo $index . "\n";
                    $convertedBytes[$index++] = $current;

                    $bitCount = 0;
                    $current = 0;
                }
            }
        }
        return $convertedBytes;
    }
}
?>