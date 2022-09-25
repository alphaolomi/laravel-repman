<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\DataObjects;

/**
 * @property string $id
 * @property string $name
 * @property string $alias
 * @property bool $hasAnonymousAccess
 */
class Organization
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $alias,
        public readonly bool $hasAnonymousAccess,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'alias' => $this->alias,
            'hasAnonymousAccess' => $this->hasAnonymousAccess,
        ];
    }
}
