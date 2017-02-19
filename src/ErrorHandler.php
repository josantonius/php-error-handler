<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2016 JST PHP Framework
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-ErrorHandler
 * @since      File available since 1.0.0 - Update: 2017-02-14
 */
 
namespace Josantonius\ErrorHandler;

# use Josantonius\ErrorHandler\Exception\ErrorHandlerException;

/**
 * Handling exceptions and errors.
 *
 * @since 1.0.0
 */
class ErrorHandler { 

    /**
     * Active stack.
     *
     * @since 1.0.0
     * 
     * @var array
     */
    protected static $stack;

    /**
     * Catch errors and exceptions and execute the method.
     *
     * @since 1.0.0
     */
    public function __construct() {
                                                                                          
        /**
         * Compatibility with exception and error handler for PHP7 and HHVM.
         *
         * @since 1.0.0
         */
        if (!defined('HHVM_VERSION') && version_compare(phpversion(), '7.0.0', '>=')) { 

            set_exception_handler(array($this, 'catchThrowable'));

        } else { 
            
            set_exception_handler(array($this, 'catchException'));
        } 

        set_error_handler(array($this, 'catchError'));
    }                                                

    /**
     * Handle exceptions catch.
     *
     * @since 1.0.0
     * 
     * @param object $e Throwable object
     */
    public function catchThrowable(Throwable $e) {

        $this->prepareException($e);
    }

    /**
     * Handle exceptions catch.
     *
     * @since 1.0.0
     * 
     * @param object $e Exception object
     */
    public function catchException(Exception $e) {

        $this->prepareException($e);
    }

    /**
     * Handle error catch.
     *
     * @since 1.0.0
     * 
     * @param int $code → error code
     * @param int $msg  → error message
     * @param int $file → error file
     * @param int $line → error line
     */
    public function catchError($code, $msg, $file, $line) {

        static::$stack = [
            'type'    => $this->getErrorType($code),
            'message' => $msg,
            'file'    => $file,
            'line'    => $line,
            'code'    => $code ? "[" . $code . "]" : "",
            'trace'      => '',
        ];

        $this->show();
    }

    /**
     * Handle exceptions catch.
     *
     * @since 1.0.0
     * 
     * @param object $e
     *        string $e->getMessage() → exception message
     *        int    $e->getCode()    → exception code
     *        string $e->getFile()    → file where the exception is launched
     *        int    $e->getLine()    → line where the exception is launched
     *        
     *        array  $e->getTrace()
     *        string $e->getTrace()[0]['file']     → file exception launcher
     *        int    $e->getTrace()[0]['line']     → line exception launcher
     *        string $e->getTrace()[0]['function'] → function exception launcher
     *        string $e->getTrace()[0]['class']    → class exception launcher
     *        string $e->getTrace()[0]['type']     → type exception launcher
     *        array  $e->getTrace()[0]['args']     → args exception launcher
     *
     *        Optionally for libraries used in JST PHP Framework:
     *        int    $e->statusCode → HTTP response status code
     */
    public function prepareException($e) {

        static::$stack = [
            'type'       => 'Exception',
            'message'    => (null !== $e->getMessage()) ? $e->getMessage() : '',
            'file'       => (null !== $e->getFile()) ? $e->getFile() : 0,
            'line'       => (null !== $e->getLine()) ? $e->getLine() : 0,
            'code'       => $e->getCode() ? "[" . $e->getCode() . "]" : "",
            'trace'      => '',
        ];

        if (is_array($e->getTrace()) && count($e->getTrace()) > 0) {

            $tab = "\r\n";

            foreach ($e->getTrace() as $key => $value) {
                    
                $tab .= "· · · · ";

                $statusCode = (isset($e->statusCode)) ? $e->statusCode : 0;
                
                static::$stack['trace'] = "\r\n\r\n<hr>" .

                    $tab . " [Trace "     . ($key + 1) . "]"            .
                    $tab . " FILE: "      . $value['file']              .
                    $tab . " HTTP CODE: " . $statusCode       .
                    $tab . " FUNCTION: "  . $value['function']          .
                    $tab . " CLASS: "     . $value['class']             .
                    $tab . " ARGS: "      . json_encode($value['args']) .
                    $tab . " LINE: "      . $value['line']              .
                    $tab . " TYPE "       . $value['type'] . "\r\n";
            }
        }

        $this->show();
    }

    /**
     * Convert error code to text.
     *
     * @since 1.0.0
     * 
     * @param int $code → error code
     *
     * @return string   → error type
     */
    protected function getErrorType($code) {
            
        switch($code) {

            case E_ERROR:                   
                return static::$stack['type'] = 'Error';             /* 1 */
            case E_WARNING:
                return static::$stack['type'] = 'Warning';           /* 2 */ 
            case E_PARSE:
                return static::$stack['type'] = 'Parse';             /* 4 */ 
            case E_NOTICE:
                return static::$stack['type'] = 'Notice';            /* 8 */ 
            case E_CORE_ERROR:
                return static::$stack['type'] = 'Core-Error';        /* 16 */ 
            case E_CORE_WARNING:
                return static::$stack['type'] = 'Core Warning';      /* 32 */ 
            case E_COMPILE_ERROR:
                return static::$stack['type'] = 'Compile Error';     /* 64 */ 
            case E_COMPILE_WARNING:
                return static::$stack['type'] = 'Compile Warning';   /* 128 */ 
            case E_USER_ERROR:
                return static::$stack['type'] = 'User Error';        /* 256 */ 
            case E_USER_WARNING:
                return static::$stack['type'] = 'User Warning';      /* 512 */ 
            case E_USER_NOTICE:
                return static::$stack['type'] = 'User Notice';       /* 1024*/ 
            case E_STRICT:             
                return static::$stack['type'] = 'Strict';            /* 2048*/ 
            case E_RECOVERABLE_ERROR:
                return static::$stack['type'] = 'Recoverable Error'; /* 4096*/ 
            case E_DEPRECATED:
                return static::$stack['type'] = 'Deprecated';        /* 8192 */ 
            case E_USER_DEPRECATED:
                return static::$stack['type'] = 'User Deprecated';   /* 16384 */ 
            default :
                return static::$stack['type'] = (string) $code;

        }

    }

    /**
     * Show alert in browser.
     *
     * @since 1.0.0
     * 
     * @param string $type → error or exception
     */
    protected function show() {

        $css = __DIR__ . '/resources/styles.php';

        static::$stack['mode'] = defined('HHVM_VERSION') ? 'HHVM' : 'PHP';

        ob_start();

        if (!isset(static::$stack['css'])) {

            static::$stack['css'] = require($css);
        }
        
        require(__DIR__ . '/resources/view.php');

        ob_end_flush();
    }
}