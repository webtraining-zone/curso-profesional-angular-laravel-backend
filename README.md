# Curso Profesional Angular + Laravel (Back end)

Un ejemplo de RESTful API creado con Laravel durante el [Curso de Aplicaciones Multi-idioma con Angular 8](https://webtraining.zone/cursos/curso-de-aplicaciones-multi-idioma-con-angular-y-linked-data), disponible en 
[Webtraining.Zone](https://webtraining.zone/cursos/curso-de-aplicaciones-multi-idioma-con-angular-y-linked-data).

![Curso de Aplicaciones Multi-idioma con Angular 8](https://webtraining.zone/img/metadata-courses/curso-angular-linked-data-2.jpg)

## Pre-requisitos

1) Este RESTful API fue creado con [Laravel](https://laravel.com/), que nos exige una versión moderna de PHP y algunas de sus extensiones instaladas:

```
PHP >= 7.1.3
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
```

Para desarrollo y configuración rápida te recomendamos instalar un meta-paquete como XAMPP 
[descargar aquí](https://www.apachefriends.org/download.html). Sólo hay que estar seguros de descargar
XAMPP con PHP 7.1 (recomendado). Esto te instalará MySQL, PHPMyAdmin, Apache y claro un PHP moderno.

2) También necesitaremos composer ([descargar aquí](https://getcomposer.org/)) para descargar las dependencias de [Laravel Lumen](https://lumen.laravel.com/).

3) Algo que recomendamos es instalar un cliente para probar todos tus *end-points*. 
Nuestra herramienta favorita para tal propósito es [Postman](https://www.getpostman.com/) que tiene una
aplicación gratuita para Windows, GNU/Linux y OS X. Después de instalar Postman puedes **importar** una colección
de *end-points* que hemos creado para ti y que está disponible en: `<REPO>/webtraining/Project Manager API.postman_collection`.

Una vez importada tu colección tendrás acceso a todos los servicios de Lumen como en la siguiente imagen:

![Postman](https://raw.githubusercontent.com/webtrainingmx/rest-api-project-manager-junio-2017/master/webtraining/img/postman-get-users.png)


## Instalación para Desarrollo

1) Instalar dependencias de Composer (ejecutar desde el directorio raiz de este proyecto).
```
composer install
```
2) Configurar base de datos:

Para tu comodidad hemos creado un *MySQL dump* en este archivo `<REPO>/database/sql/project_manager_db_lumen.sql`.
Este archivo contiene dos usuarios, un proyecto y una tarea de demostración.

2.1) Importa esta base de datos usando algún cliente web como PHPMyAdmin o Sequel Pro.
2.2) Crea un usuario que se pueda conectar a esta base de datos, por ejemplo:
```
Base de datos:  laravel_funding_db
Usuario:        laravel_funding_user
Constraseña:    D5xNL5LpHPVTxwz4
```

2.3) Crea un archivo llamado `.env` en la raíz de este proyecto, con los siguientes datos:
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:x0jrh73mp1nSWsXVNBus0NAGhyFw2C6zHlE6WumlyXU=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_funding_db
DB_USERNAME=laravel_funding_user
DB_PASSWORD=D5xNL5LpHPVTxwz4

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

Lo importante en este caso son los datos de conexión a la base de datos y la generación de tu `APP_KEY` que puedes 
generar usando este [Random Generator](https://webtraining.zone/random-generator).

Para crear un usuario en MySQL podemos usar:

```
CREATE USER 'laravel_funding_user'@'localhost' IDENTIFIED BY 'D5xNL5LpHPVTxwz4';
GRANT ALL PRIVILEGES ON laravel_funding_db.* TO 'project_mgr_user_lumen'@'localhost';
FLUSH PRIVILEGES;
```

**Nota para MySQL 8**

Si estás usando MySQL 8, la forma de creación de tu base de datos es como sigue:

```
CREATE SCHEMA `laravel_funding_db` DEFAULT CHARACTER SET utf8 ;
```

3) Iniciar tu servidor en el puerto 8085
```
php artisan serve
```

## Preguntas Frecuentes

**¿Por qué cuando visito un *end-point*, por ejemplo `/api/v1/projects` veo un código JSON de "Unauthorized"?**

Recuerda que todos los *end-points* de nuestro RESTful API sólo pueden ser llamados utilizando
el *header* **Content-Type** como **application/json** (es decir, con llamados AJAX
debería funcionar correctamente).


**Cuando intento arrancar el servidor en el puerto 8000 me dice que el puerto ya está ocupado ¿cómo lo soluciono?**

Simplemente cambia el puerto de conexión, por ejemplo si queremos arrancar el servidor en el puerto 8089:
```
php artisan serve --port=8080
```
