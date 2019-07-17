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

use NEM\Utils\Utils;
/**
 * This is the Mosaic class
 *
 * This class extends the NEM\Models\Model class
 * to provide with an integration of NEM's Mosaic 
 * objects.
 * 
 * @link https://nemproject.github.io/#mosaicId
 */

class Mosaic{

    public $id; //big Int

    public $amount;//big Int

    public function __construct(string $name = null,int $amount = null){
        $utils = new Utils;
        if ($name === null || $name == "xpx"){
            $this->id = array(481110499,231112638); //xpx id
        }
        else throw new Exception("Wrong mosaic name");
        
        if ($amount === null){
            $this->amount = array(0,0);
        }
        else {
            $this->amount = $utils->fromBigInt($amount);
        }
    }
    
    public function getIdValue(){
        $utils = new Utils;
        return $utils->bigIntToHexString($this->id);
    }

    public function getAmountValue(){
        return  ($this->amount[1] << 32) | $this->amount[0];
    }
}
