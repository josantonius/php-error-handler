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
[exception-handler](https://github.com/josantonius/php-exception-handler).

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Clases disponibles](#clases-disponibles)
  - [Clase ErrorHandler](#clase-errorhandler)
  - [Clase ErrorHandled](#clase-errorhandled)
  - [Clase ErrorException](#clase-errorexception)
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

- Sistema operativo: Linux | Windows.

- Versiones de PHP: 8.1.

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

### Clase ErrorException

`Josantonius\ErrorHandler\ErrorException` Extends
[ErrorException](https://www.php.net/manual/en/class.errorexception.php)

Obtener el archivo donde se produjo el error:

```php
public function getFile(): string;
```

Obtener el nivel del error:

```php
public function getLevel(): int;
```

Obtener el la línea donde se produjo el error:

```php
public function getLine(): int;
```

Obtener el mensaje del error:

```php
public function getMessage(): string;
```

Obtener el nombre del error:

```php
public function getName(): string;
```

### Clase ErrorHandled

`Josantonius\ErrorHandler\ErrorHandled`

Obtener el archivo donde se produjo el error:

```php
public function getFile(): string;
```

Obtener el nivel del error:

```php
public function getLevel(): int;
```

Obtener el la línea donde se produjo el error:

```php
public function getLine(): int;
```

Obtener el mensaje del error:

```php
public function getMessage(): string;
```

Obtener el nombre del error:

```php
public function getName(): string;
```

### Clase ErrorHandler

Convertir errores en excepciones:

```php
/**
 * La excepción será lanzada desde la instancia ErrorException.
 * 
 * @param int[] $errorLevel Define qué niveles de error se convertirán en excepciones.
 * 
 * @throws WrongErrorLevelException si el nivel de error no es válido.
 * 
 * @see https://www.php.net/manual/en/errorfunc.constants.php para ver los niveles disponibles.
 */
public function convertToExceptions(int ...$errorLevel): ErrorHandler;
```

Convertir errores en excepciones excepto algunos:

```php
/**
 * La excepción será lanzada desde la instancia ErrorException.
 * 
 * @param int[] $errorLevel Define qué niveles de error se convertirán en excepciones.
 * 
 * @throws WrongErrorLevelException si el nivel de error no es válido.
 * 
 * @see https://www.php.net/manual/en/errorfunc.constants.php para ver los niveles disponibles.
 */
public function convertToExceptionsExcept(int ...$errorLevel): ErrorHandler;
```

Registrar función para manejar errores:

```php
/**
 * El manejador de errores recibirá el objeto ErrorHandled.
 * 
 * @see https://www.php.net/manual/en/functions.first_class_callable_syntax.php
 */
public function register(callable $callback): ErrorHandler;
```

Utilizar los informes de errores para determinar qué errores se gestionan:

```php
/**
 * Si se utiliza el valor de error_reporting() para determinar qué errores se manejan.
 *
 * Si no se utiliza este método, todos los errores se enviarán al manejador.
 *
 * @see https://www.php.net/manual/en/function.error-reporting.php
 */
public function useErrorReportingLevel(): ErrorHandler;
```

## Excepciones utilizadas

```php
use Josantonius\ErrorHandler\Exceptions\WrongErrorLevelException;
```

## Uso

Ejemplo de uso para esta biblioteca:

### Convertir todos los errores en excepciones

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions();

// Todos los errores serán convertidos a excepciones.
```

### Convertir ciertos errores en excepciones

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions(E_USER_ERROR, E_USER_WARNING);

// Solo E_USER_ERROR and E_USER_WARNING serán convertidos a excepciones.
```

### Convertir todos los errores en excepciones excepto algunos

```php
use Josantonius\ErrorHandler\ErrorHandler;

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptionsExcept(E_USER_DEPRECATED, E_USER_NOTICE);

// Todos los errores excepto E_USER_DEPRECATED y E_USER_NOTICE serán convertidos a excepciones.
```

### Convertir en excepciones utilizando el nivel de notificación de errores

```php
use Josantonius\ErrorHandler\ErrorHandler;

error_reporting(E_USER_ERROR);

$errorHandler = new ErrorHandler();

$errorHandler->convertToExceptions()->useErrorReportingLevel();

// Solo E_USER_ERROR será convertido en excepción.
```

### Convertir en excepciones y utilizar un manejador de excepciones

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

// Solo E_USER_ERROR será convertido en excepción.
```

### Registrar una función para manejar errores

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

// Todos los errores se convertirán en excepciones.
```

### Registrar una función para manejar errores y convertirlos en excepciones

```php
use Josantonius\ErrorHandler\ErrorHandled;
use Josantonius\ErrorHandler\ErrorHandler;

class Handler {
    public static function errors(Errorhandled $exception): void { /* hacer algo */ }
}

$errorHandler = new ErrorHandler();

$errorHandler->register(
    callback: Handler::errors(...)
)->convertToExceptions();

// El error será enviado al manejador de errores y luego lanzará la excepción.
```

### Registrar manejador, convertir en excepciones y usar el nivel de reporte de errores

```php
error_reporting(E_USER_ERROR);

class Handler {
    public function errors(Errorhandled $exception): void { /* hacer algo */ }
}

$handler = new Handler();

$errorHandled->register(
    callback: $handler->errors(...),
)->convertToExceptions()->useErrorReportingLevel();

// Solo E_USER_ERROR se pasará al manejador y se convertirá en excepción.
```

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
