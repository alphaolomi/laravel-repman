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


it('wont create org with empty name', function () {
     $this->organizationResource->create('');
})->throws(\InvalidArgumentException::class, 'Name cannot be empty');



it('wont create org  with existing name', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization*' => Http::response([], 400),
    ]);

    $this->organizationResource->create('mumbo223');


})->throws(RuntimeException::class, 'Organization already exists');



it('wont create org  with other errors', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization*' => Http::response([], 503),
    ]);

     $this->organizationResource->create('mumbo223');
})->throws(\Illuminate\Http\Client\RequestException::class);

