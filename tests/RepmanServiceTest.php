<?php

use AlphaOlomi\Repman\RepmanService;

it('can instantiate RepmanService with baseUrl and apiToken', function () {

    $service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: '123');

    expect($service)->toBeInstanceOf(RepmanService::class);

});

it('can instantiate RepmanService with live token', function () {

    $token = config('repman.token');

    $service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: $token);

    expect($service)->toBeInstanceOf(RepmanService::class);

})->skip(fn () => is_null(config('repman.token')), 'Only runs if REPMAN_TOKEN is set');


it('change base url', function () {

    $service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: '123');

    $newService = $service->setBaseUrl('https://custom.repman.io/api');

    expect($newService)->toBeInstanceOf(RepmanService::class)
        ->and($newService->getBaseUrl())->toBe('https://custom.repman.io/api');
});

it('change api token', function () {

    $service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: 'e7213497be766db41a3b8c060e6b85337759cdac77c64717816abg049ef14730');

    $newService = $service->setApiToken('e7213497be766db41a3b8c060e6b85337759cdac77c64717816abd049ef14731');

    expect($newService)->toBeInstanceOf(RepmanService::class)
        ->and($newService->getApiToken())->toBe('e7213497be766db41a3b8c060e6b85337759cdac77c64717816abd049ef14731');
});
