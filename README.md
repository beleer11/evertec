# Prueba de una tienda con método de pago Place To Pay.

_Prueba de desarrollo para Evertec._


### requisitos

_Ambiente requerido_

- Php 7.2.0 con phpCli habilitado para la ejecución de comando.
- Mysql 5.7.19.
- Composer 
- Extensión pdo_sqlite habilitada.

### Instalación

1. Clonar el repositorio en el folder del servidor web en uso o en el de su elección, **este folder debe tener permisos para que php se pueda ejecutar por CLI y permisos de lectura y escritura para el archivo .env**.

```sh 
git clone https://github.com/beleer11/evertec.git
```

2. Instalar paquetes ejecutando en la raíz del folder.

```sh 
composer install
```
3. Crear BD con COLLATE 'utf8mb4_general_ci', ejemplo.

```sh 
`CREATE DATABASE evertec COLLATE 'utf8mb4_general_ci';`
```

4. Duplique el archivo `.env.example` incluido en uno de nombre `.env` y dentro de este ingrese los valores de las variables de entorno necesarias, las básicas serían las siguientes:
- `DB_HOST="value"` Variable de entorno para el host de BD.
- `DB_PORT="value"` Variable de entorno para el puerto de BD.
- `DB_DATABASE="value"` Variable de entorno para el nombre de BD.
- `DB_USERNAME="value"` Variable de entorno para el usuario de BD.
- `DB_PASSWORD="value"` Variable de entorno para la contraseña de BD.
- `PLACE_TO_PAY_LOGIN="value"` Variable de entorno para el id del login de la cuenta Place To Pay.
- `PLACE_TO_TRAN_KEY="value"` Variable de entorno para el TranKey de la cuenta Place To Pay.
- `PLACE_TO_TRAN_URL="value"` Variable de entorno para la URL de la cuenta Place To Pay.
- `PRODUCT_PRICE="value"` Variable de entorno para el precio del producto. Entero valido.
- `PRODUCT_NAME="value"` Variable de entorno para el nombre del producto.
- `EXPIRED_MINUTES_PTP="value"` Variable de entorno que especifica la cantidad de minutos para expirar la transacción. Entero valido.
- `MINUTES_VERIFY_PAY="value"` Variable de entorno que especifica cada cuantos minutos se ejecuta la validación de estado de los pagos, no debe sobrepasar los 60.
- `EXPIRED_DAYS_ORDER="value"` Variable de entorno que especifica la cantidad de días para expirar la orden. Entero valido.
- `TIME_EXPIRED_ORDERS="value"` Variable de entorno que especifica la hora del día en la que se ejecuta la expiración de ordenes debe estar en formato de hora y minutos ejemplo a las 7 de la noche seria 19:00, y a las 7 de la mañana seria 07:00 .

##### Notas:
```sh 
El sistema envía notificaciones por correo, si desea enviarlas configure las variables para este envío. De lo contrario mantenga la configuración de almacenamiento en log por defecto marcada en el archivo `.env.example`, para ver los correos en el log revise el archivo ubicado en `storage/logs/laravel.log`.
```
```sh 
Si cambia las variables de entorno referentes al acceso a gateway de pago es recomendable reiniciar el servidor para que retome las variables dentro de los proveedores de servicios.
```
5. En la raíz del sitio ejecutar.
- `php artisan key:generate && php artisan config:cache && php artisan config:clear` Genera la llave para el cifrado de proyecto y refresca las configuraciones.
- `php artisan migrate` Crea la estructura de BD. 
- `php artisan db:seed` Carga los datos de ejemplo, en este caso el árbol inicial enviado en la prueba.
- `php artisan storage:link` Genera el link simbólico entre "public/storage" y "storage/app/public".
- `php artisan permission:cache-reset` Limpia la cache de los permisos.
- `php artisan serve` Arranca el servidor web bajo la url [http://127.0.0.1:8000](http://127.0.0.1:8000).

##### Nota: 
Si desea puede ejecutar todos los comandos anteriores juntos si ejecuta 
```sh
php artisan key:generate && php artisan config:cache && php artisan config:clear && php artisan migrate && php artisan db:seed && php artisan storage:link && php artisan serve
```
6. En la raíz del sitio usar este comando si se desea ejecutar las pruebas.
```sh 
vendor/bin/phpunit
```

7. Agregar la siguiente entrada Cron a tu servidor, cambiando `path-to-your-project` por la ruta al proyecto.
```sh 
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

8. Accede al sitio usando la url [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Descripción general de las URL's 

Método|URL|Descripción
 ------ | ------ | ------ 
 GET|/|Url de inicio del sitio.
GET|login|Formulario de ingreso.
POST|login|Autentica.
POST|logout|Logout.
GET|notification/unread/__{id}__|Marca una notificación como leida.
GET|orders|Vista con el listado de ordenes y acciones disponibles.
POST|orders|Crea una orden.
GET|orders/__{order}__|Vista con el detalle de la compañía.
GET|orders/__{order}__/pay|Crea una transacción para pago.
GET|register|Formulario de registro.
POST|register|Registra usuario.
GET|transactions/receive/__{gateway}__/__{uuid}__|Recibe una notificación de cambio de estado en transacción.

##### Nota: 
- El parámetro __{id}__ Id de la notificación, debe ser numérico.
- El parámetro __{order}__ Id de la orden, debe ser numérico.
- El parámetro __{gateway}__ Nombre de la plataforma de pago.
- El parámetro __{uuid}__ UUID de la transacción.

## Usuarios de prueba disponibles.

Email|Password|Rol|Permisos
 ------ | ------ | ------ | ------ 
admin@evertec.com|password|SuperAdministrator|Puede realizar todas las acciones disponibles.
admin_ordenes@evertec.com|password|Ordenes|Tiene permiso para ver todas las ordenes.
mussebrahiam11@gmail.com|123456|N/A| Tiene solo acceso a sus ordenes.

##### Nota: 
Todos los usuarios que se registren solo pueden interactuar con sus ordenes.

## Autor️ 

* **Brahiam Musse** [mussebrahiam11@gmail.com](mailto:mussebrahiam11@gmail.com)


------------------------
