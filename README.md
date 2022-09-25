# Package for Repman.io API [![Latest Version on Packagist](https://img.shields.io/packagist/v/alphaolomi/laravel-repman.svg?style=flat-square)](https://packagist.org/packages/alphaolomi/laravel-repman)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/alphaolomi/laravel-repman/run-tests?label=tests)](https://github.com/alphaolomi/laravel-repman/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/alphaolomi/laravel-repman/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/alphaolomi/laravel-repman/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/alphaolomi/laravel-repman.svg?style=flat-square)](https://packagist.org/packages/alphaolomi/laravel-repman)


## Installation

You can install the package via composer:

```bash
composer require alphaolomi/laravel-repman
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-repman-config"
```

<!-- This is the contents of the published config file:

```php
return [
    // 
];
``` -->

## Usage

Using the package is very simple, you just need to call the `Repman` facade and pass the required parameters.

```php
use AlphaOlomi\Repman\Facades\Repman;

// Collection of organisations
$orgsCollection =  Repman::organisations()->list();

/** @var AlphaOlomi\Repman\DataObjects\Organisation */
$org =  Repman::organisations()->create('org-name');
```

## Testing

Uses Pest PHP testing framework

```bash
composer test
```

## Services available

### Organisation

- [x] List all organisations
- [x] Create organisation

### Packages

- [x] List all packages
- [x] Add package
- [x] Update package
- [x] Synchrnize package
- [x] Remove package

### Tokens
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
