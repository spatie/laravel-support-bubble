**DO NOT USE YET, PACKAGE IN DEVELOPMENT**

# A non-intrusive support bubble that can be displayed on any page

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-support-bubble.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-support-bubble)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-support-bubble/run-tests?label=tests)](https://github.com/spatie/laravel-support-bubble/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/spatie/laravel-support-bubble/Check%20&%20fix%20styling?label=code%20style)](https://github.com/spatie/laravel-support-bubble/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-support-bubble.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-support-bubble)

Using this package you can quickly add a chat bubble that opens a support form on any page. It comes with batteries included:

- TailwindCSS styling out of the box
- Won't ask user information if there's a logged in user
- Includes some meta data like URL and IP address
- Easily extendable using custom views, language files and event listeners

You can see it in action below and on [Flare](https://flareapp.io/)!

![support](https://user-images.githubusercontent.com/6287961/130990961-c8e9bf83-3dfc-4c38-a1a5-e1037938c4e5.gif)

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-support-bubble.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-support-bubble)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-support-bubble
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Spatie\LaravelSupportBubble\LaravelSupportBubbleServiceProvider" --tag="support-bubble-config"
```

These are the contents of the published config file:

```php
return [
];
```

## Usage

Coming soon...

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

- [Alex Vanderbist](https://github.com/alexvanderbist)
- [Freek Van der Herten](https://github.com/freekmurze)
- [Ruben Van Assche](https://github.com/rubenvanassche)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
