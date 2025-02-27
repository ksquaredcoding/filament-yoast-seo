# Handle Yoast Seo for Filament admin panel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/outreach/filament-yoast-seo.svg?style=flat-square)](https://packagist.org/packages/outreach/filament-yoast-seo)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/outreach/filament-yoast-seo/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/outreach/filament-yoast-seo/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/outreach/filament-yoast-seo/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/outreach/filament-yoast-seo/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/outreach/filament-yoast-seo.svg?style=flat-square)](https://packagist.org/packages/outreach/filament-yoast-seo)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require outreach/filament-yoast-seo
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-yoast-seo-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-yoast-seo-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
Outreach\Filament\Forms\Components\FilamentYoastSeo::make();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Outreach](https://github.com/ksquaredcoding)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
