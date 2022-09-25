<?php

use AlphaOlomi\Repman\Facades\Repman;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\OrganizationResource;

test('Repman facade', function () {
    Repman::shouldReceive('organisation')
        ->once()
        ->andReturn(new OrganizationResource(new RepmanService(apiToken: '123', baseUrl: 'https://repman.io/api')));

    expect(Repman::get('key'))->toBe('value');
})->skip('for now');
