<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Concerns\Resources;

use Illuminate\Support\Collection;

interface CanListResource
{
    public function list(int $page = 1): Collection;
}

