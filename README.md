<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Setup Guide

Follow the steps below to setup your application.

Pre requisite:

-   Composer.
-   Node js.
-   PHP Latest Version
-   Create `.env` file with the values same as the `.env.example` file.

Run the following commands

## Composer

```php
composer install
```

## NPM

Make sure to your command prompt as your terminal.

```nodejs
npm install
```

## Migration

Create a new database named `WUP`.

```
php artisan migrate --seed
```

If you have already run the code above before. then run the command below so that you don't have to delete the old database and create new.

```
php artisan migrate:fresh --seed
```

## LOGO

To setup the logo, copy and paste the logo.png in the `storage/app/public` folder.

then run the following command

```
php artisan storage:link
```
