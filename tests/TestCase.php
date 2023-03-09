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

    // public function getEnvironmentSetUp($app)
    // {

    // }
}
