<?php

namespace Spatie\SupportBubble;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\SupportBubble\Components\SupportBubbleComponent;
use Spatie\SupportBubble\Events\SupportBubbleSubmittedEvent;
use Spatie\SupportBubble\Http\Controllers\HandleSupportBubbleSubmissionController;
use Spatie\SupportBubble\Notifications\BubbleResponseNotification;

class SupportBubbleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-support-bubble')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews();
    }

    public function packageBooted()
    {
        Blade::component('support-bubble', SupportBubbleComponent::class);
        Blade::component('input-field', 'support-bubble::components.input-field', 'support-bubble');

        Route::macro('supportBubble', function (string $url = '') {
            Route::post("{$url}/support-bubble", HandleSupportBubbleSubmissionController::class)
                ->name(config('support-bubble.form_action_route'))
                ->middleware(ProtectAgainstSpam::class);
        });

        if (config('support-bubble.mail_to')) {
            $this->registerMailNotificationEventHandler();
        }
    }

    protected function registerMailNotificationEventHandler(): void
    {
        Event::listen(function (SupportBubbleSubmittedEvent $event) {
            Notification::route('mail', config('support-bubble.mail_to'))
                ->notify(BubbleResponseNotification::fromEvent($event));
        });
    }
}
