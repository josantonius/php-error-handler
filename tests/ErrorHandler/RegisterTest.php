<?php

/*
 * This file is part of https://github.com/josantonius/php-error-handler repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */

namespace Josantonius\ErrorHandler\Tests\ErrorHandler;

use Closure;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Josantonius\ErrorHandler\ErrorHandler;
use Josantonius\ErrorHandler\Tests\ErrorHandler\Resources\Handler;

class RegisterMethodTest extends TestCase
{
    private array $errorLevels;

    private Handler $handler;

    private ErrorHandler $errorHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler = new Handler();

        $this->errorHandler = new ErrorHandler();

        $this->errorLevels = $this->getPrivateProperty($this->errorHandler, 'errorLevels');
    }

    public function test_should_register_callback_to_handle_errors(): void
    {
        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler->register($this->handler->init(...))
        );

        $this->assertInstanceOf(Closure::class, set_error_handler(null));
    }

    public function test_should_register_callback_and_set_exceptions_conversion(): void
    {
        $this->assertNull(set_error_handler(null));

        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler->register($this->handler->init(...))->convertToExceptions()
        );

        $this->assertInstanceOf(Closure::class, set_error_handler(null));

        $exceptionable = $this->getPrivateProperty($this->errorHandler, 'exceptionable');

        $this->assertSame(array_keys($this->errorLevels), $exceptionable);
    }

    public function test_should_register_callback_and_set_exceptions_conversion_except_some(): void
    {
        $this->assertNull(set_error_handler(null));

        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler
                ->register($this->handler->init(...))
                ->convertToExceptionsExcept(E_ERROR)
        );

        $this->assertInstanceOf(Closure::class, set_error_handler(null));

        unset($this->errorLevels[E_ERROR]);

        $exceptionable = $this->getPrivateProperty($this->errorHandler, 'exceptionable');

        $this->assertSame(array_keys($this->errorLevels), $exceptionable);
    }

    private function getPrivateProperty(ErrorHandler $object, string $property): mixed
    {
        $reflection = new ReflectionClass($object);

        $reflectionProperty = $reflection->getProperty($property);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($object);
    }
}
