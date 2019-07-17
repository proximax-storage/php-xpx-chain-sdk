<?php
namespace NEM\Model;

use NEM\Errors\NISInvalidNetworkName;
use NEM\Errors\NISInvalidNetworkId;
use NEM\Errors\NISInvalidPublicKeyFormat;
use NEM\Infrastructure\Network;
use NEM\Contracts\KeyPair;
use NEM\Core\Buffer;
use NEM\Core\Encoder;
use NEM\Core\Encryption;
use kornrunner\Keccak;
use Base32\Base32;


class Address{
    /**
     * The number of characters of a NEM Address.
     *
     * @var integer
     */
    const BYTES = 40;


    public $networkType; //int

    public $address;// string

    public function __construct($address, $networkType){
        if ($address == null){
            throw new Exception("Address not null");
        }
        if ($networkType == null){
            throw new Exception("Network Type not null");
        }
        if (is_string($networkType) && in_array(strtolower($networkType), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])){
            $networkType = Network::$networkInfos[strtolower($networkType)]["id"];
        }
        $address = str_replace("-","",$address);
        $address = trim($address);
        $address = strtoupper($address);
        $this->address = $address;
        $this->networkType = dechex($networkType);
        if ($networkType == 168 && $address[0] != "V"){
            throw new Exception("PublicTest Address must start with V");
        }
        else if ($networkType == 184 && $address[0] != "X"){
            throw new Exception("Public Address must start with X");
        }
        else if ($networkType == 96 && $address[0] != "M"){
            throw new Exception("Mijin Address must start with M");
        }
        else if ($networkType == 144 && $address[0] != "S"){
            throw new Exception("MijinTest Address must start with S");
        }
        else if ($networkType == 200 && $address[0] != "Z"){
            throw new Exception("Private Address must start with Z");
        }
        else if ($networkType == 176 && $address[0] != "W"){
            throw new Exception("PrivateTest Address must start with W");
        }
    }
    
    /**
     * Generate an address corresponding to a `publicKey`
     * public key.
     *
     * The `publicKey` parameter can be either a hexadecimal
     * public key representation, a byte level representation
     * of the public key, a Buffer object or a KeyPair object.
     *
     * @param   mixed           $publicKey
     * @param   string|integer  $networkId        A network ID OR a network name. (default mainnet)
     * @return  \NEM\Models\Address
     * @throws  \NEM\Errors\NISInvalidPublicKeyFormat   On unidentifiable public key format.
     * @throws  \NEM\Errors\NISInvalidNetworkName       On invalid network name provided in `version` (when string).
     * @throws  \NEM\Errors\NISInvalidVersionByte       On invalid network byte provided in `version` (when integer).
     */
    static public function fromPublicKey($publicKey, $networkId = 168) // 168 = public test
    {
        // discover public key content
        if ($publicKey instanceof Buffer) {
            $pubKeyBuf = $publicKey; // Buffer to public key
        }
        elseif ($publicKey instanceof KeyPair) {
            $pubKeyBuf = $publicKey->getPublicKey(null); // Keypair to public key
        }
        elseif (is_string($publicKey) && ctype_xdigit($publicKey)) {
            $pubKeyBuf = Buffer::fromHex($publicKey, 32); // Hexadecimal to public key
        }
        elseif (is_string($publicKey) && mb_strlen($publicKey) === 32) {
            $pubKeyBuf = new Buffer($publicKey, 32); // Binary to public key
        }
        else {
            throw new NISInvalidPublicKeyFormat("Could not identify public key format: " . var_export($publicKey, true));
        }

        // discover network name / version byte
        if (is_string($networkId) && !is_numeric($networkId) 
            && in_array(strtolower($networkId), ["mijin", "mijintest", "public", "publictest", "private", "privatetest", "NotSupportedNet", "aliasaddress"])) {
            // network name provided, read version byte from SDK
            $networkId = Network::$networkInfos[strtolower($networkId)]["id"];
        }
        elseif (is_numeric($networkId) && !in_array($networkId, [96, 144, 184, 168, 200, 176, 0, 145])) {
            throw new NISInvalidNetworkId("Invalid netword ID '" . $networkId . "'");
        }
        // network name / version byte is important for address creation
        elseif (is_string($networkId)) {
            throw new NISInvalidNetworkName("Invalid network name '" . $networkId . "'");
        }

        // step 1: keccak-256 hash of the public key
        $pubKeyHash = Encryption::hash("sha3-256", $pubKeyBuf->getBinary(), true); // raw=true

        // step 2: ripemd160 hash of (1)
        $pubKeyRiped = new Buffer(hash("ripemd160", $pubKeyHash, true), 20);

        // step 3: add version byte in front of (2)
        $networkPrefix = Network::getPrefixFromId($networkId);
        $versionPrefixedPubKey = Buffer::fromHex($networkPrefix . $pubKeyRiped->getHex());

        // step 4: get the checksum of (3)
        $checksum = Encryption::checksum("sha3-256", $versionPrefixedPubKey, 4); // checksumLen=4

        // step 5: concatenate (3) and (4)
        $addressHash = $versionPrefixedPubKey->getHex() . $checksum->getHex();
        $hashBuf = Buffer::fromHex($addressHash);
        $encodedAddress = hex2bin($addressHash);

        // step 6: base32 encode (5)
        $encodedBase32  = new Buffer(Base32::encode($encodedAddress), Address::BYTES);

        return new Address($encodedBase32->getBinary(),$networkId);
    }

    /**
     * Helper to clean an address of any non alpha-numeric characters
     * back to the actual Base32 representation of the address.
     *
     * @return string
     */
    public function toClean($string = null)
    {
        return $this->address;
    }

    /**
     * Helper to add dashes to Base32 address representations.
     *
     * @return string
     */
    public function toPretty()
    {
        $clean = $this->toClean();
        return trim(chunk_split($clean, 6, '-'), " -");
    }
    public function getDecByte(){
        $tmp = unpack("C*",$this->address);
        return array_slice($tmp,0,count($tmp));
    }
}
