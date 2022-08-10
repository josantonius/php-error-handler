# PHP ErrorHandler library

[![Latest Stable Version](https://poser.pugx.org/josantonius/error-handler/v/stable)](https://packagist.org/packages/josantonius/error-handler)
[![License](https://poser.pugx.org/josantonius/error-handler/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/error-handler/downloads)](https://packagist.org/packages/josantonius/error-handler)
[![CI](https://github.com/josantonius/php-error-handler/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-error-handler/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-error-handler/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-error-handler)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Traducciones**: [English](/README.md)

Biblioteca PHP para manejar errores.

Para manejar excepciones puedes utilizar la biblioteca
[josantonius/error-handler](https://github.com/josantonius/php-error-handler).

---

- [Instalación](#instalación)
- [Requisitos](#requisitos)
- [Cómo empezar](#cómo-empezar)
- [Clases disponibles](#clases-disponibles)
  - [ErrorHandler](#errorhandler)
  - [ErrorHandled](#errorhandled)
  - [ErrorException](#errorexception)
- [Excepciones utilizadas](#excepciones-utilizadas)
- [Uso](#uso)
- [Tests](#tests)
- [Tareas pendientes](#tareas-pendientes)
- [Registro de Cambios](#registro-de-cambios)
- [Contribuir](#contribuir)
- [Patrocinar](#patrocinar)
- [Licencia](#licencia)

---

## Requisitos

Esta biblioteca es compatible con las versiones de PHP: 8.1.

## Instalación

La mejor forma de instalar esta extensión es a través de [Composer](http://getcomposer.org/download/).

Para instalar **PHP ErrorHandler library**, simplemente escribe:

```console
composer require josantonius/error-handler
```

El comando anterior sólo instalará los archivos necesarios,
si prefieres **descargar todo el código fuente** puedes utilizar:

```console
composer require josantonius/error-handler --prefer-source
```

También puedes **clonar el repositorio** completo con Git:

```console
git clone https://github.com/josantonius/php-error-handler.git
```

## Clases disponibles

### ErrorHandler

Métodos disponibles en `Josantonius\ErrorHandler\ErrorHandler`:

#### Convertir errores en excepciones

```php
$errorHandler->convertToExceptions(int ...$errorLevel): self
```

**@param** `int[]` `$erroLevel` Define qué niveles de error se convertirán en excepciones.

**@throws** [WrongErrorLevelException](#wrongerrorlevelexception)

**@see** <https://www.php.net/manual/en/errorfunc.constants.php> para ver los niveles
de error disponibles.

**La excepción será lanzada desde la instancia [ErrorException](#errorexception).**

#### Convertir errores en excepciones excepto algunos

```php
$errorHandler->convertToExceptionsExcept(int ...$errorLevel): self
```

**@param** `int[]` `$erroLevel` Define qué niveles de error se convertirán en excepciones.

**@throws** [WrongErrorLevelException](#wrongerrorlevelexception)

**@see** <https://www.php.net/manual/en/errorfunc.constants.php> para ver los niveles
de error disponibles.

**La excepción será lanzada desde la instancia [ErrorException](#errorexception).**

#### Registrar función para manejar errores

```php
$errorHandler->register(callable $callback): self
```

**@see** <https://www.php.net/manual/en/functions.first_class_callable_syntax.php> para más
información sobre la sintaxis de las llamadas de primera clase.

El manejador de errores recibirá el objeto [ErrorHandled](#errorhandled).

#### Utilizar los informes de errores para determinar qué errores se gestionan

```php
$errorHandler->useErrorReportingLevel(): self
```

**@see** <https://www.php.net/manual/en/function.error-reporting.php> para más información.

Si se utiliza el valor de error_reporting() para determinar qué errores se manejan.

**Si no se utiliza este método, todos los errores se enviarán al manejador.**

### ErrorHandled

Métodos disponibles en `Josantonius\ErrorHandler\ErrorHandled`:

#### Obtener el archivo donde se produjo el error

```php
$errorHandled->getFile(): string
```

#### Obtener el mensaje del error

```php
$errorHandled->getMessage(): string
```

#### Obtener el nivel del error

```php
$errorHandled->getLevel(): int
```

#### Obtener el la línea donde se produjo el error

```php
$errorHandled->getLine(): int
```

#### Obtener el nombre del error

```php
$errorHandled->getName(): string
```

### ErrorException

Los métodos disponibles en `Josantonius\ErrorHandler\Exceptions\ErrorException` son los mismos
que en [ErrorHandled](#errorhandled).

Esta clase extiende de [ErrorException](https://www.php.net/manual/en/class.errorexception.php).

## Excepciones utilizadas

### WrongErrorLevelException

`Josantonius\ErrorHandler\Exceptions\WrongErrorLevelException` si el nivel de error no es válido.

## Cómo empezar

Para utilizar esta biblioteca:

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();
```

## Uso

Ejemplo de uso para esta biblioteca:

### Convertir todos los errores en excepciones

```php
$errorHandler->convertToExceptions();
```

### Convert certain errors to exceptions

```php
$errorHandler->convertToExceptions(E_USER_ERROR, E_USER_WARNING);
```

Solo `E_USER_ERROR` y `E_USER_WARNING` serán convertidos a excepciones.

### Convertir todos los errores en excepciones excepto algunos

```php
$errorHandler->convertToExceptionsExcept(E_USER_DEPRECATED, E_USER_NOTICE);
```

Todos los errores excepto `E_USER_DEPRECATED` y `E_USER_NOTICE` serán convertidos a excepciones.

### Convertir en excepciones utilizando el nivel de notificación de errores

```php
error_reporting(E_USER_ERROR) 
```

```php
$errorHandler->convertToExceptions()->useErrorReportingLevel();
```

Solo `E_USER_ERROR` será convertido en excepción.

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

Solo `E_USER_ERROR` será convertido en excepción.

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

### Registrar una función para manejar errores y convertirlos en excepciones

```php
class Handler {
    public static function errors(Errorhandled $exception): void { /* hacer algo */ }
}
```

```php
$errorHandled->register(
    callback: Handler::errors(...)
)->convertToExceptions();
```

O:

```php
$errorHandled->register(
    callback: Handler::errors(...)
)->convertToExceptions(E_USER_ERROR, E_USER_WARNING);
```

O:

```php
$errorHandled->register(
    callback: Handler::errors(...)
)->convertToExceptionsExcept(E_USER_DEPRECATED, E_USER_NOTICE);
```

El error será enviado al manejador de errores y luego lanzará la excepción.

### Registrar manejador, convertir en excepciones y usar el nivel de reporte de errores

```php
class Handler {
    public function errors(Errorhandled $exception): void { /* hacer algo */ }
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

Solo `E_USER_ERROR` se pasará al manejador y se convertirá en excepción.

## Tests

Para ejecutar las [pruebas](tests) necesitarás [Composer](http://getcomposer.org/download/)
y seguir los siguientes pasos:

```console
git clone https://github.com/josantonius/php-error-handler.git
```

```console
cd php-error-handler
```

```console
composer install
```

Ejecutar pruebas unitarias con [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Ejecutar pruebas de estándares de código con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Ejecutar pruebas con [PHP Mess Detector](https://phpmd.org/) para
detectar inconsistencias en el estilo de codificación:

```console
composer phpmd
```

Ejecutar todas las pruebas anteriores:

```console
composer tests
```

## Tareas pendientes

- [ ] Añadir nueva funcionalidad
- [ ] Mejorar pruebas
- [ ] Mejorar documentación
- [ ] Mejorar la traducción al inglés en el archivo README
- [ ] Refactorizar código para las reglas de estilo de código deshabilitadas
(ver [phpmd.xml](phpmd.xml) y [phpcs.xml](phpcs.xml))

## Registro de Cambios

Los cambios detallados de cada versión se documentan en las
[notas de la misma](https://github.com/josantonius/php-error-handler/releases).

## Contribuir

Por favor, asegúrate de leer la [Guía de contribución](CONTRIBUTING.md) antes de hacer un
*pull request*, comenzar una discusión o reportar un *issue*.

¡Gracias por [colaborar](https://github.com/josantonius/php-error-handler/graphs/contributors)! :heart:

## Patrocinar

Si este proyecto te ayuda a reducir el tiempo de desarrollo,
[puedes patrocinarme](https://github.com/josantonius/lang/es-ES/README.md#patrocinar)
para apoyar mi trabajo :blush:

## Licencia

Este repositorio tiene una licencia [MIT License](LICENSE).

Copyright © 2016-actualidad, [Josantonius](https://github.com/josantonius/lang/es-ES/README.md#contacto)
