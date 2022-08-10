<?php

/*
* This file is part of https://github.com/josantonius/php-error-handler repository.
*
* (c) Josantonius <hello@josantonius.dev>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Josantonius\ErrorHandler\Tests\ErrorHandler;

use PHPUnit\Framework\TestCase;
use Josantonius\ErrorHandler\ErrorHandler;

class UseErrorReportingLevelTest extends TestCase
{
    private ErrorHandler $errorHandler;

    public function setUp(): void
    {
        parent::setUp();

        $this->errorHandler = new ErrorHandler();
    }

    public function testShouldSetToUseErrorReportingLevel(): void
    {
        $this->assertInstanceOf(
            ErrorHandler::class,
            $this->errorHandler->useErrorReportingLevel()
        );
    }
}
