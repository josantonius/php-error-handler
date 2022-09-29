# CHANGELOG

## [v2.0.2](https://github.com/josantonius/php-error-handler/releases/tag/v2.0.2) (2022-09-29)

* The notation type in the test function names has been changed from camel to snake case for readability.

* Functions were added to document the methods and avoid confusion.

* Disabled the ´CamelCaseMethodName´ rule in ´phpmd.xml´ to avoid warnings about function names in tests.

* The alignment of the asterisks in the comments has been fixed.

* Tests for Windows have been added.

## [v2.0.1](https://github.com/josantonius/php-error-handler/releases/tag/v2.0.1) (2022-08-11)

* Documentation was improved.

## [v2.0.0](https://github.com/josantonius/php-error-handler/releases/tag/v2.0.0) (2022-08-10)

> Version 1.x is considered as deprecated and unsupported.
> In this version (2.x) the library was completely restructured.
> It is recommended to review the documentation for this version and make the necessary changes
> before starting to use it, as it not be compatible with version 1.x.

---

* The library was completely refactored.

* Support for PHP version 8.1.

* Support for earlier versions of PHP **8.1** is discontinued.

* In this version exceptions are no longer handled.
You can use [josantonius/exception-handler](https://github.com/josantonius/php-exception-handler)
to handle them.

* HTML error rendering has also been discontinued.

* The package name was changed from `josantonius/errorhandler` to `josantonius/error-handler`.

* Improved documentation; `README.md`, `CODE_OF_CONDUCT.md`, `CONTRIBUTING.md` and `CHANGELOG.md`.

* Removed `Codacy`.

* Removed `PHP Coding Standards Fixer`.

* The `master` branch was renamed to `main`.

* The `develop` branch was added to use a workflow based on `Git Flow`.

* `Travis` is discontinued for continuous integration. `GitHub Actions` will be used from now on.

* Added `.github/CODE_OF_CONDUCT.md` file.
* Added `.github/CONTRIBUTING.md` file.
* Added `.github/FUNDING.yml` file.
* Added `.github/workflows/ci.yml` file.
* Added `.github/lang/es-ES/CODE_OF_CONDUCT.md` file.
* Added `.github/lang/es-ES/CONTRIBUTING.md` file.
* Added `.github/lang/es-ES/LICENSE` file.
* Added `.github/lang/es-ES/README` file.

* Deleted `.travis.yml` file.
* Deleted `.editorconfig` file.
* Deleted `CONDUCT.MD` file.
* Deleted `README-ES.MD` file.
* Deleted `.php_cs.dist` file.

## [1.1.8](https://github.com/josantonius/php-error-handler/releases/tag/1.1.8) (2018-01-06)

* The tests were fixed.

* Changes in documentation.

## [1.1.7](https://github.com/josantonius/php-error-handler/releases/tag/1.1.7) (2017-11-08)

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to PSR standards.

## [1.1.6](https://github.com/josantonius/php-error-handler/releases/tag/1.1.6) (2017-10-27)

* Implemented `PSR-4 autoloader standard` from all library files.

* Implemented `PSR-2 coding standard` from all library PHP files.

* Implemented `PHPCS` to ensure that PHP code complies with `PSR2` code standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

* Added `ErrorHandler/phpcs.ruleset.xml` file.

* Deleted `ErrorHandler/src/bootstrap.php` file.

* Deleted `ErrorHandler/tests/bootstrap.php` file.

* Deleted `ErrorHandler/vendor` folder.

## [1.1.5](https://github.com/josantonius/php-error-handler/releases/tag/1.1.5) (2017-09-13)

* Unit tests supported by `PHPUnit` were added.

* The repository was synchronized with Travis CI to implement continuous integration.

* Added `ErrorHandler/src/bootstrap.php` file

* Added `ErrorHandler/tests/bootstrap.php` file.

* Added `ErrorHandler/phpunit.xml.dist` file.
* Added `ErrorHandler/_config.yml` file.
* Added `ErrorHandler/.travis.yml` file.

* Added `ErrorHandler/public/template/view.php` file.

* Added `ErrorHandler/public/css/styles.php` file.

* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest` class.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeException()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeWarning()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeNotice()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserError()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserNotice()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserWarning()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSetCustomMethod()` method.
* Deleted `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->_customMethodResponse()` method.

## [1.1.4](https://github.com/josantonius/php-error-handler/releases/tag/1.1.4) (2017-07-16)

* Deleted `Josantonius\ErrorHandler\Exception\ErrorHandlerException` class.
* Deleted `Josantonius\ErrorHandler\Exception\Exceptions` abstract class.
* Deleted `Josantonius\ErrorHandler\Exception\ErrorHandlerException->__construct()` method.

## [1.1.3](https://github.com/josantonius/php-error-handler/releases/tag/1.1.3) (2017-05-15)

* You can now add custom methods to run instead of displaying the default view.

* Added `Josantonius\ErrorHandler\ErrorHandler->setParams()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler::setCustomMethod()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->getCustomMethods()` method.

* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSetCustomMethod()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->_customMethodResponse()` method.

## [1.1.2](https://github.com/josantonius/php-error-handler/releases/tag/1.1.2) (2017-03-18)

* Some files were excluded from download and comments and readme files were updated.

## [1.1.1](https://github.com/josantonius/php-error-handler/releases/tag/1.1.1) (2017-02-21)

* Added `Josantonius\ErrorHandler\ErrorHandler->getPreviewCode()` method.
* Deleted `Josantonius\ErrorHandler\ErrorHandler->catchThrowable()` method.
* Deleted `Josantonius\ErrorHandler\ErrorHandler->catchException()` method.

## [1.1.0](https://github.com/josantonius/php-error-handler/releases/tag/1.1.0) (2017-01-30)

* Compatible with PHP 5.6 or higher.

## [1.0.0](https://github.com/josantonius/php-error-handler/releases/tag/1.0.0) (2016-12-14)

* Compatible only with PHP 7.0 or higher.
In the next versions, the library will be modified to make it compatible with PHP 5.6 or higher.

* Added `Josantonius\ErrorHandler\ErrorHandler` class.
* Added `Josantonius\ErrorHandler\ErrorHandler->__construct()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->catchThrowable()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->catchException()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->catchError()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->exception()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->prepareException()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->getErrorType()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->show()` method.

* Added `Josantonius\ErrorHandler\Exception\ErrorHandlerException` class.
* Added `Josantonius\ErrorHandler\Exception\Exceptions` abstract class.
* Added `Josantonius\ErrorHandler\Exception\ErrorHandlerException->__construct()` method.

* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest` class.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeException()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeWarning()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeNotice()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserError()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserNotice()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserWarning()` method.
