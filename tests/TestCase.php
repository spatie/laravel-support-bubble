<?php

namespace Spatie\SupportBubble\Tests;

use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Honeypot\HoneypotServiceProvider;
use Spatie\SupportBubble\SupportBubbleServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

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
