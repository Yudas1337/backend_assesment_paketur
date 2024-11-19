<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Backed Assesment Paketur

this is the repository of the project from Backend Assessment Paketur

![](docs/erd_database.png)

## Project Setup

1. **Dependencies Installation**

   Run and Install dependent packages.
   ```bash
   composer install

2. **Create Database**   
   create db named 'paketur_db' in PostgreSQL or Mysql.


3. Edit .env.example file and rename it to .env
4. Edit .env file and change the database configurations. For example using PostgreSQL:
    ```bash
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=paketur_db
    DB_USERNAME=postgres
    DB_PASSWORD=yudas1337
5. Add Another Environment Variable for JWT Secret Key
     ```bash
    JWT_SECRET=
    JWT_SHOW_BLACKLIST_EXCEPTION=true

6. Change the locale to ID so the validation message and faker data will be in Indonesian.
    ```bash
    APP_LOCALE=id
    APP_FALLBACK_LOCALE=id
    APP_FAKER_LOCALE=id_ID
    ```
7. Add Auth Guard api to .env file
    ```bash
   AUTH_GUARD=api

8. Run this command to generate a new JWT secret key:
    ```bash
   php artisan jwt:secret

9. Run the migration and seeding command:
    ```bash
   php artisan migrate:fresh --seed
    ```
10. Run the server:
    ```bash
    php artisan serve
    ```
11. Run worker so the laravel can dispatch the queue jobs
    ```bash
    php artisan queue:work

12. and open the browser and visit http://localhost:8000 or http://127.0.0.1:8000 . More details in Postman
    Documentation.


13. Run The Test (optinonal):
    ```bash
    php artisan test

## API Postman Documentation

for API and Endpoint Documentation can be accesed here:
https://documenter.getpostman.com/view/8729842/2sAYBREt5T

## Validation Rules Explaination

## Third Party Libraries

- [Spatie, Laravel Permissions](https://spatie.be/docs/laravel-permission/v6/installation-laravel). For managing user
  roles and permissions.
- [JwtAuth, tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth). For Creating and Managing JWT Tokens.


