<?php

namespace AlphaOlomi\Repman\Tests;

use AlphaOlomi\Repman\RepmanServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $loadEnvironmentVariables = true;

    protected function getPackageProviders($app): array
    {
        return [RepmanServiceProvider::class];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('repman.url', 'https://repman.io/api');
        config()->set('repman.token', 'e7213497be766db41a3b8c060e6b85337759cdac77c64717816abg049ef14730');
    }
}
