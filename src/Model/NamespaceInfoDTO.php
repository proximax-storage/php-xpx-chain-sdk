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
 * NamespaceInfoDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class NamespaceInfoDTO{

    private $meta;//NamespaceMetaDTO

    private $namespace;//NamespaceDTO

    public function __construct($data){
        $this->meta = $data["meta"];
        $this->namespace = $data["namespace"];
    }

    public function getMeta(){
        return $this->meta;
    }

    public function getNamespace(){
        return $this->namespace;
    }
}
