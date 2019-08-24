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
 * MerkleProofInfoDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MerkleProofInfoDTO{

    private $payload; //MerkleProofInfo

    private $type; //String

    public function __construct($dataArray){
        $this->payload = $data["payload"];
        $this->type = $data["type"];
    }

    public function getPayload(){
        return $this->payload;
    }

    public function getType(){
        return $this->type;
    }
}
