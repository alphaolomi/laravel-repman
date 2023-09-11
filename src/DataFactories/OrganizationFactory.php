<?php

namespace AlphaOlomi\Repman\DataFactories;

use AlphaOlomi\Repman\DataObjects\Organization;
use Illuminate\Support\Collection;

final class OrganizationFactory
{
    public static function new(array $attributes): Organization
    {
        return (new self)->make(
            attributes: $attributes,
        );
    }

    public function make(array $attributes): Organization
    {
        return new Organization(
            id: strval(data_get($attributes, 'id')),
            name: strval(data_get($attributes, 'name')),
            alias: strval(data_get($attributes, 'alias')),
            hasAnonymousAccess: boolval(data_get($attributes, 'hasAnonymousAccess')),
        );
    }

    public static function collection(array $organizations): Collection
    {
        return (new Collection(
            items: $organizations,
        ))->map(fn ($organization): Organization => self::new(attributes: $organization));
    }
}
