<?php

use AlphaOlomi\Repman\RepmanService;

it('can instantiate RepmanService with baseUrl and apiToken', function () {
    $service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: '123');
    expect($service)->toBeInstanceOf(RepmanService::class);
});

it('can instantiate RepmanService with live token', function () {
    $token = env('REPMAN_TOKEN');

    $service = new RepmanService(baseUrl: 'https://app.repman.io/api', apiToken: $token);

    expect($service)->toBeInstanceOf(RepmanService::class);
})->skip(fn () => is_null(env('REPMAN_TOKEN')), 'Only runs if REPMAN_TOKEN is set');
