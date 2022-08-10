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

class ConvertToExceptionsTest extends TestCase
{
    private array $errorLevels;

    private ErrorHandler $errorHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->errorHandler = new ErrorHandler();

        $this->errorLevels = $this->getPrivateProperty($this->errorHandler, 'errorLevels');
    }

    public function testShouldSetConvertToExceptionsAllErrors(): void
    {
        $this->assertInstanceOf(ErrorHandler::class, $this->errorHandler->convertToExceptions());

        $exceptionable = $this->getPrivateProperty($this->errorHandler, 'exceptionable');

        $this->assertSame(array_keys($this->errorLevels), $exceptionable);
    }

    public function testShouldSetConvertToExceptionsSomeErrors(): void
    {
        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler->convertToExceptions(E_WARNING, E_NOTICE)
        );

        $exceptionable = $this->getPrivateProperty($this->errorHandler, 'exceptionable');

        $this->assertSame([E_WARNING, E_NOTICE], $exceptionable);
    }

    public function testShouldFailIfTheErrorLevelPassedToConvertToExceptionsIsWrong(): void
    {
        $this->expectException(WrongErrorLevelException::class);

        $this->errorHandler->convertToExceptions(E_WARNING, 101200);
    }

    private function getPrivateProperty(ErrorHandler $object, string $property): mixed
    {
        $reflection = new ReflectionClass($object);

        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }
}
