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

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Josantonius\ErrorHandler\ErrorHandler;
use Josantonius\ErrorHandler\Tests\ErrorHandler\Resources\Handler;
use Josantonius\ErrorHandler\Tests\ErrorHandler\Resources\History;

class CheckForShutdownErrorsTest extends TestCase
{
    private Handler $handler;

    private ErrorHandler $errorHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->handler = new Handler();

        $this->errorHandler = new ErrorHandler();
    }

    public function test_should_send_the_handler_a_shutdown_error(): void
    {
        $this->errorHandler->register($this->handler->init(...));

        History::clear();

        $this->simulateShutdown(E_ERROR);

        $this->assertCount(1, History::get());
        $this->assertEquals(E_ERROR, History::get(0)->errorHandled->getLevel());
    }

    public function test_should_ignore_anything_other_than_a_shutdown_error(): void
    {
        $this->errorHandler->register($this->handler->init(...));

        History::clear();

        $this->simulateShutdown(E_WARNING);

        $this->assertEmpty(History::get());
    }

    private function simulateShutdown(int $errorLevel): void
    {
        $reflection = new ReflectionClass($this->errorHandler);
        $reflection = $reflection->getMethod('checkForShutdownErrors');
        $reflection->setAccessible(true);
        $reflection->invoke($this->errorHandler, [
            'type' => $errorLevel,
            'message' => 'Error',
            'file' => '',
            'line' => 0
        ]);
    }
}
