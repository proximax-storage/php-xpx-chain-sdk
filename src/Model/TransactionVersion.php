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
 * This is the TransactionVersion class
 *
 * This class defines the valid Transaction Versions
 * on the NEM network.
 * 
 * @link https://nemproject.github.io/
 */
class TransactionVersion
{    
    
    /**
     * @internal
     * @var integer
     */
    const ACCOUNT_PROPERTY_ADDRESS_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const ACCOUNT_PROPERTY_MOSAIC_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const ACCOUNT_PROPERTY_ENTITY_TYPE_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const ADDRESS_ALIAS_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const AGGREGATE_BONDED_VERSION = 2;

    /**
     * @internal
     * @var integer
     */
    const AGGREGATE_COMPLETED_VERSION = 2;

    /**
     * @internal
     * @var integer
     */
    const LINK_ACCOUNT_VERSION = 2;

    /**
     * @internal
     * @var integer
     */
    const LOCK_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const METADATA_ADDRESS_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const METADATA_MOSAIC_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const METADATA_NAMESPACE_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const MODIFY_CONTRACT_VERSION = 3;
    /**
     * @internal
     * @var integer
     */
    const MODIFY_MULTISIG_VERSION = 3;
    /**
     * @internal
     * @var integer
     */
    const MOSAIC_ALIAS_VERSION = 1;
    /**
     * @internal
     * @var integer
     */
    const MOSAIC_DEFINITION_VERSION = 3;
    /**
     * @internal
     * @var integer
     */
    const MOSAIC_SUPPLY_CHANGE_VERSION = 2;
    /**
     * @internal
     * @var integer
     */
    const REGISTER_NAMESPACE_VERSION = 2;
    /**
     * @internal
     * @var integer
     */
    const SECRET_LOCK_VERSION = 1;
    /**
     * @internal
     * @var integer
     */
    const SECRET_PROOF_VERSION = 1;

    /**
     * @internal
     * @var integer
     */
    const TRANSFER_VERSION = 3;

}
