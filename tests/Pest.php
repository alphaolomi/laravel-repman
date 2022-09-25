<?php

use AlphaOlomi\Repman\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/**
 * Load fixture
 */
function getFixture(string $file): string
{
    return file_get_contents(__DIR__.'/fixtures/'.$file);
}

/**
 * Usage: expect($collect)->toBeCollection();
 */
expect()->extend(
    'toBeCollection',
    /**
     * Assert that the value is an instance of \Illuminate\Support\Collection.
     */
    function () {
        return $this->toBeInstanceOf(Illuminate\Support\Collection::class);
    }
);
