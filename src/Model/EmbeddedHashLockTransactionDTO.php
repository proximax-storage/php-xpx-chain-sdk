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
 * EmbeddedHashLockTransactionDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class EmbeddedHashLockTransactionDTO extends EmbeddedTransactionDTO{

    private $duration;//UInt64DTO

    private $mosaic;//MosaicDTO

    private $hash;//string

    public function __construct($data){
        $this->signer = $data["signer"];
        $this->version = $data["version"];
        $this->type = $data["type"];
        $this->duration = $data["duration"];
        $this->mosaic = $data["mosaic"];
        $this->hash = $data["hash"];
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getMosaic(){
        return $this->mosaic;
    }

    public function getHash(){
        return $this->hash;
    }
}
