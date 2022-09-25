<?php

use AlphaOlomi\Repman\DataObjects\Organisation;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\OrganizationResource;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->apiToken = config('repman.token', '');
    $this->service = new RepmanService(baseUrl: 'https://app.repman.io/api/', apiToken: $this->apiToken);
    $this->organizationResource = (new OrganizationResource(service: $this->service));
});

it('can list organisations', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization*' => Http::response(getFixture('list-orgs.json'), 200),
    ]);

    $orgCollect = $this->organizationResource->list();

    Http::assertSent(function (Illuminate\Http\Client\Request $request) {
        return $request->hasHeader('X-API-TOKEN', 'e7213497be766db41a3b8c060e6b85337759cdac77c64717816abd049ef14730');
    });

    expect($orgCollect)->toBeCollection();
});

it('can create org', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization*' => Http::response(getFixture('create-org.json'), 201),
    ]);

    $organisation = $this->organizationResource
        ->create('mambo');

    expect($organisation)->toBeInstanceOf(Organisation::class)
        ->and($organisation->name)->toBe('mambo');
});
