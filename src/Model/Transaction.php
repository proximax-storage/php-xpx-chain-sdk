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

namespace NEM\Model;

use NEM\Model\TransactionType;
use NEM\Model\Transaction\Transfer;
use NEM\Model\Transaction\Signature;
use NEM\Model\Account;
use NEM\Model\Message;
use NEM\Utils\Hex;
use NEM\Utils\Utils;
/**
 * Transaction class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class Transaction{

    const SignatureSize = 64;
    const SizeSize = 4;
    const SignerSize = 32;

    /**
     * object
     * 
     * included fields type, networkType, version, deadline, fee, signature, signer, transactionInfo
     */
    private $abstractTransaction;

    public function createTransactionHash(string $p){
        $hex = new \NEM\Utils\Hex;
        $b = $hex->DecodeString($p);

        $HalfOfSignature = self::SignatureSize / 2;

        $b1 = array_slice($b,self::SizeSize,$HalfOfSignature);
        $b2 = array_slice($b,self::SizeSize + self::SignatureSize, count($b) - self::SizeSize - self::SignatureSize);
        $sb = array_merge($b1,$b2);

        $sha3Hasher = new \NEM\Core\Sha3Hasher;


        $r = $sha3Hasher->hash("sha3-256",implode(array_map("chr", $sb)));

        return $r;
    }

    public function getAbstractTransaction(){
        return $this->abstractTransaction;
    }

    public function setAbstractTransaction($abstractTransaction){
        return $this->abstractTransaction = $abstractTransaction;
    }

    public function ToAggregate($signer){
        $this->abstractTransaction->signer = $signer;
    }

    public function toAggregateTransactionBytes() {
        $hex = new Hex;
        $signerBytes = $hex->DecodeString($this->abstractTransaction->signer->getPublicKey()); 

        $bytes = $this->generateBytes();
        $resultBytes = array();

        $p2 = array_slice($signerBytes,0,32); // Copy signer
        $p3 = array_slice($bytes,100,4);// Copy type and version
        $p4 = array_slice($bytes,100 + 2 + 2 + 16, count($bytes) - 120);// Copy following data

        $utils = new Utils;
        
        $size = $utils->intToArray(count($bytes) - 64 - 16);
        $p1 = $utils->ReverseByteArray($size);

        $resultBytes = array_merge($p1,$p2,$p3,$p4);
        return $resultBytes;
    }
}
