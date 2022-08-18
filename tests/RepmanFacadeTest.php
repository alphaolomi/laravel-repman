<?php

use AlphaOlomi\Repman\Facades\Repman;

test('Repman facade', function () {
    Repman::shouldReceive('get')
        ->once()
        ->with('key')
        ->andReturn('value');

    expect(Repman::get('key'))->toBe('value');
})->skip('for now');
