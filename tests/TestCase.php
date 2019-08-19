<?php
/**
 * Part of the Proximaxcoreprojectteam/Proximax2-sdk-php package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under MIT License.
 *
 * This source file is subject to the MIT License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Proximaxcoreprojectteam/Proximax2-sdk-php
 * @version    1.0.0
 * @author     Grégory Saive <greg@evias.be>
 * @license    MIT License
 * @copyright  (c) 2018, Proximax
 * @link       http://github.com/Proximaxcoreprojectteam/Proximax2-sdk-php
 */
namespace Proximax\Tests;

use PHPUnit\Framework\TestCase as BaseTest;
use Mockery;

abstract class TestCase 
    extends BaseTest
{
    /**
     * Setup unit test cases
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Close the mockery operator.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }
}
