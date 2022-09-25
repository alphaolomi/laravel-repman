<?php

namespace AlphaOlomi\Repman\Facades;

use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\RepmanService\Resources\OrganiastionResource;
use AlphaOlomi\Repman\RepmanService\Resources\PackageResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static OrganiastionResource organisation()
 * @method static PackageResource packages(string $organisationName)
 *
 * @see \AlphaOlomi\Repman\RepmanService
 */
class Repman extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RepmanService::class;
    }
}
