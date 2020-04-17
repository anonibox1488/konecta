<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Documentación
Este es el código de la prueba solicitada por konecta. Es un proyecto creado con Laravel 5.8 implementando jwt. 


## Instalación

Para el correcto funcionamiento del código, se deben realizar los siguientes pasos:

- clorar el repositorio
```
git clone https://github.com/anonibox1488/konecta
```
- Ingresar a la carpeta 
```
cd konecta
```
- Intalacion de dependencias 
```
composer install
```
- Debe crear una base de datos en Mysql
- Crear el archivo .env
```
cp .env.example .env
```
- En el archivo .env modificar los valores de
```
DB_DATABASE=nombre_BD
DB_USERNAME=usuario
DB_PASSWORD=clave
```
- Ejecugar el siguiente comando para generar la clave de laravel
```
php artisan key:generate
```
- Ejecugar el siguiente comando para generar la clave de jwt
```
php artisan jwt:secret
```
- Ejecujar migraciones
```
php artisan migrate
```
- Ejecujar seeder
```
php artisan db:seed
```
- El seeder  creara dos usuarios:
*Usuario con rol administrador
```
email: admin@mail.com
password: 123456
```
*Usuario con rol vendedor
```
email: seller@mail.com
password: 123456
```
- Ya puedes ejecutar el servidor y probar el codigo. 