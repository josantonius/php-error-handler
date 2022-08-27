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

use ErrorException;
use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Josantonius\ErrorHandler\ErrorHandled;
use Josantonius\ErrorHandler\ErrorHandler;
use Josantonius\ErrorHandler\Tests\ErrorHandler\Resources\Handler;
use Josantonius\ErrorHandler\Tests\ErrorHandler\Resources\History;

class HandlerTest extends TestCase
{
    private Handler $handler;

    private ErrorHandler $errorHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler = new Handler();

        $this->errorHandler = new ErrorHandler();
    }

    public function test_should_convert_errors_to_exceptions(): void
    {
        $this->errorHandler->convertToExceptions();

        $this->expectException(ErrorException::class);

        $this->simulateError($this->errorHandler, E_ERROR);
    }

    public function test_should_send_the_error_to_the_handler_when_one_is_registered(): void
    {
        $this->errorHandler->register($this->handler->init(...));

        History::clear();

        $this->simulateError($this->errorHandler, E_ERROR);

        $this->assertCount(1, History::get());

        $this->assertInstanceOf(ErrorHandled::class, History::get(0)->errorHandled);

        $this->assertEquals('init', History::get(0)->methodName);
        $this->assertEquals(8, History::get(0)->errorHandled->getLine());
        $this->assertEquals(E_ERROR, History::get(0)->errorHandled->getLevel());
    }

    public function test_should_use_error_reporting_level_to_handle_errors_if_set(): void
    {
        $handler = $this->errorHandler;

        $handler->register($this->handler->init(...))->useErrorReportingLevel();

        History::clear();

        error_reporting(E_ALL)              && $this->simulateError($handler, E_ERROR);
        error_reporting(E_ALL & ~E_ERROR)   && $this->simulateError($handler, E_WARNING);
        error_reporting(E_USER_NOTICE)      && $this->simulateError($handler, E_USER_NOTICE);
        error_reporting(E_PARSE | E_STRICT) && $this->simulateError($handler, E_STRICT);

        $this->assertCount(4, History::get());

        History::clear();

        error_reporting(E_ALL & ~E_ERROR)   && $this->simulateError($handler, E_ERROR);
        error_reporting(E_USER_NOTICE)      && $this->simulateError($handler, E_WARNING);
        error_reporting(E_PARSE | E_STRICT) && $this->simulateError($handler, E_USER_NOTICE);

        $this->assertCount(0, History::get());
    }

    private function simulateError(ErrorHandler $object, int $errorLevel): void
    {
        $reflection = new ReflectionClass($object);
        $reflection = $reflection->getMethod('handler');
        $reflection->setAccessible(true);
        $reflection->invoke($object, $errorLevel, 'message', __FILE__, 8);
    }
}
