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
namespace NEM\Model;

use NEM\Core\Encryption as CryptoHelper;
use RuntimeException;

/**
 * This is the Message class
 *
 * This class extends the NEM\Models\Model class
 * to provide with an integration of NEM's message 
 * payload objects.
 * 
 * @link https://nemproject.github.io/#transaction-data-with-decoded-messages
 */
class Message{
    /**
     * @internal
     * @var integer
     */
    public const TYPE_HEX = 0;

    /**
     * @internal
     * @var integer
     */
    public const TYPE_SIMPLE = 1;

    /**
     * @internal
     * @var integer
     */
    public const TYPE_ENCRYPTED = 2;

    public $type; //int

    public $payload; // array

    public $string; //string

    public function __construct($message = "",$type = null){
        $this->string = $message;
        $tmp = unpack('C*', $message);
        $this->payload = array_slice($tmp,0,count($tmp));
        if ($type !== null){
            $this->type = $type;
        }
        else $this->type = self::TYPE_HEX;
    }

    /**
     * Helper to retrieve the hexadecimal representation of a message.
     *
     * @return string
     */
    public function toHex($prefixHexContent = false)
    {
        $chars = $this->getPlain();
        if ($prefixHexContent && ctype_xdigit($chars)) {
            return "fe" . $chars;
        }

        $payload = "";
        for ($c = 0, $cnt = strlen($chars); $c < $cnt; $c++ ) {
            $decimal = ord($chars[$c]);
            $hexCode = dechex($decimal);

            // payload is built of *hexits*
            $payload .= str_pad($hexCode, 2, "0", STR_PAD_LEFT);
        }

        $this->payload = strtolower($payload);
        return $this->payload;
    }

    /**
     * Helper to retrieve the UTF8 representation of a message
     * payload (hexadecimal representation).
     *
     * @return string
     */
    public function toPlain($hex = null)
    {
        if (empty($this->payload) && empty($hex))
            return "";

        $plain = "";
        $payload = $hex ?: $this->payload;
        for ($c = 0, $cnt = strlen($payload); $c < $cnt; $c += 2) {
            $hex = substr($payload, $c, 2);
            $decimal = hexdec($hex);
            $plain  .= chr($decimal);
        }

        return ($this->plain = $plain);
    }

    /**
     * Setter for the plaintext content of a NEM Message.
     * 
     * @param   string  $plain
     * @return  \NEM\Models\Message
     */
    public function setPlain($plain)
    {
        $this->plain = $plain;
        return $this;
    }

    /**
     * Getter for the plaintext content of a NEM Message.
     * 
     * @param   string  $plain
     * @return  \NEM\Models\Message
     */
    public function getPlain()
    {
        return $this->plain;
    }

    public function stringToPayload(){
        for ($i=0;$i<strlen($this->string);$i++){
            $arr[$i] = bin2hex($this->string[$i]);
        }
        return $arr;
    }
}