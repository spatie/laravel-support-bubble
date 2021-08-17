<?php

namespace Spatie\LaravelSupportForm\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelSupportForm\SupportFormServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Spatie\\LaravelSupportForm\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Route::supportForm();
    }

    protected function getPackageProviders($app)
    {
        return [
            SupportFormServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_laravel-support-form_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
