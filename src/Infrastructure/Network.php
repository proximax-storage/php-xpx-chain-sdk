<?php
/**
 * Part of the evias/nem-php package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under MIT License.
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    evias/nem-php
 * @version    1.0.0
 * @author     Grégory Saive <greg@evias.be>
 * @author     Robin Pedersen (https://github.com/RobertoSnap)
 * @license    MIT License
 * @copyright  (c) 2017-2018, Grégory Saive <greg@evias.be>
 * @link       http://github.com/evias/nem-php
 */
namespace NEM\Infrastructure;

use NEM\Models\Address;
use NEM\Errors\NISInvalidAddressFormat;
use NEM\Errors\NISInvalidNetworkId;

/**
 * This is the Network Infrastructure service
 *
 * This service implements API endpoints of the NEM
 * Infrastructure.
 * 
 * @internal This class is currently *not* unit tested.
 *           Parts of this class may be malfunctioning or 
 *           not working all.
 */
class Network
    
{
    /**
     * Array of available networks by name.
     *
     * @var array 
     */
    static public $networkInfos = [
        "mijin" => [
            "id"   => 96,
            "hex"  => "60"
        ],
        "mijintest" =>  [
            "id"   => 144,
            "hex"  => "90"
        ],
        "public"   =>  [
            "id"   => 184,
            "hex"  => "B8"
        ],
        "publictest" => [
            "id"   => 168,
            "hex"  => "A8"
        ],
        "private" =>  [
            "id"   => 200,
            "hex"  => "C8"
        ],
        "privatetest"   =>  [
            "id"   => 176,
            "hex"  => "B0"
        ],
        "NotSupportedNet" =>  [
            "id"   => 0,
            "hex"  => "0"
        ],
        "aliasaddress"   =>  [
            "id"   => 145,
            "hex"  => "91"
        ],
    ];

    /**
     * Load a NetworkInfo object from an `address`.
     *
     * @param   string|\NEM\Models\Address  $address
     * @return  \NEM\Models\Model
     * @throws  \InvalidArgumentException     On invalid address format or unrecognized address first character.
     */
    static public function fromAddress($address)
    {
        if ($address instanceof Address) {
            $addr = $address->toClean();
            $prefix = substr($addr, 0, 1);
        }
        elseif (is_string($address)) {
            $prefix = substr($address, 0, 1);
        }
        else {
            throw new \InvalidArgumentException("Could not identify address format: " . var_export($address, true));
        }

        foreach (self::$networkInfos as $name => $spec) {
            $netChar = $spec['char'];

            if ($prefix == $netChar)
                return $spec["id"];
        }

        throw new \InvalidArgumentException("Could not identify network from provided address: " . var_export($address, true));
    }

    /**
     * Helper to get a network address prefix hexadecimal representation
     * from a network id.
     *
     * @param   integer     $networkId
     * @return  string 
     */
    static public function getPrefixFromId($networkId)
    {
        foreach (self::$networkInfos as $name => $spec) {
            if ($networkId === $spec['id'])
                return $spec['hex'];
        }

        throw new NISInvalidNetworkId("Network Id '" . $networkId . "' is invalid.");
    }

    /**
     * Helper to load a network field from a given `networkId`.
     * 
     * @param   integer     $networkId
     * @param   string      $field          Defaults to "name".
     * @return  null|string|integer
     */
    static public function getFromId($networkId, $field = "name")
    {
        foreach (self::$networkInfos as $name => $spec) {
            if ($spec["id"] !== (int) $networkId) continue;

            if ($field === "name")
               return $name;
            elseif (in_array($field, array_keys($spec)))
                return $spec[$field];
            else
                // Field not recognized
                return null;
        }

        // Network ID not recognized
        return null;
    }

    /**
     * Get id from name
     * 
     * @param   string      $name
     * @return  null|string|integer
     */
    static public function getIdfromName($name)
    {
        $networkName = strtolower($name);
        if (self::$networkInfos[$networkName]){
            return self::$networkInfos[$networkName]["id"];
        }
        else return null;
    }
}
