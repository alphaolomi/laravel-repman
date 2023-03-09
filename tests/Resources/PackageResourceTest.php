<?php

use AlphaOlomi\Repman\DataObjects\Package;
use AlphaOlomi\Repman\RepmanService;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

// beforeEach(function () {
//     /** @var MockClient */
//     $this->mockClient = new MockClient();

//     /** @var RepmanService */
//     $this->repman = new RepmanService(env('REPMAN_API_KEY'));

//     $this->repman->withMockClient($this->mockClient);

//     $this->packageId = 'e1d6dad3-9d4e-47cf-8597-81f94968b85e';
// });

// it('can list packages from a given organization', function () {
//     $this->mockClient->addResponse(MockResponse::fixture('packages.list'));

//     $packages = $this->repman->packages('alphaolomi')->list();

//     expect($packages)->toBeCollection();
// });

// it('can add a new package', function () {
//     $this->mockClient->addResponse(MockResponse::fixture('packages.add'));

//     /** @var Package $newPackage */
//     $newPackage = $this->repman->packages('alphaolomi')->add([
//         'name' => 'laracon',
//         'repository' => 'alphaolomi/laracon',
//         'keepLastReleases' => 0,
//         'type' => 'github',
//     ]);
//     expect($newPackage)->toBeInstanceOf(Package::class);
//     $this->packageId = $newPackage->id;
// });

// it('can find a package from a given organization', function (){
//     $this->mockClient->addResponse(MockResponse::fixture('packages.find'));
//     $package = $this->repman->packages('alphaolomi')->find($this->packageId);
//     expect($package)->toBeInstanceOf(Package::class);
// });

// it('can sync a package from a given organization', function (){
//     $this->mockClient->addResponse(MockResponse::fixture('packages.sync'));

//     $package = $this->repman->packages('alphaolomi')->sync($this->packageId);

//     expect($package)->toBeInstanceOf(Package::class);
// })->skip('Failing test');

// it('can update a package from a given organization', function () {
//     $this->mockClient->addResponse(MockResponse::fixture('packages.update'));

//     $didUpdate = $this->repman->packages('alphaolomi')->update($this->packageId, [
//         'url' => 'string',
//         'keepLastReleases' => 0,
//         'enableSecurityScan' => true,
//     ]);

//     expect($didUpdate)->toBeTrue();
// })->skip('Failing test');

// it('can delete a package from a given organization', function (){
//     $this->mockClient->addResponse(MockResponse::fixture('packages.delete'));

//     $didDelete = $this->repman->packages('alphaolomi')->remove($this->packageId);

//     expect($didDelete)->toBeTrue();
// });
