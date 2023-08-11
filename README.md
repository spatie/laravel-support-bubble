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

You can see it in action below, on [Flare](https://flareapp.io/) and [Oh Dear](https://ohdear.app)!

![support-small](https://user-images.githubusercontent.com/6287961/130991221-831879ee-1a90-46f3-a92d-af0e7a30d022.gif)

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-support-bubble.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-support-bubble)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Are you a visual learner?

In [this stream on YouTube](https://www.youtube.com/watch?v=IucDLJI2mvQ), you'll see how to install that package, and how it works under the hood.

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-support-bubble
```

#### Include TailwindCSS

The views included in this package all use TailwindCSS classes. We've stuck to the default Tailwind config classes.  If you're not already using TailwindCSS, you can easily include it from their CDN:

```html
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
```

If you use Tailwind [Just-in-Time Mode](https://tailwindcss.com/docs/just-in-time-mode) you should add these additional lines into your `tailwind.config.js` file:
```js
content: [
    './vendor/spatie/laravel-support-bubble/config/**/*.php',
    './vendor/spatie/laravel-support-bubble/resources/views/**/*.blade.php',
    // other places
],
```

This way Tailwind JIT will build your styles including those properties used for the support bubble.

#### Add the component to your view

After installing the package, you need to add this Blade component in your relevant view files:

```html
<x-support-bubble />
```

If you want it to show up on all pages you can add it to your `layout.blade.php` file.

Next, you need to register the support form's route. Add the following macro in your `routes/api.php` file:

```php
Route::supportBubble();
```

This will register a route at `/support-bubble`

⚠️ This package is not using CSRF tokens so make sure you add the route macro to your apps API routes or add an exclusion in the `VerifyCsrfToken` middleware.

```php
// in app/Http/Middleware/VerifyCsrfToken.php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        'support-bubble',
        // other entries
    ];
    
    // ...
}
```

#### Configure message destination

Finally, you need to decide where you want to send the support bubble's submission to. 

Out of the box, the package can mail the submissions to a given email address. To go this route, publish the config file and enter the email in `mail_to`.

Alternately, you can register an [event listener](https://laravel.com/docs/8.x/events#defining-listeners) to listen for the `Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent` event and handle it yourself. This event has submitted form values as public properties.

The config file can be published with:

```bash
php artisan vendor:publish --provider="Spatie\SupportBubble\SupportBubbleServiceProvider" --tag="support-bubble-config"
```

These are the default contents of the published config file:

```php
<?php

return [
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
     * We'll send any chat bubble responses to this e-mail address.
     *
     * Set this to
     */
    'mail_to' => null,

    /*
     * When set to true we'll use currently logged in user to fill in
     * the name and email fields. Both fields will also be hidden.
     */
    'prefill_logged_in_user' => true,

    /*
     * The TailwindCSS classes used on a couple of key components.
     *
     * To customize the components further, you can publish
     * the views of this package.
     */
    'classes' => [
        'container' => 'text-base items-end z-10 flex-col m-4 gap-3',
        'bubble' => 'hidden sm:block | bg-purple-400 rounded-full shadow-lg w-14 h-14 text-white p-4',
        'input' => 'bg-gray-100 border border-gray-200 w-full max-w-full p-2 rounded-sm shadow-input text-gray-800 text-base',
        'button' => 'inline-flex place-center px-4 py-3 h-10 border-0 bg-purple-500 hover:bg-purple-600 active:bg-purple-600 overflow-hidden rounded-sm text-white leading-none no-underline',
    ],
    
    /*
     * The default route and controller will be registered using this route name.
     * This is a good place to hook in your own route and controller if necessary.
     */
    'form_action_route' => 'supportBubble.submit',

     /**
     * The positioning of the bubble and the form, change this between right-to-left and left-to-right, if you want to use RTL, you must have your layout set to RTL like this 
     * <html lang="ar-TN" dir="rtl">
     * By default, the value of this is LTR
     */
    'direction' => 'left-to-right',
];
```

## Customization options

The support bubble should look pretty good out of the box. However, we've documented a couple ways to customize labels, text, views and functionality.

### Customizing form fields

It is currently not possible to add new fields to the support bubble's form. You can however disable any fields you do not like in the config file.

### Customizing text / localisation

If you're just looking to customize the field labels, intro text or success text (after the form submitted), you can publish the package's language files:

```bash
php artisan vendor:publish --provider="Spatie\SupportBubble\SupportBubbleServiceProvider" --tag=support-bubble-translations
```

These published files can be found and changed in `resources/lang/vendor/laravel-support-bubble/en/`.

### Customizing styles

You can customize the TailwindCSS classes used for the bubble pop-up, input fields and submit button by changing the `support-bubble.class` config keys. This is the ideal place to change the bubble's default purple color or use your own `.input` or `.button` classes.

If you're looking to change any more advanced styles, keep reading to learn how to publish and customize the Blade views used in the support bubble component.
 
### Customizing views

You can publish and change all views (including the JavaScript code) in this package:

```bash
php artisan vendor:publish --provider="Spatie\SupportBubble\SupportBubbleServiceProvider" --tag=support-bubble-views
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

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alex Vanderbist](https://github.com/alexvanderbist)
- [Freek Van der Herten](https://github.com/freekmurze)
- [Ruben Van Assche](https://github.com/rubenvanassche)
- [All Contributors](../../contributors)

## Alternatives

If you need more options for your support bubble, consider using one of these:

- [Freddy Feedback](https://freddyfeedback.com)
- [Beacon by Help Scout](https://www.helpscout.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
