<?php

use AlphaOlomi\Repman\DataObjects\Package;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\PackageResource;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: '123');
    $this->packageResource = new PackageResource(service: $this->service, organisationAlias: 'mumbo');
});

it('can list organisation\'s packages successfully with negative page index', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-packages.json'), 200),
    ]);

    $orgCollect = $this->packageResource->list(-3);

    expect($orgCollect)->toBeCollection();
    expect($orgCollect->count())->toBe(1);
    expect($orgCollect->first())->toBeInstanceOf(Package::class);
});

it('can list organisation\'s packages successfully', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-packages.json'), 200),
    ]);

    $orgCollect = $this->packageResource->list();

    expect($orgCollect)->toBeCollection();
    expect($orgCollect->count())->toBe(1);
    expect($orgCollect->first())->toBeInstanceOf(Package::class);
});

it('can add package to organisation successfully', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('add-package.json'), 201),
    ]);

    $package = $this->packageResource
        ->add([
            'repository' => 'https://github.com/alphaolomi/laracon',
            'type' => 'github',
            'keepLastReleases' => 0,
        ]);

    expect($package)->toBeInstanceOf(Package::class);
    expect($package->url)->toBe('https://github.com/alphaolomi/laracon');
});

it('will throw Exception when adding package with missing key', function () {
    $this->packageResource
        ->add([
            'type' => 'github',
            'keepLastReleases' => 0,
        ]);
})->throws(InvalidArgumentException::class, 'Missing required keys: repository cannot be empty');

it('will throw Exception when adding package with bad type value', function () {
    $this->packageResource
        ->add([
            'repository' => 'alphaolomi/laracon',
            'type' => 'bad-type',
            'keepLastReleases' => 0,
        ]);
})->throws(InvalidArgumentException::class);

it('can find package from organisation', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('find-package.json'), 201),
    ]);

    $package = $this->packageResource
        ->find('9e680010-c8ad-4d01-a04b-00a981c25548');

    expect($package)->toBeInstanceOf(Package::class);
    expect($package->url)->toBe('https://github.com/alphaolomi/laracon');

    // assert that only one request was sent
    // findMany is not implemented yet
    // it utilize multiple find requests
    Http::assertSentCount(1);
});

it('will throw PNF Exception if package is not found', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 404),
    ]);
    $this->packageResource
        ->find('9e680010-c8ad-4d01-a04b-00a981c25548');
})->throws(\AlphaOlomi\Repman\Exceptions\PackageNotFound::class);

it('will throw RT Exception if action forbidden', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 403),
    ]);

    $this->packageResource
        ->find('9e680010-c8ad-4d01-a04b-00a981c25548');
})->throws(RuntimeException::class);

it('can remove package from organisation', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 200),
    ]);

    expect(
        $this->packageResource
            ->remove('9e680010-c8ad-4d01-a04b-00a981c25548')
    )->toBeTrue();
});
