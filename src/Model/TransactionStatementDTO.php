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
 * TransactionStatementDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransactionStatementDTO {
    
    private $height; //UInt64DTO

    private $source; //SourceDTO

    private $receipts; //array of receipts

    public function __construct($dataArray){
        $this->height = $dataArray["height"];
        $this->source = $dataArray["source"];
        $this->receipts = $dataArray["receipts"];
    }

    public function getHeight(){
        return $this->height;
    }

    public function getSource(){
        return $this->source;
    }

    public function getReceipts(){
        return $this->receipts;
    }
}


