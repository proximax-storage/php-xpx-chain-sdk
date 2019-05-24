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
namespace NEM\Tests\Crypto;

use NEM\Tests\TestCase;
use NEM\Crypto\Sha3Hasher;

class Sha3HasherTest
    extends TestCase
{
    /**
     * Unit test *can hash test vectors*.
     * 
     * @dataProvider hashTestVectorsProvider
     * @return void
     */
    public function testCanHashTestVectors($algo, $rows)
    {
        foreach ($rows as $ix => $row) :
            $hexInput  = $row[0];
            $hexExpect = $row[1];

            $binData = hex2bin($hexInput);
            $hexOutput = Sha3Hasher::hash($algo, $binData, false);

            $this->assertEquals($hexExpect, strtoupper($hexOutput));
        endforeach;
    }

    /**
     * Data provider for the testCanHashTestVectors
     * 
     * @return array
     */
    public function hashTestVectorsProvider()
    {
        return [
            ['sha3-256', [
                ['', 'A7FFC6F8BF1ED76651C14756A061D662F580FF4DE43B49FA82D80A4B80F8434A'],
                ['CC', '677035391CD3701293D385F037BA32796252BB7CE180B00B582DD9B20AAAD7F0'],
                ['41FB', '39F31B6E653DFCD9CAED2602FD87F61B6254F581312FB6EEEC4D7148FA2E72AA'],
                ['1F877C', 'BC22345E4BD3F792A341CF18AC0789F1C9C966712A501B19D1B6632CCD408EC5'],
                ['C1ECFDFC', 'C5859BE82560CC8789133F7C834A6EE628E351E504E601E8059A0667FF62C124'],
                ['9F2FCC7C90DE090D6B87CD7E9718C1EA6CB21118FC2D5DE9F97E5DB6AC1E9C10',
                '2F1A5F7159E34EA19CDDC70EBF9B81F1A66DB40615D7EAD3CC1F1B954D82A3AF']
            ]],
            ['sha3-512', [
                ['', 'A69F73CCA23A9AC5C8B567DC185A756E97C982164FE25859E0D1DCC1475C80A615B2123AF1F5F94C11E3E9402C3AC558F500199D95B6D3E301758586281DCD26'],
                ['CC', '3939FCC8B57B63612542DA31A834E5DCC36E2EE0F652AC72E02624FA2E5ADEECC7DD6BB3580224B4D6138706FC6E80597B528051230B00621CC2B22999EAA205'],
                ['41FB', 'AA092865A40694D91754DBC767B5202C546E226877147A95CB8B4C8F8709FE8CD6905256B089DA37896EA5CA19D2CD9AB94C7192FC39F7CD4D598975A3013C69'],
                ['1F877C', 'CB20DCF54955F8091111688BECCEF48C1A2F0D0608C3A575163751F002DB30F40F2F671834B22D208591CFAF1F5ECFE43C49863A53B3225BDFD7C6591BA7658B'],
                ['C1ECFDFC', 'D4B4BDFEF56B821D36F4F70AB0D231B8D0C9134638FD54C46309D14FADA92A2840186EED5415AD7CF3969BDFBF2DAF8CCA76ABFE549BE6578C6F4143617A4F1A'],
                ['9F2FCC7C90DE090D6B87CD7E9718C1EA6CB21118FC2D5DE9F97E5DB6AC1E9C10',
                'B087C90421AEBF87911647DE9D465CBDA166B672EC47CCD4054A7135A1EF885E7903B52C3F2C3FE722B1C169297A91B82428956A02C631A2240F12162C7BC726']
            ]],
        ];
    }

}
