<?php

namespace AlphaOlomi\Repman\DataFactories;

use AlphaOlomi\Repman\DataObjects\Organisation;
use Illuminate\Support\Collection;

final class OrganisationFactory
{
     public static function new(array $attributes): Organisation
    {
        return (new static)->make(
            attributes: $attributes,
        );
    }

    public function make(array $attributes): Organisation
    {
        return new Organisation(
            id: strval(data_get($attributes, 'id')),
            name: strval(data_get($attributes, 'name')),
            alias: strval(data_get($attributes, 'alias')),
            hasAnonymousAccess: boolval(data_get($attributes, 'hasAnonymousAccess')),
        );
    }

    public static function collection(array $organisations): Collection
    {
        return (new Collection(
            items: $organisations,
        ))->map(fn ($organisation): Organisation => static::new(attributes: $organisation));
    }
}
