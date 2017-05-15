# PHP ErrorHandler library

[![Latest Stable Version](https://poser.pugx.org/josantonius/errorhandler/v/stable)](https://packagist.org/packages/josantonius/errorhandler) [![Total Downloads](https://poser.pugx.org/josantonius/errorhandler/downloads)](https://packagist.org/packages/josantonius/errorhandler) [![Latest Unstable Version](https://poser.pugx.org/josantonius/errorhandler/v/unstable)](https://packagist.org/packages/josantonius/errorhandler) [![License](https://poser.pugx.org/josantonius/errorhandler/license)](https://packagist.org/packages/josantonius/errorhandler)

[Versión en español](README-ES.md)

PHP library for handling exceptions and errors.

---

- [Installation](#installation)
- [Requirements](#requirements)
- [Quick Start and Examples](#quick-start-and-examples)
- [Available Methods](#available-methods)
- [Usage](#usage)
- [Tests](#tests)
- [Exception Handler](#exception-handler)
- [Images](#images)
- [Contribute](#contribute)
- [Repository](#repository)
- [Licensing](#licensing)
- [Copyright](#copyright)

---

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install PHP ErrorHandler library, simply:

    $ composer require Josantonius/ErrorHandler

The previous command will only install the necessary files, if you prefer to download the entire source code (including tests, vendor folder, exceptions not used, docs...) you can use:

    $ composer require Josantonius/ErrorHandler --prefer-source

Or you can also clone the complete repository with Git:

	$ git clone https://github.com/Josantonius/PHP-ErrorHandler.git
	
### Requirements

This library is supported by PHP versions 5.6 or higher and is compatible with HHVM versions 3.0 or higher.

### Quick Start and Examples

To use this class, simply:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\ErrorHandler\ErrorHandler;
```
### Available Methods

Available methods in this library:

```php
ErrorHandler::setCustomMethod();
```

### Usage

Example of use for this library:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\ErrorHandler\ErrorHandler;

/** 
 * It is recommended to instantiate the class in a base file as the index.php */

new ErrorHandler;

/**
 * Optionally you can enter one or more methods to be executed instead the 
 * default view. The indicated method will receive an array with the
 * following parameters:
 *
 * [
 * 	'type'      => 'Error|Exception',
 *	'message'   => 'exception|error message',
 *	'file'      => 'exception|error file',
 *	'line '     => 'exception|error line',
 *	'code'      => 'exception|error code',
 *	'http-code' => 'HTTP response status code',
 *	'mode'      => 'PHP|HHVM',
 * ];
 * 
 */
$class = $this;

$method = 'customMethodResponse';

$times = 0; // Times number to repeat this method in case of multiple errors

ErrorHandler::SetCustomMethod($class, $method, $times);
```

### Tests 

To use the [test](tests) class, simply:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\ErrorHandler\\Tests\\', __DIR__ . '/vendor/josantonius/errorhandler/tests');

use Josantonius\ErrorHandler\Tests\ErrorHandlerTest;

```
Available test methods in this library:

```php
ErrorHandlerTest->testSetCustomMethod();
ErrorHandlerTest->testSProvokeException();
ErrorHandlerTest->testSProvokeWarning();
ErrorHandlerTest->testSProvokeNotice();
ErrorHandlerTest->testSProvokeUserError();
ErrorHandlerTest->testSProvokeUserNotice();
ErrorHandlerTest->testSProvokeUserWarning();
```

### Exception Handler

This library uses [exception handler](src/Exception) that you can customize.

### Images

![image](resources/images/exception.png)
![image](resources/images/error.png)
![image](resources/images/notice.png)
![image](resources/images/warning.png)

### Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

### Repository

All files in this repository were created and uploaded automatically with [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Licensing

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

### Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

If you find it useful, let me know :wink:

You can contact me on [Twitter](https://twitter.com/Josantonius) or through my [email](mailto:hello@josantonius.com).