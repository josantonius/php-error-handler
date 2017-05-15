<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-ErrorHandler
 * @since      1.0.0
 */

namespace Josantonius\ErrorHandler\Tests;

use Josantonius\ErrorHandler\ErrorHandler,
    Josantonius\ErrorHandler\Exception\ErrorHandlerException;

/**
 * Tests class for ErrorHandler library.
 *
 * @since 1.0.0
 */
class ErrorHandlerTest { 

    /**
     * Set custom method.
     *
     * @since 1.1.3
     */
    public function testSetCustomMethod() {

        $class = $this;

        $method = '_customMethodResponse';

        /**
         * Number of times to repeat this method in case of multiple errors.
         */
        $times = 0; 

        ErrorHandler::SetCustomMethod($class, $method, $times);

        throw new \Exception("View from custom method");
    }

    /**
     * Set custom method.
     *
     * @since 1.1.3
     */
    public function _customMethodResponse($params) {

        echo "Custom method: <br>";

        foreach ($params as $key => $value) {
            
            echo  "<br>" . $key . " → " . $value;
        }
    }

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