<?php

/*
 * This file is part of https://github.com/josantonius/php-error-handler repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Josantonius\ErrorHandler\Exceptions;

class WrongErrorLevelException extends \Exception
{
    public function __construct(int $errorLevel)
    {
        parent::__construct("Level '$errorLevel' is not a valid error level.");
    }
}
