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

/**
 * This is the TransactionType class
 *
 * This class defines the valid Transaction Types
 * on the NEM network.
 * 
 * @link https://nemproject.github.io/
 */
class TransactionType
{    
    /**
     * @internal
     * @var integer
     */
    const ACCOUNT_PROPERTY_ADDRESS = "4150"; // 16720

    /**
     * @internal
     * @var integer
     */
    const ACCOUNT_PROPERTY_MOSAIC = "4250"; // 16976

    /**
     * @internal
     * @var integer
     */
    const ACCOUNT_PROPERTY_ENTITY_TYPE = "4350"; // 17232

    /**
     * @internal
     * @var integer
     */
    const ADDRESS_ALIAS = "424e"; // 16974

    /**
     * @internal
     * @var integer
     */
    const AGGREGATE_BONDED = "4241"; // 16961

    /**
     * @internal
     * @var integer
     */
    const AGGREGATE_COMPLETED = "4141"; // 16705

    /**
     * @internal
     * @var integer
     */
    const LINK_ACCOUNT = "414c"; // 16716

    /**
     * @internal
     * @var integer
     */
    const LOCK = "4148"; // 16712

    /**
     * @internal
     * @var integer
     */
    const METADATA_ADDRESS = "413d"; // 16701

    /**
     * @internal
     * @var integer
     */
    const METADATA_MOSAIC = "423d"; // 16957

    /**
     * @internal
     * @var integer
     */
    const METADATA_NAMESPACE = "433d"; // 17213

    /**
     * @internal
     * @var integer
     */
    const MODIFY_CONTRACT = "4157"; // 16727
    /**
     * @internal
     * @var integer
     */
    const MODIFY_MULTISIG = "4155"; // 16725
    /**
     * @internal
     * @var integer
     */
    const MOSAIC_ALIAS = "434e"; // 17230
    /**
     * @internal
     * @var integer
     */
    const MOSAIC_DEFINITION = "414d"; // 16717
    /**
     * @internal
     * @var integer
     */
    const MOSAIC_SUPPLY_CHANGE = "424d"; // 16973
    /**
     * @internal
     * @var integer
     */
    const REGISTER_NAMESPACE = "414e"; // 16718
    /**
     * @internal
     * @var integer
     */
    const SECRET_LOCK = "4152"; // 16722
    /**
     * @internal
     * @var integer
     */
    const SECRET_PROOF = "4252"; // 16978

    /**
     * @internal
     * @var integer
     */
    const TRANSFER = "4154"; // 16724

}
