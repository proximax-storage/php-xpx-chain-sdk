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
 * MultisigDTO Class Doc Comment
 *
 * @category Class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MultisigGraphDTO{
    private $level;

    private $multisigEntries;


    public function __construct($data){
        $this->level = $data["level"];
        $this->accountAddress = $data["accountAddress"];
    }

    public function getLevel(){
        return $this->level;
    }

    public function getMultisigEntries(){
        return $this->multisigEntries;
    }
}


