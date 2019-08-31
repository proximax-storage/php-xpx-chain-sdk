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

namespace Proximax\Model;

/**
 * AbstractTransaction Class Doc Comment
 *
 * @category Class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AbstractTransaction{
    private $transactionInfo;// TransactionInfo

    private $deadline; //Deadline

    private $networkType; //int

    private $type; //TransactionType

    private $version; //TransactionVersion

    private $maxFee; //bigInt

    private $signature; //string

    private $signer; //PublicAccount

    public function __construct($transactionInfo, $deadline, $networkType, $type, $version, $maxFee, $signature, $signer){
        $this->transactionInfo = $transactionInfo;
        $this->deadline = $deadline;
        $this->networkType = $networkType;
        $this->type = $type;
        $this->version = $version;
        $this->maxFee = $maxFee;
        $this->signature = $signature;
        $this->signer = $signer;
    }

    public function getTransactionInfo(){
        return $this->transactionInfo;
    }

    public function getDeadline(){
        return $this->deadline;
    }

    public function getNetworkType(){
        return $this->networkType;
    }

    public function getType(){
        return $this->type;
    }

    public function getVersion(){
        return $this->version;
    }

    public function getMaxFee(){
        return $this->maxFee;
    }

    public function getSignature(){
        return $this->signature;
    }

    public function getSigner(){
        return $this->signer;
    }

    public function setVersion($version){
        $this->version = $version;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setSigner($signer){
        $this->signer = $signer;
    }
}

