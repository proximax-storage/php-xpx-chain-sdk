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
use NEM\Utils\Hex;
use NEM\Model\Transaction;
use NEM\Model\SignedTransaction;
/**
 * This is the Account class
 *
 * This class extends the NEM\Models\Model class
 * to provide with an integration of NEM's Account 
 * objects.
 * 
 * @link https://nemproject.github.io/#accountMetaDataPair
 */
class Account{
    public $keyPair;

    public $publicAccount;

    public function __construct($keyPair, $publicAccount){
        $this->keyPair = $keyPair;
        $this->publicAccount = $publicAccount;
    }

    public function sign($transaction){
        $byte_data = $transaction->generateBytes();
        $new = array_slice($byte_data,4,count($byte_data)-4);

        $signature = $this->keyPair->sign($new,"sha3-512",8);

        $p1 = array_slice($byte_data,0,4);
        $p = array_merge($p1,$signature,$this->keyPair->getPublicKey(8),$new);

        $hex = new Hex;
        $ph = $hex->EncodeToString($p);

        $trans = new Transaction;
        $h = $trans->createTransactionHash($ph);

        $signedTransaction = new SignedTransaction($transaction->abstractTransaction->type,strtoupper($ph),strtoupper($h));

        return $signedTransaction;

    }
}
