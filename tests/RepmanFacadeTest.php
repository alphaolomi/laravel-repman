<?php

use AlphaOlomi\Repman\Facades\Repman;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\OrganizationResource;
use AlphaOlomi\Repman\Resources\PackageResource;

test('Repman facade organisation method', function () {
    Repman::shouldReceive('organisations')
        ->once()
        ->andReturn(new OrganizationResource(new RepmanService(baseUrl: 'https://repman.io/api', apiToken: '123')));

    expect(Repman::organisations())->toBeInstanceOf(OrganizationResource::class);
});

test('Repman facade package method', function () {
    Repman::shouldReceive('packages')
        ->once()
        ->andReturn(new PackageResource(
            service: new RepmanService(baseUrl: 'https://repman.io/api', apiToken: '123'),
            organisationAlias: 'test-org',
        ));

    expect(Repman::packages('test-org'))
        ->toBeInstanceOf(PackageResource::class);
});
