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

use kornrunner\Keccak;
use NEM\Core\Buffer;

/**
 * This is the KeccakHasher class
 *
 * This class currently only defines a `hash()` method 
 * which allows one of: keccak-512, keccak-384, keccak-256
 * and keccak-228 hash algorithms to be used.
 * 
 * PHP Extensions strawbrary/php-sha3 and archwisp/php-keccak-hash
 * prevail over installed dependency kornrunner/Keccak. This ensures
 * better performance whenever the C module for Keccak is installed.
 */
class KeccakHasher
{
    /**
     * Constant for Default Hash Bit Length.
     * 
     * @var integer
     */
    const HASH_BIT_LENGTH = 512;

    /**
     * List of available hash bit length for the Keccak
     * hashes.
     * 
     * @var array
     */
    static public $hashBits = [228, 256, 384, 512];

    /**
     * Non-Incremental Keccak Hash implementation.
     * 
     * @param   null|string|integer     $algorithm      The hashing algorithm or Hash Bit Length.
     * @param   string                  $data           The data that needs to be hashed.
     * @param   boolean                 $raw_output     Whether to return raw data or a Hexadecimal hash.
     * @return  string
     */
    static public function hash($algorithm, $data, $raw_output = false)
    {
        $hashBits = self::getHashBitLength($algorithm);

        if (function_exists("sha3")) {
            // use extension https://github.com/strawbrary/php-sha3
            return sha3($data, (int) $hashBits, (bool) $raw_output);
        }
        elseif (function_exists("keccak_hash")) {
            // use extension archwisp/php-keccak-hash
            $raw = keccak_hash($data, (int) $hashBits);
            return $raw_output ? $raw : bin2hex($raw); // Hexadecimal output
        }

        // use dependency kornrunner/keccak
        return Keccak::hash($data, (int) $hashBits, (bool) $raw_output);
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
        elseif (strpos(strtolower($algorithm), "keccak-") !== false) {
            $bits = (int) substr($algorithm, -3); // keccak-256, keccak-512, etc.

            if (! in_array($bits, self::$hashBits)) {
                // use keccak-512 if unsupported bitlength
                $bits = 512;
            }

            return $bits;
        }

        return self::HASH_BIT_LENGTH;
    }
}
