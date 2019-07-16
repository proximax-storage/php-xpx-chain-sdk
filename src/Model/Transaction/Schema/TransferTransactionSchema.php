<?php
namespace NEM\Model\Transaction\Schema;
use NEM\Model\Transaction\Attribute\ScalarAttribute;
use NEM\Model\Transaction\Attribute\ArrayAttribute;
use NEM\Model\Transaction\Attribute\TableArrayAttribute;
use NEM\Model\Transaction\Attribute\TableAttribute;
use NEM\Model\Transaction\Constants;

class TransferTransactionSchema extends Schema{
    public function __construct() {
        $arr = array(
            new ScalarAttribute("size",Constants::SIZEOF_INT),
            new ArrayAttribute("signature", Constants::SIZEOF_BYTE),
            new ArrayAttribute("signer", Constants::SIZEOF_BYTE),
            new ScalarAttribute("version", Constants::SIZEOF_SHORT),
            new ScalarAttribute("type", Constants::SIZEOF_SHORT),
            new ArrayAttribute("fee", Constants::SIZEOF_INT),
            new ArrayAttribute("deadline", Constants::SIZEOF_INT),
            
            new ArrayAttribute("recipient", Constants::SIZEOF_BYTE),
            new ScalarAttribute("messageSize", Constants::SIZEOF_SHORT),
            new ScalarAttribute("numMosaics", Constants::SIZEOF_BYTE),
            new TableAttribute("message", array(
                    new ScalarAttribute("type", Constants::SIZEOF_BYTE),
                    new ArrayAttribute("payload", Constants::SIZEOF_BYTE)
            )),
            new TableArrayAttribute("mosaics", array(
                    new ArrayAttribute("id", Constants::SIZEOF_INT),
                    new ArrayAttribute("amount", Constants::SIZEOF_INT)
            ))
        );
        parent::__construct($arr);
    }
}
?>