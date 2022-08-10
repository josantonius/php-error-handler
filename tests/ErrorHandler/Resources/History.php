<?php

/*
* This file is part of https://github.com/josantonius/php-error-handler repository.
*
* (c) Josantonius <hello@josantonius.dev>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Josantonius\ErrorHandler\Tests\ErrorHandler\Resources;

use Josantonius\ErrorHandler\ErrorHandled;

class History
{
    private static array $history = [];

    public static function set(object $object, string $methodName, ?ErrorHandled $errorHandled)
    {
        $object->methodName   = $methodName;
        $object->errorHandled = $errorHandled;

        self::$history[] = $object;
    }

    public static function get(?int $key = null): mixed
    {
        return $key !== null ? (self::$history[$key] ?? null) : self::$history;
    }

    public static function clear(): void
    {
        self::$history = [];
    }
}
