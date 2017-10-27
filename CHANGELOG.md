# CHANGELOG

## 1.1.6 - 2017-10-27

* Implemented `PSR-4 autoloader standard` from all library files.

* Implemented `PSR-2 coding standard` from all library PHP files.

* Implemented `PHPCS` to ensure that PHP code complies with `PSR2` code standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

* Added `ErrorHandler/phpcs.ruleset.xml` file.

* Deleted `ErrorHandler/src/bootstrap.php` file.

* Deleted `ErrorHandler/tests/bootstrap.php` file.

* Deleted `ErrorHandler/vendor` folder.

* Changed `Josantonius\ErrorHandler\Test\ErrorHandlerTest` class to  `Josantonius\ErrorHandler\ErrorHandlerTest` class.

## 1.1.5 - 2017-09-13

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

* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest` class.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testIfCustomExceptionHandlerIsActivated()` method.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testIfCustomErrorHandlerIsActivated()` method.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testException()` method.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testExceptionWithCustomMethodsWithoutShowDefaultView()` method.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testExceptionWithCustomMethodsAndShowDefaultView()` method.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testError()` method.
* Added `Josantonius\ErrorHandler\Test\ErrorHandlerTest->testErrorWithCustomMethodsWithoutShowDefaultView()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testErrorWithCustomMethodsAndShowDefaultView()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testGetErrorType()` method.

## 1.1.4 - 2017-07-16

* Deleted `Josantonius\ErrorHandler\Exception\ErrorHandlerException` class.
* Deleted `Josantonius\ErrorHandler\Exception\Exceptions` abstract class.
* Deleted `Josantonius\ErrorHandler\Exception\ErrorHandlerException->__construct()` method.

## 1.1.3 - 2017-05-15

* You can now add custom methods to run instead of displaying the default view.

* Added `Josantonius\ErrorHandler\ErrorHandler->setParams()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler::setCustomMethod()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->getCustomMethods()` method.

* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSetCustomMethod()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->_customMethodResponse()` method.

## 1.1.2 - 2017-03-18

* Some files were excluded from download and comments and readme files were updated.

## 1.1.1 - 2017-02-21

* Added `Josantonius\ErrorHandler\ErrorHandler->getPreviewCode()` method.
* Deleted `Josantonius\ErrorHandler\ErrorHandler->catchThrowable()` method.
* Deleted `Josantonius\ErrorHandler\ErrorHandler->catchException()` method.
* Changed `Josantonius\ErrorHandler\ErrorHandler->catchError()` method to `Josantonius\ErrorHandler\ErrorHandler->error()`.
* Changed `Josantonius\ErrorHandler\ErrorHandler->prepareException()` method to `Josantonius\ErrorHandler\ErrorHandler->exception()`.
* Changed `Josantonius\ErrorHandler\ErrorHandler->show()` method to `Josantonius\ErrorHandler\ErrorHandler->render()`.

## 1.1.0 - 2017-01-30

* Compatible with PHP 5.6 or higher.

## 1.0.0 - 2017-01-30

* Compatible only with PHP 7.0 or higher. In the next versions, the library will be modified to make it compatible with PHP 5.6 or higher.

## 1.0.0 - 2016-12-14

* Added `Josantonius\ErrorHandler\ErrorHandler` class.
* Added `Josantonius\ErrorHandler\ErrorHandler->__construct()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->catchThrowable()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->catchException()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->catchError()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->exception()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->prepareException()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->getErrorType()` method.
* Added `Josantonius\ErrorHandler\ErrorHandler->show()` method.

## 1.0.0 - 2016-12-14

* Added `Josantonius\ErrorHandler\Exception\ErrorHandlerException` class.
* Added `Josantonius\ErrorHandler\Exception\Exceptions` abstract class.
* Added `Josantonius\ErrorHandler\Exception\ErrorHandlerException->__construct()` method.

## 1.0.0 - 2016-12-14

* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest` class.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeException()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeWarning()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeNotice()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserError()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserNotice()` method.
* Added `Josantonius\ErrorHandler\Tests\ErrorHandlerTest->testSProvokeUserWarning()` method.
