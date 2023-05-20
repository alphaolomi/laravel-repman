<?php

namespace AlphaOlomi\Repman\DataFactories;

use AlphaOlomi\Repman\DataObjects\Token;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class TokenFactory
{
    public static function new(array $attributes): Token
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    public function make(array $attributes): Token
    {
        return new Token(
            name: strval(data_get($attributes, 'name')),
            value: strval(data_get($attributes, 'value')),
            createdAt: Carbon::parse(data_get($attributes, 'createdAt')),
            lastUsedAt: Carbon::parse(data_get($attributes, 'lastUsedAt')),
        );
    }

    public static function collection(array $tokens): Collection
    {
        return (new Collection(
            items: $tokens,
        ))->map(fn ($token): Token => self::new(attributes: $token));
    }
}
