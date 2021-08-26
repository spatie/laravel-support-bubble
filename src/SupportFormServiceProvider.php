<?php

namespace Spatie\SupportForm;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\SupportForm\Components\SupportBubble;
use Spatie\SupportForm\Events\SupportFormSubmittedEvent;
use Spatie\SupportForm\Http\Controllers\HandleSupportFormSubmissionController;
use Spatie\SupportForm\Notifications\BubbleResponseNotification;

class SupportFormServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-support-form')
            ->hasViews()
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        Blade::component('support-bubble', SupportBubble::class);

        Route::macro('supportForm', function (string $url = '') {
            Route::post("{$url}/support-form", HandleSupportFormSubmissionController::class)->name(config('support-form.form_action_route'));
        });

        if (config('support-form.mail_to')) {
            $this->registerMailNotificationEventHandler();
        }
    }

    protected function registerMailNotificationEventHandler(): void
    {
        Event::listen(function (SupportFormSubmittedEvent $event) {
            Notification::route('mail', config('support-form.mail_to'))
                ->notify(BubbleResponseNotification::fromEvent($event));
        });
    }
}
