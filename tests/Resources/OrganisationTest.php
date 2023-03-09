<?php

use AlphaOlomi\Repman\DataObjects\Organization;
use AlphaOlomi\Repman\RepmanService;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;


// beforeEach(function () {
//     /** @var MockClient */
//     $this->mockClient = new MockClient();

//     /** @var RepmanService */
//     $this->repman = new RepmanService(env('REPMAN_API_KEY'));

//     $this->repman->withMockClient($this->mockClient);
// });


// it('can get organizations list', function () {
//     $this->mockClient->addResponse(MockResponse::fixture('organizations.list'));

//     $organizations = $this->repman->organizations()->list();

//     expect($organizations)->toBeCollection();
// });



// it('can create an organization', function () {
//     $this->mockClient->addResponse(MockResponse::fixture('organizations.create'));

//     $organization = $this->repman->organizations()->create(name: 'My Organization');

//     expect($organization)->toBeInstanceOf(Organization::class);
// });
