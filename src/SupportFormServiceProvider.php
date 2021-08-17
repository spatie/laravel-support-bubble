<?php

namespace Spatie\SupportForm;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\SupportForm\Http\Controllers\HandleSupportFormSubmissionController;

class SupportFormServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-support-form')
            ->hasConfigFile()
            ->hasViews();

    }

    public function packageBooted()
    {
        Route::macro('supportForm', function(string $url = '') {
            Route::post("{$url}/support-form", HandleSupportFormSubmissionController::class)->name('supportForm.submit');
        });
    }
}
