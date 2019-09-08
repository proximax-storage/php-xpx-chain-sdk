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
 * NamespaceMetaDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class NamespaceMetaDTO{

    private $id;//string

    private $active;//boolean

    private $index;//int

    public function __construct($data){
        $this->id = $data["id"];
        $this->active = $data["active"];
        $this->index = $data["index"];
    }

    public function getId(){
        return $this->id;
    }

    public function getActive(){
        return $this->active;
    }

    public function getIndex(){
        return $this->index;
    }
}