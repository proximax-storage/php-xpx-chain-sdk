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

/**
 * MosaicProperties class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class MosaicProperties{
    /** flag indicating that mosaic supply is mutable */
   const FLAG_SUPPLY_MUTABLE = 1;
   /** flag indicating that mosaic ownership is transferable */
   const FLAG_TRANSFERABLE = 2;

   /**
    * The creator can choose between a definition that allows a mosaic supply change at a later point or an immutable
    * supply. Allowed values for the property are "true" and "false". The default value is "false".
    */
   private $supplyMutable;
   /**
    * The creator can choose if the mosaic definition should allow for transfers of the mosaic among accounts other than
    * the creator. If the property 'transferable' is set to "false", only transfer transactions having the creator as
    * sender or as recipient can transfer mosaics of that type. If set to "true" the mosaics can be transferred to and
    * from arbitrary accounts. Allowed values for the property are thus "true" and "false". The default value is "true".
    */
   private $transferable;
   /**
    * The divisibility determines up to what decimal place the mosaic can be divided into. Thus a divisibility of 3
    * means that a mosaic can be divided into smallest parts of 0.001 mosaics i.e. milli mosaics is the smallest
    * sub-unit. When transferring mosaics via a transfer transaction the quantity transferred is given in multiples of
    * those smallest parts. The divisibility must be in the range of 0 and 6. The default value is "0".
    */
   private $divisibility;
   /**
    * The duration in blocks a mosaic will be available. After the duration finishes mosaic is inactive and can be
    * renewed. Duration is optional when defining the mosaic
    */
   private $duration;

    public function __construct($supplyMutable, $transferable, $divisibility, $duration){
        $this->supplyMutable = $supplyMutable;
        $this->transferable = $transferable;
        $this->divisibility = $divisibility;
        $this->duration = $duration;
    }

    public function isSupplyMutable(){
        return $this->supplyMutable;
    }
    
    public function isTransferable(){
        return $this->transferable;
    }

    public function getDivisibility(){
        return $this->divisibility;
    }

    public function getDuration(){
        return $this->duration;
    }
}