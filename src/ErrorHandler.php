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
     * Style load validator.
     *
     * @since 1.0.0
     * 
     * @var bool
     */
    protected static $styles = false;

    /**
     * Catch errors and exceptions and execute the method.
     *
     * @since 1.0.0
     */
    public function __construct() {
                                                                                          
        set_exception_handler(array($this, 'exception'));

        set_error_handler(array($this, 'error'));
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
    public function error($code, $msg, $file, $line) {

        static::$stack = [
            'type'    => $this->getErrorType($code),
            'message' => $msg,
            'file'    => $file,
            'line'    => $line,
            'code'    => $code . " ·",
            'trace'   => '',
            'preview' => '',
        ];

        static::getPreviewCode($file, $line);

        $this->render();
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
     *        string $e->getTrace()[0]['function'] → function exception
     *        string $e->getTrace()[0]['class']    → class exception launcher
     *        string $e->getTrace()[0]['type']     → type exception launcher
     *        array  $e->getTrace()[0]['args']     → args exception launcher
     *
     *        Optionally for libraries used in Eliasis PHP Framework:
     *        int    $e->statusCode → HTTP response status code
     */
    public function exception($e) {

        static::$stack = [
            'type'       => 'Exception',
            'message'    => $e->getMessage(),
            'file'       => $e->getFile(),
            'line'       => $e->getLine(),
            'code'       => $e->getCode() . " ·",
            'statusCode' => (isset($e->statusCode)) ? $e->statusCode : 0,
            'trace'      => "\r\n<hr>BACKTRACE:\r\n",
            'preview'    => "",
        ];

        static::getPreviewCode(static::$stack['file'], static::$stack['line']);

        $trace = preg_split("/#[\d]/", $e->getTraceAsString());

        unset($trace[0]);
                                                                                
        array_pop($trace);

        foreach ($trace as $key => $value) {
     
            static::$stack['trace'] .= "\n" . $key . " ·" . $value;
        }

        $this->render();
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
                return static::$stack['type'] = 'Error';
        }
    }

    /**
     * Get preview of the error line.
     *
     * @since 1.1.0
     * 
     * @param string $file → filepath
     * @param string $line → error line
     */
    protected function getPreviewCode($file, $line) {

        $file = file($file);

        $start = ($line - 5 >= 0) ? $line - 5 : $line - 1; 
        $end   = ($line - 5 >= 0) ? $line + 4 : $line + 8; 

        for ($i = $start; $i < $end; $i++) { 

            if (!isset($file[$i])) {

                continue;
            }

            $text = trim($file[$i]);

            if ($i == $line - 1) {

                static::$stack['preview'] .= 
                    "<span class='jst-line'>" . ($i + 1) . "</span>" . 
                    "<span class='jst-mark text'>" . $text . "</span><br>";

                continue;
            }

            static::$stack['preview'] .= 
                "<span class='jst-line'>" . ($i + 1) .  "</span>" . 
                "<span class='text'>" . $text . "</span><br>";
        }
    }

    /**
     * Show alert in browser.
     *
     * @since 1.0.0
     */
    protected function render() {

        static::$stack['mode'] = defined('HHVM_VERSION') ? 'HHVM' : 'PHP';

        if (!static::$styles) {

            static::$styles = true;

            static::$stack['css'] = require(__DIR__ . '/resources/styles.php');
        }
        
        require(__DIR__ . '/resources/view.php');
    }
}
