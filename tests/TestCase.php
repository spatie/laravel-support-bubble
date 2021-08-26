<?php

namespace Spatie\SupportBubble\Tests;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Honeypot\HoneypotServiceProvider;
use Spatie\SupportBubble\SupportBubbleServiceProvider;

class TestCase extends Orchestra
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('app.key', 'base64:2+7IMfzxH0Z7oGLurJqQRtNn4qW+KsgmMKndhfPEBoo=');

        Route::supportBubble();
    }

    protected function getPackageProviders($app)
    {
        return [
            SupportBubbleServiceProvider::class,
            HoneypotServiceProvider::class,
        ];
    }
}
