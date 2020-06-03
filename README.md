# My boilerplate to any new Laravel Application

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-boilerplate.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-boilerplate)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-boilerplate/run-tests?label=tests)](https://github.com/spatie/laravel-boilerplate/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-boilerplate.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-boilerplate)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require masterix21/laravel-boilerplate
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Masterix21\LaravelBoilerplate\BoilerplateServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Masterix21\LaravelBoilerplate\BoilerplateServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$skeleton = new Spatie\Skeleton();
echo $skeleton->echoPhrase('Hello, Spatie!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Luca Longo](https://github.com/masterix21)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
