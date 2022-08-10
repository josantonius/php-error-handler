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
use Josantonius\ErrorHandler\ErrorHandler;
use Josantonius\ErrorHandler\Exceptions\WrongErrorLevelException;
use ReflectionClass;

class ConvertToExceptionsExceptTest extends TestCase
{
    private array $errorLevels;

    private ErrorHandler $errorHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->errorHandler = new ErrorHandler();

        $this->errorLevels = $this->getPrivateProperty($this->errorHandler, 'errorLevels');
    }

    public function testShouldSetConvertToExceptionsAllErrorsExceptNone(): void
    {
        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler->convertToExceptionsExcept()
        );

        $exceptionable = $this->getPrivateProperty($this->errorHandler, 'exceptionable');

        $this->assertSame(array_keys($this->errorLevels), $exceptionable);
    }

    public function testShouldSetConvertToExceptionsAllErrorsExceptSome(): void
    {
        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler->convertToExceptionsExcept(E_ERROR, E_PARSE)
        );

        unset($this->errorLevels[E_ERROR], $this->errorLevels[E_PARSE]);

        $exceptionable = $this->getPrivateProperty($this->errorHandler, 'exceptionable');

        $this->assertSame(array_keys($this->errorLevels), $exceptionable);
    }

    public function testShouldFailIfTheErrorLevelPassedToConvertToExceptionsExceptIsWrong(): void
    {
        $this->expectException(WrongErrorLevelException::class);

        $this->errorHandler->convertToExceptionsExcept(E_WARNING, 101200);
    }

    private function getPrivateProperty(ErrorHandler $object, string $property): mixed
    {
        $reflection = new ReflectionClass($object);

        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }
}
