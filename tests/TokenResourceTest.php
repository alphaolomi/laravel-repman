<?php

use AlphaOlomi\Repman\DataObjects\Token;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\TokenResource;
use Illuminate\Support\Facades\Http;
use \Illuminate\Http\Client\RequestException;

beforeEach(function () {
    $this->service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: '123');
    $this->tokenResource = new TokenResource(service: $this->service, organizationAlias: 'mumbo');
});

it('can list organization\'s tokens with negative page index', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-tokens.json'), 200),
    ]);

    $tokenCollection = $this->tokenResource->list(-4);

    expect($tokenCollection)->toBeCollection();
    expect($tokenCollection->count())->toBe(1);
    expect($tokenCollection->first())->toBeInstanceOf(Token::class);
});

it('can list organization\'s tokens without permission', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-tokens.json'), 403),
    ]);

    $this->tokenResource->list();
})->throws(RuntimeException::class);


it('can NOT list organization\'s tokens with server error', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 503),
    ]);

    $this->tokenResource->list();
})->throws(RequestException::class);



it('can list organization\'s tokens', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-tokens.json'), 200),
    ]);

    $tokenCollection = $this->tokenResource->list();

    expect($tokenCollection)->toBeCollection();
});

it('can generate token for an organization', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('generate-token.json'), 201),
    ]);

    $package = $this->tokenResource->generate();

    expect($package)->toBeInstanceOf(Token::class);
});


it('can not generate token for an organization with failed server', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('generate-token.json'), 500),
    ]);

    $this->tokenResource->generate();
})->throws(RequestException::class);

it('can regenerate token for an organization ', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('regenerate-token.json'), 200),
    ]);

    $package = $this->tokenResource
        ->regenerate('9e680010-c8ad-4d01-a04b-00a981c25548');

    expect($package)->toBeInstanceOf(Token::class);
});





it('can regenerate token for an organization with 404', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('regenerate-token.json'), 404),
    ]);

    $this->tokenResource
        ->regenerate('9e680010-c8ad-4d01-a04b-00a981c25548');

})->throws(RequestException::class);


it('will throw Exception if Token action is forbidden', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 403),
    ]);

    $this->tokenResource
        ->generate();
})->throws(RuntimeException::class);

it('can delete token from organization ', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/organization/*' => Http::response([], 200),
    ]);

    expect(
        $this->tokenResource
            ->delete('9e680010-c8ad-4d01-a04b-00a981c25548')
    )->toBeTrue();
});
