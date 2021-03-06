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
use Proximax\Utils\Utils;
use Proximax\Model\MosaicPropertiesDTO;
/**
 * MosaicDefinitionDTO class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicDefinitionDTO{
    private $mosaicId; //string

    private $supply; //int
  
    private $height; //int
  
    private $owner; //PublicAccount
  
    private $revision; //int
  
    private $properties;//MosaicPropertiesDTO 

    public function __construct(array $mosaicId,array $supply,array $height,PublicAccount $owner,int $revision,array $properties){
        $utils = new Utils;
        $this->mosaicId = $utils->bigIntToHexString($mosaicId);
        $this->supply = hexdec($utils->bigIntToHexString($supply));
        $this->height = hexdec($utils->bigIntToHexString($height));
        $this->owner = $owner;
        $this->revision = $revision;
        $this->properties = new MosaicPropertiesDTO($properties);
    }

    public function getMosaicid(){
        return  $this->getMosaicid;
    }
    
    public function getSupply(){
        return $this->supply;
    }

    public function getHeight(){
        return $this->height;
    }

    public function getOwner(){
        return $this->owner;
    }

    public function getRevision(){
        return $this->revision;
    }

    public function getProperties(){
        return $this->properties;
    }
}