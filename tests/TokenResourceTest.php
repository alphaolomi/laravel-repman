<?php

use AlphaOlomi\Repman\DataObjects\Token;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\TokenResource;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: '123');
    $this->tokenResource = new TokenResource(service: $this->service, organisationAlias: 'mumbo');
});

it('can list organisation\'s tokens with negative page index', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-tokens.json'), 200),
    ]);

    $tokenCollection = $this->tokenResource->list(-4);

    expect($tokenCollection)->toBeCollection();
    expect($tokenCollection->count())->toBe(1);
    expect($tokenCollection->first())->toBeInstanceOf(Token::class);
});

it('can list organisation\'s tokens', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('list-tokens.json'), 200),
    ]);

    $tokenCollection = $this->tokenResource->list();

    expect($tokenCollection)->toBeCollection();
});

it('can generate token for an organisation', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('generate-token.json'), 201),
    ]);

    $package = $this->tokenResource->generate();

    expect($package)->toBeInstanceOf(Token::class);
});

it('can regenerate token for an organisation ', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response(getFixture('regenerate-token.json'), 200),
    ]);

    $package = $this->tokenResource
        ->regenerate('9e680010-c8ad-4d01-a04b-00a981c25548');

    expect($package)->toBeInstanceOf(Token::class);
});

it('will throw Exception if Token action is forbidden', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 403),
    ]);

    $this->tokenResource
        ->generate();
})->throws(RuntimeException::class);

it('can delete token from organisation ', function () {
    Http::preventStrayRequests()->fake([
        'app.repman.io/api/*' => Http::response([], 200),
    ]);

    expect(
        $this->tokenResource
            ->delete('9e680010-c8ad-4d01-a04b-00a981c25548')
    )->toBeTrue();
});
