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

namespace Proximax\Model\Transaction\Schema;
use Proximax\Model\Transaction\Attribute\ScalarAttribute;
use Proximax\Model\Transaction\Attribute\ArrayAttribute;
use Proximax\Model\Transaction\Attribute\TableArrayAttribute;
use Proximax\Model\Transaction\Constants;

/**
 * RegisterNamespaceTransactionSchema class Doc Comment
 *
 * @category class
 * @package  Proximax
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class RegisterNamespaceTransactionSchema extends Schema{
    public function __construct() {
        $arr = array(
            new ScalarAttribute("size", Constants::SIZEOF_INT),
            new ArrayAttribute("signature", Constants::SIZEOF_BYTE),
            new ArrayAttribute("signer", Constants::SIZEOF_BYTE),
            new ScalarAttribute("version", Constants::SIZEOF_INT),
            new ScalarAttribute("type", Constants::SIZEOF_SHORT),
            new ArrayAttribute("fee", Constants::SIZEOF_INT),
            new ArrayAttribute("deadline", Constants::SIZEOF_INT),
            new ScalarAttribute("namespaceType", Constants::SIZEOF_BYTE),
            new ArrayAttribute("durationParentId", Constants::SIZEOF_INT),
            new ArrayAttribute("namespaceId", Constants::SIZEOF_INT),
            new ScalarAttribute("namespaceNameSize", Constants::SIZEOF_BYTE),
            new ArrayAttribute("name", Constants::SIZEOF_BYTE)
        );
        parent::__construct($arr);
    }
}
?>