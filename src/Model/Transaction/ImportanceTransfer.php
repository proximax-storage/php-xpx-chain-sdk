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

namespace NEM\Model\Transaction;

use NEM\Model\Transaction;
use NEM\Model\TransactionType;
use NEM\Model\Account;
use NEM\Model\Fee;

/**
 * ImportanceTransfer class Doc Comment
 *
 * @category class
 * @package  NEM
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ImportanceTransfer
    extends Transaction
{
    /**
     * NIS Delegated Harvesting modes.
     * 
     * @var integer
     */
    const MODE_ACTIVATE   = 1;
    const MODE_DEACTIVATE = 2;

    /**
     * List of additional fillable attributes
     *
     * @var array
     */
    protected $appends = [
        "remoteAccount" => "transaction.remoteAccount",
        "mode"          => "transaction.mode",
    ];

    /**
     * Overload of the \NEM\Core\Model::serialize() method to provide
     * with a specialization for *ImportanceTransfer* serialization.
     *
     * @see \NEM\Contracts\Serializable
     * @param   null|string $parameters    non-null will return only the named sub-dtos.
     * @return  array   Returns a byte-array with values in UInt8 representation.
     */
    public function serialize($parameters = null)
    {
        $baseTx  = parent::serialize($parameters);
        $nisData = $this->extend();

        // shortcuts
        $serializer = $this->getSerializer();
        $output     = [];

        // serialize specialized fields
        $uint8_mode = $serializer->serializeInt($nisData["mode"]);
        $uint8_acct = $serializer->serializeString(hex2bin($nisData["remoteAccount"]));

        // concatenate the UInt8 representation
        $output = array_merge(
            $uint8_mode,
            $uint8_acct);

        // specialized data is concatenated to `base transaction data`.
        return ($this->serialized = array_merge($baseTx, $output));
    }

    /**
     * The Signature transaction type does not need to add an offset to
     * the transaction base DTO.
     *
     * @return array
     */
    public function extend() 
    {
        // set default mode in case its invalid
        $mode = $this->getAttribute("mode");
        if (! $mode || ! in_array($mode, [self::MODE_ACTIVATE, self::MODE_DEACTIVATE])) {
            $mode = self::MODE_ACTIVATE;
            $this->setAttribute("mode", $mode);
        }

        return [
            "remoteAccount" => $this->remoteAccount()->publicKey,
            "mode" => $this->mode,
            // transaction type specialization
            "type"      => TransactionType::IMPORTANCE_TRANSFER,
        ];
    }

    /**
     * The extendFee() method must be overloaded by any Transaction Type
     * which needs to extend the base FEE to a custom FEE.
     *
     * @return array
     */
    public function extendFee()
    {
        return Fee::IMPORTANCE_TRANSFER;
    }

    /**
     * Mutator for the `remoteAccount` relationship.
     * 
     * @param   string      $pubKey
     */
    public function remoteAccount($pubKey = null)
    {
        return new Account(["publicKey" => $pubKey ?: $this->getAttribute("remoteAccount")]);
    }
}
