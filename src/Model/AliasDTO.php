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
 * AliasDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AliasDTO{

    private $type; //AliasTypeEnum

    private $mosaicId; //UInt64DTO

    private $address; //string

    public function __construct($data){
        $this->type = $data["type"];
        $this->mosaicId = $data["mosaicId"];
        $this->address = $data["address"];
    }

    public function getType(){
        return $this->type;
    }

    public function getMosaicId(){
        return $this->mosaicId;
    }

    public function getAddress(){
        return $this->address;
    }
}
