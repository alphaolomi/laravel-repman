<?php

use AlphaOlomi\Repman\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);


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
