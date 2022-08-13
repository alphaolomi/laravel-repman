<?php

namespace AlphaOlomi\Repman\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlphaOlomi\Repman\Repman
 */
class Repman extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AlphaOlomi\Repman\Repman::class;
    }
}
