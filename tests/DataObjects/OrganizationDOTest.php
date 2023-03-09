<?php

use AlphaOlomi\Repman\DataObjects\Organization;

it('can serialize a data object', function () {
    $organization = new Organization(
        id: 'id',
        name: 'name',
        alias: 'alias',
        hasAnonymousAccess: true,
    );

    expect($organization->toArray())->toBe([
        'id' => 'id',
        'name' => 'name',
        'alias' => 'alias',
        'hasAnonymousAccess' => true,
    ])->toBeArray()
        ->toHaveCount(4)
        ->toHaveKeys(['id', 'name', 'alias', 'hasAnonymousAccess']);
});
