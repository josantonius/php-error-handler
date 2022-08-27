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

/**
 * Details of the error handled.
 */
class ErrorHandled
{
    /**
     * Sets error details.
     */
    public function __construct(
        private int $level,
        private string $message,
        private string $file,
        private int $line,
        private string $name
    ) {
    }

    /**
     * Gets error file.
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * Gets error message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Gets error level.
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * Gets error file line.
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * Gets error name.
     */
    public function getName(): string
    {
        return $this->name;
    }
}
