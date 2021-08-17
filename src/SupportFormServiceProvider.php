<?php

namespace Spatie\LaravelSupportForm;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SupportFormServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-support-form')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-support-form_table');
    }
}
