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
    public static $stack;

    /**
     * Style load validator.
     *
     * @since 1.0.0
     * 
     * @var bool
     */
    public static $styles = false;

    /**
     * Custom methods.
     *
     * @since 1.1.3
     * 
     * @var bool
     */
    public static $customMethods = false;

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

        $type = $this->getErrorType($code);

        $this->setParams($type, $code, $msg, $file, $line, '', 0);

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
                return self::$stack['type'] = 'Error';             # 1
            case E_WARNING:
                return self::$stack['type'] = 'Warning';           # 2 
            case E_PARSE:
                return self::$stack['type'] = 'Parse';             # 4 
            case E_NOTICE:
                return self::$stack['type'] = 'Notice';            # 8 
            case E_CORE_ERROR:
                return self::$stack['type'] = 'Core-Error';        # 16 
            case E_CORE_WARNING:
                return self::$stack['type'] = 'Core Warning';      # 32 
            case E_COMPILE_ERROR:
                return self::$stack['type'] = 'Compile Error';     # 64 
            case E_COMPILE_WARNING:
                return self::$stack['type'] = 'Compile Warning';   # 128 
            case E_USER_ERROR:
                return self::$stack['type'] = 'User Error';        # 256 
            case E_USER_WARNING:
                return self::$stack['type'] = 'User Warning';      # 512 
            case E_USER_NOTICE:
                return self::$stack['type'] = 'User Notice';       # 1024 
            case E_STRICT:             
                return self::$stack['type'] = 'Strict';            # 2048 
            case E_RECOVERABLE_ERROR:
                return self::$stack['type'] = 'Recoverable Error'; # 4096 
            case E_DEPRECATED:
                return self::$stack['type'] = 'Deprecated';        # 8192 
            case E_USER_DEPRECATED:
                return self::$stack['type'] = 'User Deprecated';   # 16384 
            default :
                return self::$stack['type'] = 'Error';
        }
    }

    /**
     * Handle exceptions catch.
     *
     * @since 1.0.0
     *
     * Optionally for libraries used in Eliasis PHP Framework: $e->statusCode
     *
     * @param object $e
     *        string $e->getMessage()       → exception message
     *        int    $e->getCode()          → exception code
     *        string $e->getFile()          → file
     *        int    $e->getLine()          → line
     *        string $e->getTraceAsString() → trace as string
     *        int    $e->statusCode         → HTTP response status code
     */
    public function exception($e) {

        $trace = "\r\n<hr>BACKTRACE:\r\n";

        $traceString = preg_split("/#[\d]/", $e->getTraceAsString());

        unset($traceString[0]);
                                                                                
        array_pop($traceString);

        foreach ($traceString as $key => $value) {
     
            $trace .= "\n" . $key . " ·" . $value;
        }

        $this->setParams(
            'Exception',
            $e->getCode(),
            $e->getMessage(), 
            $e->getFile(),
            $e->getLine(),
            $trace,
            (isset($e->statusCode)) ? $e->statusCode : 0
        );

        $this->render();
    }

    /**
     * Handle error catch.
     *
     * @since 1.1.3
     * 
     * @param int    $code  → exception/error code
     * @param int    $msg   → exception/error message
     * @param int    $file  → exception/error file
     * @param int    $line  → exception/error line
     * @param string $trace → exception/error trace
     * @param string $http  → HTTP response status code
     */
    protected function setParams($type, $code, $msg, $file, $line, $trace, $http) {

        self::$stack = [
            'type'      => $type,
            'message'   => $msg,
            'file'      => $file,
            'line'      => $line,
            'code'      => $code,
            'http-code' => ($http === 0) ? http_response_code() : $http,
            'trace'     => $trace,
            'preview'   => '',
        ];
    }

    /**
     * Get preview of the error line.
     *
     * @since 1.1.0
     */
    protected function getPreviewCode() {

        $file = file(self::$stack['file']);

        $line = self::$stack['line'];

        $start = ($line - 5 >= 0) ? $line - 5 : $line - 1; 
        $end   = ($line - 5 >= 0) ? $line + 4 : $line + 8; 

        for ($i = $start; $i < $end; $i++) { 

            if (!isset($file[$i])) {

                continue;
            }

            $text = trim($file[$i]);

            if ($i == $line - 1) {

                self::$stack['preview'] .= 
                    "<span class='jst-line'>" . ($i + 1) .  "</span>" . 
                    "<span class='jst-mark text'>" . $text . "</span><br>";

                continue;
            }

            self::$stack['preview'] .= 
                "<span class='jst-line'>" . ($i + 1) . "</span>" . 
                "<span class='text'>" . $text . "</span><br>";
        }
    }

    /**
     * Set customs methods to renderizate.
     *
     * @since 1.1.3
     * 
     * @param string|object $class   → class name or class object
     * @param string        $method  → method name
     * @param int           $repeat  → number of times to repeat method
     * @param boolean       $default → show default view
     */
    public static function setCustomMethod($class, $method, $repeat = 0, $default = false) {

        self::$customMethods[] = [$class, $method, $repeat];
    }

    /**
     * Get customs methods to renderizate.
     *
     * @since 1.1.3
     */
    protected function getCustomMethods() {

        $showDefaultView = true;

        $params = [self::$stack];

        unset($params[0]['trace'], $params[0]['preview']);

        $count = count(self::$customMethods);

        $customMethods = self::$customMethods;

        for ($i=0; $i < $count; $i++) {

            $custom = $customMethods[$i];

            $class  = isset($custom[0]) ? $custom[0] : false;

            $method = isset($custom[1]) ? $custom[1] : false;

            $repeat = $custom[2];

            $showDefault = $custom[3];

            if ($showDefault === false) {

                $showDefaultView = false;
            }

            if ($repeat === 0) {

                unset(self::$customMethods[$i]);
            
            } else {

                self::$customMethods[$i] = [$class, $method, $repeat--];
            }

            call_user_func_array([$class, $method], $params);
        }

        return $showDefaultView;
    }

    /**
     * Renderization.
     *
     * @since 1.0.0
     *
     * @return 
     */
    protected function render() {

        self::$stack['mode'] = defined('HHVM_VERSION') ? 'HHVM' : 'PHP';

        if (self::$customMethods) {

            if ($this->getCustomMethods() === false) {
                
                return;
            }
        }

        $this->getPreviewCode();
        
        if (!self::$styles) {

            self::$styles = true;

            $file = __DIR__.'/resources/styles.php';

            self::$stack['css'] = require($file);
        }
        
        require(__DIR__ . '/resources/view.php');
    }
}
