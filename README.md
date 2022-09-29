# PHP ErrorHandler library

[![Latest Stable Version](https://poser.pugx.org/josantonius/error-handler/v/stable)](https://packagist.org/packages/josantonius/error-handler)
[![License](https://poser.pugx.org/josantonius/error-handler/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/error-handler/downloads)](https://packagist.org/packages/josantonius/error-handler)
[![CI](https://github.com/josantonius/php-error-handler/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-error-handler/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-error-handler/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-error-handler)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Translations**: [Español](.github/lang/es-ES/README.md)

PHP library for handling exceptions.

To handle exceptions you can use the
[exception-handler](https://github.com/josantonius/php-exception-handler) library.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Classes](#available-classes)
  - [ErrorException Class](#errorexception-class)
  - [ErrorHandled Class](#errorhandled-class)
  - [ErrorHandler Class](#errorhandler-class)
- [Exceptions Used](#exceptions-used)
- [Usage](#usage)
- [Tests](#tests)
- [TODO](#todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#sponsor)
- [License](#license)

---

## Requirements

- Operating System: Linux | Windows.

- PHP versions: 8.1.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP ErrorHandler library**, simply:

```console
composer require josantonius/error-handler
```

The previous command will only install the necessary files,
if you prefer to **download the entire source code** you can use:

```console
composer require josantonius/error-handler --prefer-source
```

You can also **clone the complete repository** with Git:

```console
git clone https://github.com/josantonius/php-error-handler.git
```

## Available Classes

### ErrorException Class

`Josantonius\ErrorHandler\ErrorException` Extends
[ErrorException](https://www.php.net/manual/en/class.errorexception.php)

Gets error file:

```php
public function getFile(): string;
```

Gets error level:

```php
public function getLevel(): int;
```

Gets error file line:

```php
public function getLine(): int;
```

Gets error message:

```php
public function getMessage(): string;
```

Gets error name:

```php
public function getName(): string;
```

### ErrorHandled Class

`Josantonius\ErrorHandler\ErrorHandled`

Gets error file:

```php
public function getFile(): string;
```

Gets error level:

```php
public function getLevel(): int;
```

Gets error file line:

```php
public function getLine(): int;
```

Gets error message:

```php
public function getMessage(): string;
```

Gets error name:

```php
public function getName(): string;
```

### ErrorHandler Class

`Josantonius\ErrorHandler\ErrorHandler`

Convert errors to exceptions:

```php
/**
 * The errors will be thrown from the ErrorException instance.
 * 
 * @param int[] $errorLevel Define the specific error levels that will become exceptions.
 * 
 * @throws WrongErrorLevelException if error level is not valid.
 * 
 * @see https://www.php.net/manual/en/errorfunc.constants.php to view available error levels.
 */
public function convertToExceptions(int ...$errorLevel): ErrorHandler;
```

Convert errors to exceptions except for some of them:

```php
/**
 * The errors will be thrown from the ErrorException instance.
 * 
 * @param int[] $errorLevel Define the specific error levels that will become exceptions.
 * 
 * @throws WrongErrorLevelException if error level is not valid.
 * 
 * @see https://www.php.net/manual/en/errorfunc.constants.php to view available error levels.
 */
public function convertToExceptionsExcept(int ...$errorLevel): ErrorHandler;
```

Register error handler function:

```php
/**
 * The error handler will receive the ErrorHandled object.
 * 
 * @see https://www.php.net/manual/en/functions.first_class_callable_syntax.php
 */
public function register(callable $callback): ErrorHandler;
```

Use error reporting to determine which errors are handled:

```php
/**
 * If the setting value in error_reporting() is used to determine which errors are handled.
 *
 * If this method is not used, all errors will be sent to the handler.
 *
 * @see https://www.php.net/manual/en/function.error-reporting.php
 */
public function useErrorReportingLevel(): ErrorHandler;
```

## Exceptions Used

```php
use Josantonius\ErrorHandler\Exceptions\WrongErrorLevelException;
```

## Usage

Examples of use for this library:

### Convert all errors to exceptions

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions();

// All errors will be converted to exceptions.
```

### Convert certain errors to exceptions

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions(E_USER_ERROR, E_USER_WARNING);

// Only E_USER_ERROR and E_USER_WARNING will be converted to exceptions.
```

### Convert all errors to exceptions except for some of them

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptionsExcept(E_USER_DEPRECATED, E_USER_NOTICE);

// All errors except E_USER_DEPRECATED and E_USER_NOTICE will be converted to exceptions.
```

### Convert to exceptions using error reporting level

```php
use Josantonius\ErrorHandler\ErrorHandler;

error_reporting(E_USER_ERROR);

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions()->useErrorReportingLevel();

// Only E_USER_ERROR will be converted to exception.
```

### Convert to exceptions and use an exception handler

```php
use ErrorException;
use Josantonius\ErrorHandler\ErrorHandler;

set_exception_handler(function (ErrorException $exception) {
    var_dump([
        'level'   => $exception->getLevel(),
        'message' => $exception->getMessage(),
        'file'    => $exception->getFile(),
        'line'    => $exception->getLine(),
        'name'    => $exception->getName(),
    ]);
});

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions();

// All errors will be converted to exceptions.
```

### Register an error handler function

```php
use Josantonius\ErrorHandler\ErrorHandled;
use Josantonius\ErrorHandler\ErrorHandler;

function handler(Errorhandled $errorHandled): void {
    var_dump([
        'level'   => $errorHandled->getLevel(),
        'message' => $errorHandled->getMessage(),
        'file'    => $errorHandled->getFile(),
        'line'    => $errorHandled->getLine(),
        'name'    => $errorHandled->getName(),
    ]);
 }

$errorHandler = new ErrorHandler();

$errorHandler->register(
    callback: handler(...)
);

// All errors will be converted to exceptions.
```

### Register error handler function and convert to exceptions

```php
use Josantonius\ErrorHandler\ErrorHandled;
use Josantonius\ErrorHandler\ErrorHandler;

class Handler {
    public static function errors(Errorhandled $exception): void { /* do something */ }
}

$errorHandler = new ErrorHandler();

$errorHandler->register(
    callback: Handler::errors(...)
)->convertToExceptions();

// The error will be sent to the error handler and then throw the exception.
```

### Register error handler function, convert to exceptions and use error reporting level

```php
error_reporting(E_USER_ERROR);

class Handler {
    public function errors(Errorhandled $exception): void { /* do something */ }
}

$handler = new Handler();

$errorHandled->register(
    callback: $handler->errors(...),
)->convertToExceptions()->useErrorReportingLevel();

// Only E_USER_ERROR will be passed to the handler and converted to exception.
```

## Tests

To run [tests](tests) you just need [composer](http://getcomposer.org/download/)
and to execute the following:

```console
git clone https://github.com/josantonius/php-error-handler.git
```

```console
cd php-error-handler
```

```console
composer install
```

Run unit tests with [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Run code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Run [PHP Mess Detector](https://phpmd.org/) tests to detect inconsistencies in code style:

```console
composer phpmd
```

Run all previous tests:

```console
composer tests
```

## TODO

- [ ] Add new feature
- [ ] Improve tests
- [ ] Improve documentation
- [ ] Improve English translation in the README file
- [ ] Refactor code for disabled code style rules (see phpmd.xml and phpcs.xml)

## Changelog

Detailed changes for each release are documented in the
[release notes](https://github.com/josantonius/php-error-handler/releases).

## Contribution

Please make sure to read the [Contributing Guide](.github/CONTRIBUTING.md), before making a pull
request, start a discussion or report a issue.

Thanks to all [contributors](https://github.com/josantonius/php-error-handler/graphs/contributors)! :heart:

## Sponsor

If this project helps you to reduce your development time,
[you can sponsor me](https://github.com/josantonius#sponsor) to support my open source work :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2016-present, [Josantonius](https://github.com/josantonius#contact)
