<?php
/**
 * Part of the nemcoreprojectteam/nem2-sdk-php package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under MIT License.
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    nemcoreprojectteam/nem2-sdk-php
 * @version    1.0.0
 * @author     Grégory Saive <greg@evias.be>
 * @license    MIT License
 * @copyright  (c) 2018, NEM
 * @link       http://github.com/nemcoreprojectteam/nem2-sdk-php
 */
namespace NEM\Crypto;

use NEM\Core\Buffer;

/**
 * This is the Sha3Hasher class
 *
 * This class currently only defines a `hash()` method 
 * which allows one of: sha3-512, sha3-384, sha3-256 
 * hash algorithms to be used.
 * 
 * This class uses the PHP implementation for SHA3,
 * this class does not use Keccak!
 */
class Sha3Hasher
{
    /**
     * Constant for Default Hash Bit Length.
     * 
     * @var integer
     */
    const HASH_BIT_LENGTH = 512;

    /**
     * List of available hash bit length for the SHA3
     * hashes.
     * 
     * @var array
     */
    static public $hashBits = [256, 384, 512];

    /**
     * Non-Incremental SHA3 Hash implementation.
     * 
     * @param   null|string|integer     $algorithm      The hashing algorithm or Hash Bit Length.
     * @param   string|\NEM\Core\Buffer $data           The data that needs to be hashed.
     * @param   boolean                 $raw_output     Whether to return raw data or a Hexadecimal hash.
     * @return  string
     */
    static public function hash($algorithm, $data, $raw_output = false)
    {
        $hashBits = self::getHashBitLength($algorithm);

        // use PHP implementation of sha3
        return hash("sha3-" . $hashBits, $data, (bool) $raw_output);
    }

    /**
     * Helper function used to determine each hash's Bits length
     * by a given `algorithm`.
     * 
     * The `algorithm` parameter can be a integer directly and should
     * then represent a Bits Length for generated Hashes.
     * 
     * @param   null|string|integer     $algorithm      The hashing algorithm or Hashes' Bits Length.
     * @return  integer
     */
    static public function getHashBitLength($algorithm = null)
    {
        if (!$algorithm) {
            return self::HASH_BIT_LENGTH;
        }

        if (is_integer($algorithm)) {
            // direct hash-bit-length provided
            return (int) $algorithm;
        }
        elseif (strpos(strtolower($algorithm), "sha3-") !== false) {
            $bits = (int) substr($algorithm, -3); // sha3-256, sha3-512, etc.

            if (! in_array($bits, [256, 228, 384, 512])) {
                // use sha3-512 if unsupported bitlength
                $bits = 512;
            }

            return $bits;
        }

        return self::HASH_BIT_LENGTH;
    }
}
