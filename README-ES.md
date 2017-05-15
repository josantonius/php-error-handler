# PHP ErrorHandler library

[![Latest Stable Version](https://poser.pugx.org/josantonius/errorhandler/v/stable)](https://packagist.org/packages/josantonius/errorhandler) [![Total Downloads](https://poser.pugx.org/josantonius/errorhandler/downloads)](https://packagist.org/packages/josantonius/errorhandler) [![Latest Unstable Version](https://poser.pugx.org/josantonius/errorhandler/v/unstable)](https://packagist.org/packages/josantonius/errorhandler) [![License](https://poser.pugx.org/josantonius/errorhandler/license)](https://packagist.org/packages/josantonius/errorhandler)

[English version](README.md)

Librería PHP para manejar excepciones y errores.

---

- [Instalación](#instalación)
- [Requisitos](#requisitos)
- [Cómo empezar y ejemplos](#cómo-empezar-y-ejemplos)
- [Métodos disponibles](#métodos-disponibles)
- [Uso](#uso)
- [Tests](#tests)
- [Manejador de excepciones](#manejador-de-excepciones)
- [Imágenes](#imagenes)
- [Contribuir](#contribuir)
- [Repositorio](#repositorio)
- [Licencia](#licencia)
- [Copyright](#copyright)

---

### Instalación 

La mejor forma de instalar esta extensión es a través de [composer](http://getcomposer.org/download/).

Para instalar PHP ErrorHandler library, simplemente escribe:

    $ composer require Josantonius/ErrorHandler

El comando anterior sólo instalará los archivos necesarios, si prefieres descargar todo el código fuente (incluyendo tests, directorio vendor, excepciones no utilizadas, documentos...) puedes utilizar:

    $ composer require Josantonius/ErrorHandler --prefer-source

También puedes clonar el repositorio completo con Git:

	$ git clone https://github.com/Josantonius/PHP-ErrorHandler.git

### Requisitos

Esta ĺibrería es soportada por versiones de PHP 5.6 o superiores y es compatible con versiones de HHVM 3.0 o superiores.

### Cómo empezar y ejemplos

Para utilizar esta librería, simplemente:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\ErrorHandler\ErrorHandler;
```
### Métodos disponibles

Métodos disponibles en esta librería:

```php
ErrorHandler::setCustomMethod();
```

### Uso

Ejemplo de uso para esta librería:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\ErrorHandler\ErrorHandler;

/* Se recomienda intanciar la clase en un archivo base como el index.php */

new ErrorHandler;

/**
 * Opcionalmente puedes introducir uno o más métodos para ejecutar en lugar de
 * la vista predeterminada. El método indicado recibirá un array con los
 * siguientes parámetros:
 *
 * [
 * 	'type'      => 'Error|Exception',
 *	'message'   => 'exception|error mensaje',
 *	'file'      => 'exception|error archivo',
 *	'line '     => 'exception|error línea',
 *	'code'      => 'exception|error código de error',
 *	'http-code' => 'Código de estado de respuesta HTTP',
 *	'mode'      => 'PHP|HHVM',
 * ];
 * 
 */
$class = $this;

$method = 'customMethodResponse';

$times = 0; // Número de veces para repetir este método en caso de errores múltiples

ErrorHandler::SetCustomMethod($class, $method, $times);
```

### Tests 

Para utilizar la clase de [pruebas](tests), simplemente:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\ErrorHandler\\Tests\\', __DIR__ . '/vendor/josantonius/errorhandler/tests');

use Josantonius\ErrorHandler\Tests\ErrorHandlerTest;
```
Métodos de prueba disponibles en esta librería:

```php
ErrorHandlerTest->testSProvokeException();
ErrorHandlerTest->testSProvokeWarning();
ErrorHandlerTest->testSProvokeNotice();
ErrorHandlerTest->testSProvokeUserError();
ErrorHandlerTest->testSProvokeUserNotice();
ErrorHandlerTest->testSProvokeUserWarning();
```

### Manejador de excepciones

Esta librería utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.

### Imágenes

![image](resources/images/exception.png)
![image](resources/images/error.png)
![image](resources/images/notice.png)
![image](resources/images/warning.png)

### Contribuir
1. Comprobar si hay incidencias abiertas o abrir una nueva para iniciar una discusión en torno a un fallo o función.
1. Bifurca la rama del repositorio en GitHub para iniciar la operación de ajuste.
1. Escribe una o más pruebas para la nueva característica o expón el error.
1. Haz cambios en el código para implementar la característica o reparar el fallo.
1. Envía pull request para fusionar los cambios y que sean publicados.

Esto está pensado para proyectos grandes y de larga duración.

### Repositorio

Los archivos de este repositorio se crearon y subieron automáticamente con [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Licencia

Este proyecto está licenciado bajo **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.

### Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

Si te ha resultado útil, házmelo saber :wink:

Puedes contactarme en [Twitter](https://twitter.com/Josantonius) o a través de mi [correo electrónico](mailto:hello@josantonius.com).