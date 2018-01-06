<?php
/**
 * PHP library for handling exceptions and errors.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2016 - 2018 (c) Josantonius - PHP-ErrorHandler
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-ErrorHandler
 * @since     1.1.5
 */
namespace Josantonius\ErrorHandler;

use PHPUnit\Framework\TestCase;

/**
 * Tests class for ErrorHandler library.
 */
final class ErrorHandlerTest extends TestCase
{
    /**
     * ErrorHandler instance.
     *
     * @since 1.1.6
     *
     * @var object
     */
    protected $ErrorHandler;

    /**
     * Set up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->ErrorHandler = new ErrorHandler;
    }

    /**
     * Check if it is an instance of ErrorHandler.
     *
     * @since 1.1.7
     */
    public function testIsInstanceOfErrorHandler()
    {
        $this->assertInstanceOf(
            'Josantonius\ErrorHandler\ErrorHandler',
            $this->ErrorHandler
        );
    }

    /**
     * Check if custom exception handler is activated.
     */
    public function testIfCustomExceptionHandlerIsActivated()
    {
        $lastHandler = set_exception_handler(null);
        $className = get_class($lastHandler[0]);

        $this->assertContains('ErrorHandler', $className);

        $this->assertObjectHasAttribute('stack', $lastHandler[0]);
    }

    /**
     * Check if custom exception handler is activated.
     */
    public function testIfCustomErrorHandlerIsActivated()
    {
        $lastHandler = set_error_handler(null);
        $className = get_class($lastHandler[0]);

        $this->assertContains('ErrorHandler', $className);

        $this->assertObjectHasAttribute('stack', $lastHandler[0]);
    }

    /**
     * Test exception handler.
     */
    public function testException()
    {
        $this->assertTrue(
            $this->ErrorHandler->exception(new \Exception())
        );
    }

    /**
     * Test exception handler with custom methods and not show default view.
     */
    public function testExceptionWithCustomMethodsWithoutShowDefaultView()
    {
        $this->ErrorHandler->setCustomMethod(
            $this->ErrorHandler,
            'testError',
            0,
            false
        );

        $this->assertFalse(
            $this->ErrorHandler->exception(new \Exception())
        );
    }

    /**
     * Test exception handler with custom methods and show default view.
     */
    public function testExceptionWithCustomMethodsAndShowDefaultView()
    {
        $this->ErrorHandler->setCustomMethod(
            $this->ErrorHandler,
            'testError',
            0,
            true
        );

        $this->assertTrue(
            $this->ErrorHandler->exception(new \Exception())
        );
    }

    /**
     * Test error handler.
     */
    public function testError()
    {
        $this->assertTrue(
            $this->ErrorHandler->error(8, 'Test', __FILE__, __LINE__)
        );
    }

    /**
     * Test error handler with custom methods and not show default view.
     */
    public function testErrorWithCustomMethodsWithoutShowDefaultView()
    {
        $this->ErrorHandler->setCustomMethod(
            $this->ErrorHandler,
            'testError',
            0,
            false
        );

        $this->assertFalse(
            $this->ErrorHandler->error(8, 'Test', __FILE__, __LINE__)
        );
    }

    /**
     * Test error handler with custom methods and show default view.
     */
    public function testErrorWithCustomMethodsAndShowDefaultView()
    {
        $this->ErrorHandler->setCustomMethod(
            $this->ErrorHandler,
            'testError',
            0,
            true
        );

        $this->assertTrue(
            $this->ErrorHandler->error(8, 'Test', __FILE__, __LINE__)
        );
    }

    /**
     * Get error type.
     */
    public function testGetErrorType()
    {
        $this->assertContains('Warning', $this->ErrorHandler->getErrorType(2));
        $this->assertContains('Notice', $this->ErrorHandler->getErrorType(8));
        $this->assertContains('Error', $this->ErrorHandler->getErrorType(00));
    }
}
