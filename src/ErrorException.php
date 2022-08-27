<?php

/*
 * This file is part of https://github.com/josantonius/php-error-handler repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Josantonius\ErrorHandler;

use ErrorException as BaseErrorException;
use Josantonius\ErrorHandler\ErrorHandled;

class ErrorException extends BaseErrorException
{
    protected int $level;

    protected string $name;

    public function __construct(ErrorHandled $errorHandled)
    {
        $this->level = $errorHandled->getLevel();
        $this->name  = $errorHandled->getName();

        parent::__construct(
            $errorHandled->getMessage(),
            0,
            $errorHandled->getLevel(),
            $errorHandled->getFile(),
            $errorHandled->getLine()
        );
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
