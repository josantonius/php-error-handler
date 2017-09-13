<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-ErrorHandler
 * @since      1.1.5
 */

namespace Josantonius\ErrorHandler\Test;

use Josantonius\ErrorHandler\ErrorHandler,
    PHPUnit\Framework\TestCase;

/**
 * Tests class for ErrorHandler library.
 *
 * @since 1.1.5
 */
final class ErrorHandlerTest extends TestCase { 

    /**
     * Check if custom exception handler is activated.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testIfCustomExceptionHandlerIsActivated() {

        new ErrorHandler;

        $lastHandler = set_exception_handler(null);

        $className = get_class($lastHandler[0]);

        $this->assertContains('ErrorHandler', $className);

        $this->assertObjectHasAttribute('stack', $lastHandler[0]);
    }

    /**
     * Check if custom exception handler is activated.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testIfCustomErrorHandlerIsActivated() {

        new ErrorHandler;

        $lastHandler = set_error_handler(null);

        $className = get_class($lastHandler[0]);

        $this->assertContains('ErrorHandler', $className);

        $this->assertObjectHasAttribute('stack', $lastHandler[0]);
    }

    /**
     * Test exception handler.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testException() {

        $ErrorHandler = new ErrorHandler;

        $this->assertTrue(

            $ErrorHandler->exception(new \Exception())
        );
    }

    /**
     * Test exception handler with custom methods and not show default view.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testExceptionWithCustomMethodsWithoutShowDefaultView() {

        $ErrorHandler = new ErrorHandler;

        $ErrorHandler->setCustomMethod($ErrorHandler, 'testError', 0, false);

        $this->assertFalse(

            $ErrorHandler->exception(new \Exception())
        );
    }

    /**
     * Test exception handler with custom methods and show default view.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testExceptionWithCustomMethodsAndShowDefaultView() {

        $ErrorHandler = new ErrorHandler;

        $ErrorHandler->setCustomMethod($ErrorHandler, 'testError', 0, true);

        $this->assertTrue(

            $ErrorHandler->exception(new \Exception())
        );
    }

    /**
     * Test error handler.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testError() {

        $ErrorHandler = new ErrorHandler;

        $this->assertTrue(

            $ErrorHandler->error(8, 'Test', __FILE__, __LINE__)
        );
    }

    /**
     * Test error handler with custom methods and not show default view.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testErrorWithCustomMethodsWithoutShowDefaultView() {

        $ErrorHandler = new ErrorHandler;

        $ErrorHandler->setCustomMethod($ErrorHandler, 'testError', 0, false);

        $this->assertFalse(

            $ErrorHandler->error(8, 'Test', __FILE__, __LINE__)
        );
    }

    /**
     * Test error handler with custom methods and show default view.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testErrorWithCustomMethodsAndShowDefaultView() {

        $ErrorHandler = new ErrorHandler;

        $ErrorHandler->setCustomMethod($ErrorHandler, 'testError', 0, true);

        $this->assertTrue(

            $ErrorHandler->error(8, 'Test', __FILE__, __LINE__)
        );
    }

    /**
     * Get error type.
     *
     * @since 1.1.5   
     *
     * @return void
     */
    public function testGetErrorType() {

        $ErrorHandler = new ErrorHandler;

        $this->assertContains('Warning', $ErrorHandler->getErrorType(2));

        $this->assertContains('Notice', $ErrorHandler->getErrorType(8));

        $this->assertContains('Error', $ErrorHandler->getErrorType(00));

    }
}
