<?php

use AlphaOlomi\Repman\DataObjects\Organization;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\OrganizationResource;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->apiToken = config('repman.token', '');
    $this->service = new RepmanService(baseUrl: 'https://app.repman.io/api/', apiToken: $this->apiToken);
    $this->organizationResource = (new OrganizationResource(service: $this->service));
});

it('can list organizations', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization*' => Http::response(getFixture('list-orgs.json'), 200),
    ]);

    $orgCollect = $this->organizationResource->list();

    expect($orgCollect)->toBeCollection();
});

it('can create org', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization*' => Http::response(getFixture('create-org.json'), 201),
    ]);

    $organization = $this->organizationResource->create('mumbo22');

    expect($organization)->toBeInstanceOf(Organization::class);
});
