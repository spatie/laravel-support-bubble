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
- Honeypot included and set-up to keep spammers at bay

You can see it in action below and on [Flare](https://flareapp.io/)!

![support-small](https://user-images.githubusercontent.com/6287961/130991221-831879ee-1a90-46f3-a92d-af0e7a30d022.gif)

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-support-bubble.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-support-bubble)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation and set-up

### 1. Composer install

You can install the package via composer:

```bash
composer require spatie/laravel-support-bubble
```

### 2. Include TailwindCSS

The views included in this package all use TailwindCSS classes. We've stuck to the default Tailwind config classes so if you're not already using TailwindCSS, you can easily include it from their CDN:

```html
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
```

### 3. Add the support bubble component

After installing the package, you need to add the `<x-support-bubble />` component in your relevant view files. If you want it to show up on all pages you can add it to your `layout.blade.php` file.

### 4. Register routes

Next, you need to register the support form's route. Add the following macro in your `routes/api.php` file:

```php
Route::supportBubble();
```

⚠️ This package is not using CSRF tokens so make sure you add the route macro to your apps API routes or add an exclusion in the `VerifyCsrfToken` middleware.

### 5. Configure message destination

Finally, you need to decide where you want to send the support bubble's messages to. Following options are available:

- e-mail: publish the config file and enter your email in `mail_to`
- diy: register an [event listener](https://laravel.com/docs/8.x/events#defining-listeners) for the `Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent` and handle it yourself

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Spatie\LaravelSupportBubble\LaravelSupportBubbleServiceProvider" --tag="support-bubble-config"
```

These are the default contents of the published config file:

```php
return [
    /*
     * Use this setting to completely disable the support bubble.
     */
    'enabled' => env('SUPPORT_BUBBLE_ENABLED', true),

    /*
     * The default route and controller will be registered using this route name.
     * This is a good place to hook in your own route and controller if necessary.
     */
    'form_action_route' => 'supportBubble.submit',

    /*
     * Enable or disable fields in the support bubble.
     * Keep in mind that `name` and `email` will be hidden automatically
     * when a logged in user is detected and `prefill_logged_in_user` is set.
     */
    'fields' => [
        'name' => true,
        'email' => true,
        'subject' => true,
        'message' => true,
    ],

    /*
     * When set to true we'll use currently logged in user to fill in
     * the name and email fields. Both fields will also be hidden.
     */
    'prefill_logged_in_user' => true,

    /*
     * If configured, we'll set-up an event listener that will
     * send any chat bubble responses to this e-mail address.
     *
     * Default: null
     */
    'mail_to' => null,

    /*
     * We can try to impersonate the user that submitted the support form.
     * The mail sent to the `mail_to` address will appear as if it came
     * from the email address that was submitted in the support form.
     *
     * This is useful when sending mails directly to a support desk.
     */
    'impersonate_mail_from_user' => false,
];
```

## Customisations

The support bubble should look pretty good out of the box. However, we've documented a couple ways to customize labels, text, views and functionality.

### Customizing form fields

It is currently not possible to add new fields to the support bubble's form. You can however disable any fields you do not like in the config file.

### Customizing text / localisation

If you're just looking to customize the field labels, intro text or success text (after the form submitted), you can publish the package's language files:

```bash
php artisan vendor:publish --provider="Spatie\LaravelSupportBubble\LaravelSupportBubbleServiceProvider" --tag=support-bubble-translations
```

These published files can be found and changed in `resources/lang/vendor/laravel-support-bubble/en/`.

### Customizing views

You can publish and change all views (including the JavaScript code) in this package:

```bash
php artisan vendor:publish --provider="Spatie\LaravelSupportBubble\LaravelSupportBubbleServiceProvider" --tag=support-bubble-views
```
These published views can be found and changed in `resources/views/vendor/laravel-support-bubble/`.

Please keep in mind that it's not possible (or at least pretty difficult and convoluted) to add new fields to the support bubble.

### Customizing support form destination

If you don't want to send the support messages to the `mail_to` email configured in the config file, you can define your own [event listener](https://laravel.com/docs/8.x/events#defining-listeners) and listen for the `Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent`. The event contains all data submitted in the support form and can be used to, for example, make an API request to Freshdesk.

### Customizing behaviour after submitting (advanced)

If you really want to, you can send the submitted form data to your own endpoint. The support form uses the route configured in the `support-bubble.form_action_route` config key. You can override this route by removing the `Route::supportBubble()` macro from your routes file and setting the `form_action_route` to any other route name in your application.

The incoming request on this route will be a `\Spatie\SupportBubble\Http\Requests\SupportBubbleRequest`.

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
