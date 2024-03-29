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

## Documentation

Documentation for Laravel Repman can be found on the [Laravel Repman](/docs/README.md).

Documentation for Repman can be found on the [Repman Docs](https://repman.io/docs/).
## Installation

You can install the package via composer:

```bash
composer require alphaolomi/laravel-repman
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="repman-config"
```

<!-- This is the contents of the published config file:

```php
return [
    // 
];
``` -->

## Getting Started

Create a account on [Repman.io](https://repman.io) and get your API token.

## Usage

Using the package is very simple, you just need to call the `Repman` facade and pass the required parameters.

```php
use AlphaOlomi\Repman\Facades\Repman;

// Collection of organizations
$orgsCollection =  Repman::organizations()->list();

/** @var AlphaOlomi\Repman\DataObjects\Organization */
$org =  Repman::organizations()->create('org-name');
```

## Testing

Uses Pest PHP testing framework

```bash
composer test
```

## APIs

### Organization

- [x] List all organizations
- [x] Create organization

### Package

- [x] List all packages
- [x] Add package
- [x] Update package
- [x] Synchronize package
- [x] Remove package

### Token
- [x] List all tokens
- [x] Generate token
- [x] Regenerate token
- [x] Delete token

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/alphaolomi/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alpha Olomi](https://github.com/alphaolomi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
