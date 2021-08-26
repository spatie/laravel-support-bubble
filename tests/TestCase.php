<?php

namespace Spatie\SupportBubble\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\SupportBubble\SupportBubbleServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Spatie\\SupportBubble\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Route::SupportBubble();
    }

    protected function getPackageProviders($app)
    {
        return [
            SupportBubbleServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_laravel-support-bubble_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
