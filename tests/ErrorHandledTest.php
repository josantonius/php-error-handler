<?php

/*
* This file is part of https://github.com/josantonius/php-error-handler repository.
*
* (c) Josantonius <hello@josantonius.dev>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Josantonius\ErrorHandler\Tests\ErrorHandler;

use PHPUnit\Framework\TestCase;
use Josantonius\ErrorHandler\ErrorHandled;

class ErrorHandledTest extends TestCase
{
    private ErrorHandled $errorHandled;

    public function setUp(): void
    {
        parent::setUp();

        $this->errorHandled = new ErrorHandled(
            E_ERROR,
            'Error message',
            'Error.php',
            8,
            'Error'
        );
    }

    public function testShouldGetFile(): void
    {
        $this->assertEquals('Error.php', $this->errorHandled->getFile());
    }

    public function testShouldGetMessage(): void
    {
        $this->assertEquals('Error message', $this->errorHandled->getMessage());
    }

    public function testShouldGetLevel(): void
    {
        $this->assertEquals(E_ERROR, $this->errorHandled->getLevel());
    }

    public function testShouldGetLine(): void
    {
        $this->assertEquals(8, $this->errorHandled->getLine());
    }

    public function testShouldGetName(): void
    {
        $this->assertEquals('Error', $this->errorHandled->getName());
    }
}
