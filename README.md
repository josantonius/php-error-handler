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
[josantonius/exception-handler](https://github.com/josantonius/php-exception-handler) library.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Classes](#available-classes)
  - [ErrorHandler](#errorhandler)
  - [ErrorHandled](#errorhandled)
  - [ErrorException](#errorexception)
- [Exceptions Used](#exceptions-used)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Tests](#tests)
- [TODO](#todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#Sponsor)
- [License](#license)

---

## Requirements

This library is compatible with the PHP versions: 8.1.

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

### ErrorHandler

Available methods in `Josantonius\ErrorHandler\ErrorHandler`:

#### Convert errors to exceptions

```php
$errorHandler->convertToExceptions(int ...$errorLevel): self
```

**@param** `int[]` `$erroLevel` Define the specific error levels that will become exceptions.

**@throws** [WrongErrorLevelException](#wrongerrorlevelexception)

**@see** <https://www.php.net/manual/en/errorfunc.constants.php> to view available error levels.

**The exception will be thrown from the [ErrorException](#errorexception) instance.**

#### Convert errors to exceptions except for some of them

```php
$errorHandler->convertToExceptionsExcept(int ...$errorLevel): self
```

**@param** `int[]` `$erroLevel` Define specific error levels that will not become exceptions.

**@throws** [WrongErrorLevelException](#wrongerrorlevelexception)

**@see** <https://www.php.net/manual/en/errorfunc.constants.php> to view available error levels.

**The exception will be thrown from the [ErrorException](#errorexception) instance.**

#### Register error handler function

```php
$errorHandler->register(callable $callback): self
```

**@see** <https://www.php.net/manual/en/functions.first_class_callable_syntax.php> for more
information about first class callable syntax.

The error handler will receive the [ErrorHandled](#errorhandled) object.

#### Use error reporting to determine which errors are handled

```php
$errorHandler->useErrorReportingLevel(): self
```

**@see** <https://www.php.net/manual/en/function.error-reporting.php> for more information.

If the setting value in error_reporting() is used to determine which errors are handled.

**If this method is not used, all errors will be sent to the handler.**

### ErrorHandled

Available methods in `Josantonius\ErrorHandler\ErrorHandled`:

#### Gets error file

```php
$errorHandled->getFile(): string
```

#### Gets error message

```php
$errorHandled->getMessage(): string
```

#### Gets error level

```php
$errorHandled->getLevel(): int
```

#### Gets error file line

```php
$errorHandled->getLine(): int
```

#### Gets error name

```php
$errorHandled->getName(): string
```

### ErrorException

The available methods in `Josantonius\ErrorHandler\Exceptions\ErrorException` are the same
as in [ErrorHandled](#errorhandled).

This class extends from [ErrorException](https://www.php.net/manual/en/class.errorexception.php).

## Exceptions Used

### WrongErrorLevelException

`Josantonius\ErrorHandler\Exceptions\WrongErrorLevelException` if error level is not valid.

## Quick Start

To use this library:

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();
```

## Usage

Examples of use for this library:

### Convert all errors to exceptions

```php
$errorHandler->convertToExceptions();
```

### Convert certain errors to exceptions

```php
$errorHandler->convertToExceptions(E_USER_ERROR, E_USER_WARNING);
```

Only `E_USER_ERROR` and `E_USER_WARNING` will be converted to exceptions.

### Convert all errors to exceptions except for some of them

```php
$errorHandler->convertToExceptionsExcept(E_USER_DEPRECATED, E_USER_NOTICE);
```

All errors except `E_USER_DEPRECATED` and `E_USER_NOTICE` will be converted to exceptions.

### Convert to exceptions using error reporting level

```php
error_reporting(E_USER_ERROR) 
```

```php
$errorHandler->convertToExceptions()->useErrorReportingLevel();
```

Only `E_USER_ERROR` will be converted to exception.

### Convert to exceptions and use an exception handler

```php
set_exception_handler(function (\ErrorException $exception) {
    log([
        'level'   => $exception->getLevel(),
        'message' => $exception->getMessage(),
        'file'    => $exception->getFile(),
        'line'    => $exception->getLine(),
        'name'    => $exception->getName(),
    ]);
});
```

```php
$errorHandler->convertToExceptions();
```

Only `E_USER_ERROR` will be converted to exception.

### Register an error handler function

```php
function handler(Errorhandled $errorHandled): void {
    log([
        'level'   => $errorHandled->getLevel(),
        'message' => $errorHandled->getMessage(),
        'file'    => $errorHandled->getFile(),
        'line'    => $errorHandled->getLine(),
        'name'    => $errorHandled->getName(),
    ]);
 }
```

```php
$errorHandled->register(
    callback: handler(...)
);
```

### Register error handler function and convert to exceptions

```php
class Handler {
    public static function errors(Errorhandled $exception): void { /* do something */ }
}
```

```php
$errorHandled->register(
    callback: Handler::errors(...)
)->convertToExceptions();
```

Or:

```php
$errorHandled->register(
    callback: Handler::errors(...)
)->convertToExceptions(E_USER_ERROR, E_USER_WARNING);
```

Or:

```php
$errorHandled->register(
    callback: Handler::errors(...)
)->convertToExceptionsExcept(E_USER_DEPRECATED, E_USER_NOTICE);
```

The error will be sent to the error handler and then throw the exception.

### Register error handler function, convert to exceptions and use error reporting level

```php
class Handler {
    public function errors(Errorhandled $exception): void { /* do something */ }
}
```

```php
error_reporting(E_USER_ERROR) 
```

```php
$handler = new Handler();

$errorHandled->register(
    callback: $handler->errors(...),
)->convertToExceptions()->useErrorReportingLevel();
```

Only `E_USER_ERROR` will be passed to the handler and converted to exception.

## Tests

To run [tests](tests) you just need [composer](http://getcomposer.org/download/) and to execute the following:

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
