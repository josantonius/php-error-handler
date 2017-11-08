# PHP ErrorHandler library

[![Latest Stable Version](https://poser.pugx.org/josantonius/ErrorHandler/v/stable)](https://packagist.org/packages/josantonius/ErrorHandler) [![Latest Unstable Version](https://poser.pugx.org/josantonius/ErrorHandler/v/unstable)](https://packagist.org/packages/josantonius/ErrorHandler) [![License](https://poser.pugx.org/josantonius/ErrorHandler/license)](LICENSE) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/fe730d61628249d280ecfb380a1ee3b8)](https://www.codacy.com/app/Josantonius/PHP-ErrorHandler?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Josantonius/PHP-ErrorHandler&amp;utm_campaign=Badge_Grade) [![Total Downloads](https://poser.pugx.org/josantonius/ErrorHandler/downloads)](https://packagist.org/packages/josantonius/ErrorHandler) [![Travis](https://travis-ci.org/Josantonius/PHP-ErrorHandler.svg)](https://travis-ci.org/Josantonius/PHP-ErrorHandler) [![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/) [![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/) [![CodeCov](https://codecov.io/gh/Josantonius/PHP-ErrorHandler/branch/master/graph/badge.svg)](https://codecov.io/gh/Josantonius/PHP-ErrorHandler)

[Versión en español](README-ES.md)

PHP library for handling exceptions and errors.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Tests](#tests)
- [Images](#images)
- [TODO](#-todo)
- [Contribute](#contribute)
- [Repository](#repository)
- [License](#license)
- [Copyright](#copyright)

---

## Requirements

This library is supported by **PHP versions 5.6** or higher and is compatible with **HHVM versions 3.0** or higher.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP ErrorHandler library**, simply:

    $ composer require Josantonius/ErrorHandler

The previous command will only install the necessary files, if you prefer to **download the entire source code** you can use:

    $ composer require Josantonius/ErrorHandler --prefer-source

You can also **clone the complete repository** with Git:

  $ git clone https://github.com/Josantonius/PHP-ErrorHandler.git

Or **install it manually**:

[Download ErrorHandler.php](https://raw.githubusercontent.com/Josantonius/PHP-ErrorHandler/master/src/ErrorHandler.php):

    $ wget https://raw.githubusercontent.com/Josantonius/PHP-ErrorHandler/master/src/ErrorHandler.php

## Available Methods

Available methods in this library:

### - Set customs methods to renderizate:

```php
ErrorHandler::setCustomMethod($class, $method, $repeat, $default);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $class | Class name or class object. | string|object| Yes | |
| $method | Method name. | string| Yes | |
| $repeat | Number of times to repeat method. | int | No | 0 |
| $default | Show default view. | boolean | No | false |

**# Return** (void)

## Quick Start

To use this class with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\ErrorHandler\ErrorHandler;
```

Or If you installed it **manually**, use it:

```php
require_once __DIR__ . '/ErrorHandler.php';

use Josantonius\ErrorHandler\ErrorHandler;
```

## Usage

Example of use for this library:

```php
/** 
 * It is recommended to instantiate the class in a base file as the index.php */

new ErrorHandler;

/**
 * Optionally you can enter one or more methods to be executed instead the 
 * default view. The indicated method will receive an array with the
 * following parameters:
 *
 * [
 *  'type'      => 'Error|Exception',
 *  'message'   => 'exception|error message',
 *  'file'      => 'exception|error file',
 *  'line '     => 'exception|error line',
 *  'code'      => 'exception|error code',
 *  'http-code' => 'HTTP response status code',
 *  'mode'      => 'PHP|HHVM',
 * ];
 * 
 */
 
$class   = $this;
$method  = 'customMethodResponse';
$times   = 0;
$default = true;

ErrorHandler::SetCustomMethod($class, $method, $times, $default);
```

## Tests 

To run [tests](tests) you just need [composer](http://getcomposer.org/download/) and to execute the following:

    $ git clone https://github.com/Josantonius/PHP-ErrorHandler.git
    
    $ cd PHP-ErrorHandler

    $ composer install

Run unit tests with [PHPUnit](https://phpunit.de/):

    $ composer phpunit

Run [PSR2](http://www.php-fig.org/psr/psr-2/) code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    $ composer phpcs

Run [PHP Mess Detector](https://phpmd.org/) tests to detect inconsistencies in code style:

    $ composer phpmd

Run all previous tests:

    $ composer tests

## Images

![image](resources/images/exception.png)
![image](resources/images/error.png)
![image](resources/images/notice.png)
![image](resources/images/warning.png)

## ☑ TODO

- [ ] Add new feature
- [ ] Improve tests
- [ ] Improve documentation
- [ ] Refactor code

## Contribute

If you would like to help, please take a look at the list of
[issues](https://github.com/Josantonius/PHP-ErrorHandler/issues) or the [To Do](#-todo) checklist.

**Pull requests**

* [Fork and clone](https://help.github.com/articles/fork-a-repo).
* Run the command `composer install` to install the dependencies.
  This will also install the [dev dependencies](https://getcomposer.org/doc/03-cli.md#install).
* Run the command `composer fix` to excute code standard fixers.
* Run the [tests](#tests).
* Create a **branch**, **commit**, **push** and send me a
  [pull request](https://help.github.com/articles/using-pull-requests).

## Repository

The file structure from this repository was created with [PHP-Skeleton](https://github.com/Josantonius/PHP-Skeleton).

## License

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

## Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

If you find it useful, let me know :wink:

You can contact me on [Twitter](https://twitter.com/Josantonius) or through my [email](mailto:hello@josantonius.com).