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

class Handler
{
    public function init(ErrorHandled $handled): void
    {
        History::set(new self(), 'init', $handled);
    }
}
