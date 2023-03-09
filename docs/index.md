<div align="center">
<h1>Laravel Repman</h1>
<a href="https://github.com/alphaolomi/laravel-repman/actions/workflows/run-tests.yml"><img src="https://github.com/alphaolomi/laravel-repman/actions/workflows/run-tests.yml/badge.svg" alt="GitHub Tests Action Status"></a>
<a href="https://packagist.org/packages/alphaolomi/laravel-repman"><img src="https://img.shields.io/packagist/v/alphaolomi/laravel-repman.svg?style=flat-square" alt="Latest Version on Packagist"></a>
<a href='https://github.com/alphaolomi/laravel-repman/actions/workflows/fix-php-code-style-issues.yml'><img src="https://github.com/alphaolomi/laravel-repman/actions/workflows/fix-php-code-style-issues.yml/badge.svg" alt="GitHub Code Style Action Status"></a>
<a href="https://packagist.org/packages/alphaolomi/laravel-repman"><img src="https://img.shields.io/packagist/dt/alphaolomi/laravel-repman.svg?style=flat-square" alt="Total Downloads"></a>
</div>

<br>

Laravel Repman provides an expressive, fluent interface to [Repman.io](https://repman.io)'s services.

[Repman.io](https://repman.io) is a private Composer repository manager. It allows you to host your own Composer repository and manage packages from it. It also allows you to mirror packages from Packagist.

<br>

## Requirements

- PHP >= 8.1
- Laravel >= 9.0

## Installation


You can install the package via composer:

```bash
composer require alphaolomi/laravel-repman
```

## Configuration

```bash
php artisan vendor:publish --tag="repman-config"
```

## Service Manager


```php
use AlphaOlomi\Repman\RepmanService;

$repman = new RepmanService('your-token',);

// Collection of organizations
$orgsCollection =  $repman->organizations()->list();

$orgArray = $orgsCollection->all();

print_r($orgArray);
```

## Facades

This package also provides a facade for easy access to the service manager.

```php
use AlphaOlomi\Repman\Facades\Repman;

$orgsCollection =  Repman::organizations()->list();

$orgArray = $orgsCollection->all();

print_r($orgArray);
```

## Internal & Misc 

Package utilize data objects to make it easy to work with the data returned from the API.

### Testing

This package uses Pest PHP testing framework

<br><br><br><br><br>

Next: [Usage](./API.md)
