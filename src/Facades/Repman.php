<?php

namespace AlphaOlomi\Repman\Facades;

use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Resources\OrganizationResource;
use AlphaOlomi\Repman\Resources\PackageResource;
use AlphaOlomi\Repman\Resources\TokenResource;
use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static OrganizationResource organisations()
 * @method static PackageResource packages(string $organisationAlias)
  * @method static TokenResource tokens(string $organisationAlias)
 *  @method static setBaseUrl(string $url)
 *  @method static setApiToken(string $token)
 *
 * @see \AlphaOlomi\Repman\RepmanService
 */
class Repman extends Facade
{

    protected static function getFacadeAccessor(): string
    {
        return RepmanService::class;
    }
}
