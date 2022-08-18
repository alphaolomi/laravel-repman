<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RepmanServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-repman')
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        $this->app->singleton(
            abstract: RepamnService::class,
            concrete: fn () => new RepmanService(
                baseUrl: strval(config('repman.url')),
                apiToken: strval(config('repman.token')),
            ),
        );
    }
}
