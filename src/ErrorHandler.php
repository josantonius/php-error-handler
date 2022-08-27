<?php

declare(strict_types=1);

/*
 * This file is part of https://github.com/josantonius/php-error-handler repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Josantonius\ErrorHandler;

use Josantonius\ErrorHandler\Exceptions\WrongErrorLevelException;

/**
 * Handling errors.
 */
class ErrorHandler
{
    /**
     * @var callable|null Error handler function.
     */
    private $callback = null;

    /**
     * Error levels.
     */
    private array $errorLevels = [
        E_ERROR             => 'Error',
        E_WARNING           => 'Warning',
        E_PARSE             => 'Parse',
        E_NOTICE            => 'Notice',
        E_CORE_ERROR        => 'Core Error',
        E_CORE_WARNING      => 'Core Warning',
        E_COMPILE_ERROR     => 'Compile Error',
        E_COMPILE_WARNING   => 'Compile Warning',
        E_USER_ERROR        => 'User Error',
        E_USER_WARNING      => 'User Warning',
        E_USER_NOTICE       => 'User Notice',
        E_STRICT            => 'Strict',
        E_RECOVERABLE_ERROR => 'Recoverable Error',
        E_DEPRECATED        => 'Deprecated',
        E_USER_DEPRECATED   => 'User Deprecated',
        E_ALL               => 'All',
    ];

    /**
     * List of error levels that will be converted to exceptions.
     */
    private array $exceptionable = [];


    /**
     * If the error reporting level is used.
     */
    private bool $userErrorReporting = false;

    /**
     * Convert errors to exceptions.
     *
     * @param int[] $erroLevel Define the specific error levels that will become exceptions.
     *
     * @throws WrongErrorLevelException if error level is not valid.
     *
     * @see https://www.php.net/manual/en/errorfunc.constants.php
     */
    public function convertToExceptions(int ...$errorLevel): self
    {
        $this->throwExceptionIfHasWrongErrorLevel($errorLevel);

        $this->exceptionable = $errorLevel ? [...$errorLevel] : array_keys($this->errorLevels);

        return $this;
    }

    /**
     * Convert errors to exceptions except for some of them.
     *
     * @param int[] $erroLevel Define specific error levels that will not become exceptions.
     *
     * @throws WrongErrorLevelException if error level is not valid.
     *
     * @see https://www.php.net/manual/en/errorfunc.constants.php
     */
    public function convertToExceptionsExcept(int ...$errorLevel): self
    {
        $this->throwExceptionIfHasWrongErrorLevel($errorLevel);

        $this->exceptionable = $errorLevel
            ? array_values(array_diff(array_keys($this->errorLevels), $errorLevel))
            : array_keys($this->errorLevels);

        return $this;
    }

    /**
     * Register error handler function.
     */
    public function register(callable $callback): self
    {
        $this->callback = $callback;

        set_error_handler(
            fn ($level, $message, $file, $line) => $this->handler($level, $message, $file, $line)
        );

        register_shutdown_function(fn () => $this->checkForShutdownErrors());

        return $this;
    }

    /**
     * If the setting value in error_reporting() is used to determine which errors are handled.
     *
     * If this method is not used, all errors will be sent to the handler.
     *
     * @see https://www.php.net/manual/en/function.error-reporting.php
     */
    public function useErrorReportingLevel(): self
    {
        $this->userErrorReporting = true;

        return $this;
    }

    /**
     * Check for errors during shutdown.
     */
    private function checkForShutdownErrors(array $error = []): void
    {
        $error = $error ?? error_get_last();

        if ($error && $error['type'] === E_ERROR) {
            $this->handler($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    /**
     * Handle error.
     *
     * @throws ErrorException if the error is converted into an exception.
     */
    private function handler(int $level, string $message, string $file, int $line): void
    {
        if ($this->userErrorReporting && !(error_reporting() & $level)) {
            return;
        }

        $errorName    = $this->errorLevels[$level];
        $errorHandled = new ErrorHandled($level, $message, $file, $line, $errorName);

        $this->callback && ($this->callback)($errorHandled);

        in_array($level, $this->exceptionable) && throw new ErrorException($errorHandled);
    }

    /**
     * Throw exception if there is a wrong error code.
     *
     * @throws WrongErrorLevelException if error level is not valid.
     */
    private function throwExceptionIfHasWrongErrorLevel(array $errorLevels): void
    {
        foreach ($errorLevels as $level) {
            if (!isset($this->errorLevels[$level])) {
                throw new WrongErrorLevelException($level);
            }
        }
    }
}
