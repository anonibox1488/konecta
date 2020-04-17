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
- Ejecujar migraciones
```
php artisan migrate
```
- Ejecujar seeder
```
php artisan db:seed
```
- Ya puedes ejecutar el servidor y probar el codigo. 