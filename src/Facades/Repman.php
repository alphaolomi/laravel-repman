<?php

namespace AlphaOlomi\Repman\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static Response list(int $page = 1)
 * @method static Response addOrganisation(string $name)
 *
 * @see \AlphaOlomi\Repman\Repman
 */
class Repman extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AlphaOlomi\Repman\Repman::class;
    }
}
