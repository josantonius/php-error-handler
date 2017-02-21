<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2016-2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/ErrorHandler
 * @since      File available since 1.0.0 - Update: 2017-02-21
 */

namespace Josantonius\ErrorHandler\Tests;

use Josantonius\ErrorHandler\ErrorHandler;

/**
 * Tests class for ErrorHandler library.
 *
 * @since 1.0.0
 */
class ErrorHandlerTest { 

    /**
     * Provoke exception.
     *
     * @since 1.0.0   
     *
     * @throws ErrorHandlerException → provoked exception
     */
    public function testSProvokeException() {

        throw new ErrorHandlerException("This is a exception message", 100, 400);
    }

    /**
     * Provoke warning.
     *
     * @since 1.0.0   
     */
    public function testSProvokeWarning() {

        implode();
    }

    /**
     * Provoke notice.
     *
     * @since 1.0.0   
     */
    public function testSProvokeNotice() {

        echo $error;
    }

    /**
     * Provoke user error.
     *
     * @since 1.0.0   
     */
    public function testSProvokeUserError() {

        htmlentities(
            trigger_error("This is a user-level error message", E_USER_ERROR)
        );
    }

    /**
     * Provoke user notice.
     *
     * @since 1.0.0   
     */
    public function testSProvokeUserNotice() {

        htmlentities(
            trigger_error("This is a user-level notice message")
        );
    }

    /**
     * Provoke user warning.
     *
     * @since 1.0.0   
     */
    public function testSProvokeUserWarning() {
        
        htmlentities(
            trigger_error("This is a user-level warning message", E_USER_WARNING)
        );
    }
}