<?php

namespace AlphaOlomi\Repman\DataObjects;
use Illuminate\Support\Carbon;

class Token {
    public function __construct(
        public readonly string $name,
        public readonly string $value,
        public readonly Carbon $createdAt,
        public readonly Carbon $lastUsedAt,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'created_at' => $this->createdAt,
            'last_used_at' => $this->lastUsedAt,
        ];
    }
}
