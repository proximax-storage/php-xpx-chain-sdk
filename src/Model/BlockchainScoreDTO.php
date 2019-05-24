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

namespace NEM\Model;

use \ArrayAccess;
use \NEM\ObjectSerializer;

/**
 * BlockchainScoreDTO Class Doc Comment
 *
 * @category Class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BlockchainScoreDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'BlockchainScoreDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'scoreHigh' => '\NEM\Model\UInt64DTO',
        'scoreLow' => '\NEM\Model\UInt64DTO'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'scoreHigh' => null,
        'scoreLow' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'scoreHigh' => 'scoreHigh',
        'scoreLow' => 'scoreLow'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'scoreHigh' => 'setScoreHigh',
        'scoreLow' => 'setScoreLow'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'scoreHigh' => 'getScoreHigh',
        'scoreLow' => 'getScoreLow'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['scoreHigh'] = isset($data['scoreHigh']) ? $data['scoreHigh'] : null;
        $this->container['scoreLow'] = isset($data['scoreLow']) ? $data['scoreLow'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['scoreHigh'] === null) {
            $invalidProperties[] = "'scoreHigh' can't be null";
        }
        if ($this->container['scoreLow'] === null) {
            $invalidProperties[] = "'scoreLow' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        if ($this->container['scoreHigh'] === null) {
            return false;
        }
        if ($this->container['scoreLow'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets scoreHigh
     *
     * @return \NEM\Model\UInt64DTO
     */
    public function getScoreHigh()
    {
        return $this->container['scoreHigh'];
    }

    /**
     * Sets scoreHigh
     *
     * @param \NEM\Model\UInt64DTO $scoreHigh scoreHigh
     *
     * @return $this
     */
    public function setScoreHigh($scoreHigh)
    {
        $this->container['scoreHigh'] = $scoreHigh;

        return $this;
    }

    /**
     * Gets scoreLow
     *
     * @return \NEM\Model\UInt64DTO
     */
    public function getScoreLow()
    {
        return $this->container['scoreLow'];
    }

    /**
     * Sets scoreLow
     *
     * @param \NEM\Model\UInt64DTO $scoreLow scoreLow
     *
     * @return $this
     */
    public function setScoreLow($scoreLow)
    {
        $this->container['scoreLow'] = $scoreLow;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


