<div align="center"> <h1>Laravel Repman</h1>
<a href="https://github.com/alphaolomi/laravel-repman/actions?query=workflow%3Arun-tests+branch%3Amain">
<img src="https://img.shields.io/github/workflow/status/alphaolomi/laravel-repman/run-tests?label=tests"
alt="GitHub Tests Action Status">
</a><a href="https://packagist.org/packages/alphaolomi/laravel-repman">
<img src="https://img.shields.io/packagist/v/alphaolomi/laravel-repman.svg?style=flat-square"
alt="Latest Version on Packagist">
</a><a href='https://github.com/alphaolomi/laravel-repman/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain'>
<img src="https://img.shields.io/github/workflow/status/alphaolomi/laravel-repman/Fix%20PHP%20code%20style%20issues?label=code%20style" alt="GitHub Code Style Action Status">
</a> <a href="https://packagist.org/packages/alphaolomi/laravel-repman">
<img src="https://img.shields.io/packagist/dt/alphaolomi/laravel-repman.svg?style=flat-square" alt="Total Downloads">
</a></div>

<br>

Laravel Repman provides an expressive, fluent interface to [Repman.io](https://repman.io)'s services.



[Repman.io](https://repman.io) is a private Composer repository manager. It allows you to host your own Composer repository and manage packages from it. It also allows you to mirror packages from Packagist.

<br>

## Requirements

- PHP >= 8.1


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


$repman = new RepmanService('https://app.repman.io/api', 'your-token');

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
```

## Internal & Misc 

Package utilize data objects to make it easy to work with the data returned from the API.

### Testing

This package uses Pest PHP testing framework

Code coverage is around 64% and it's generated using Xdebug 

<br><br><br><br><br>
Next: [Usage](./API.md)
