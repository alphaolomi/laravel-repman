<?php

use AlphaOlomi\Repman\DataObjects\Token;
use Illuminate\Support\Carbon;

test('it can be converted to an array', function () {
    $token = new Token('test', 'value', Carbon::now(), Carbon::now());

    expect($token->toArray())->toBeArray()
        ->toHaveCount(4)
        ->toHaveKeys([
            'name',
            'value',
            'createdAt',
            'lastUsedAt',
        ]);
});
