<?php

use AlphaOlomi\Repman\Facades\Repman;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\OrganizationResource;
use AlphaOlomi\Repman\Resources\PackageResource;

test('Repman facade organization method', function () {
    Repman::shouldReceive('organizations')
        ->once()
        ->andReturn(new OrganizationResource(new RepmanService(baseUrl: 'https://repman.io/api', apiToken: '123')));

    expect(Repman::organizations())->toBeInstanceOf(OrganizationResource::class);
});

test('Repman facade package method', function () {
    Repman::shouldReceive('packages')
        ->once()
        ->andReturn(new PackageResource(
            service: new RepmanService(baseUrl: 'https://repman.io/api', apiToken: '123'),
            organizationAlias: 'test-org',
        ));

    expect(Repman::packages('test-org'))
        ->toBeInstanceOf(PackageResource::class);
});
