# CHANGELOG

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
