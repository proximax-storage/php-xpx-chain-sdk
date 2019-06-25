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
 * This is the Ripemd160Hasher class
 *
 * This class currently only defines a `hash()` method 
 * which allows one of: ripemd160
 * hash algorithms to be used.
 * 
 * This class uses the PHP implementation for Ripemd160,
 */
class Ripemd160Hasher
{
    /**
     * Non-Incremental RIPEMD160 Hash implementation.
     * 
     * @param   string|\NEM\Core\Buffer $data           The data that needs to be hashed.
     * @param   boolean                 $raw_output     Whether to return raw data or a Hexadecimal hash.
     * @return  string
     */
    static public function hash($data, $raw_output = false)
    {
        // use PHP implementation of sha3
        return hash("ripemd160", $data, (bool) $raw_output);
    }
}
