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
use Josantonius\ErrorHandler\Exceptions\ErrorException;

class ErrorExceptionTest extends TestCase
{
    private ErrorException $errorException;

    public function setUp(): void
    {
        parent::setUp();

        $errorHandled = new ErrorHandled(
            E_ERROR,
            'Error message',
            'Error.php',
            8,
            'Error'
        );

        $this->errorException = new ErrorException($errorHandled);
    }

    public function testShouldGetFile(): void
    {
        $this->assertEquals('Error.php', $this->errorException->getFile());
    }

    public function testShouldGetMessage(): void
    {
        $this->assertEquals('Error message', $this->errorException->getMessage());
    }

    public function testShouldGetLevel(): void
    {
        $this->assertEquals(E_ERROR, $this->errorException->getLevel());
    }

    public function testShouldGetLine(): void
    {
        $this->assertEquals(8, $this->errorException->getLine());
    }

    public function testShouldGetName(): void
    {
        $this->assertEquals('Error', $this->errorException->getName());
    }
}
