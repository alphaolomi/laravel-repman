<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\DataObjects;

use Illuminate\Support\Carbon;

class Package
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly string $url,
        public readonly string $name,
        public readonly string $latestReleasedVersion,
        public readonly Carbon $latestReleaseDate,
        public readonly string $description,
        public readonly Carbon $lastSyncAt,
        public readonly string $lastSyncError,
        public readonly Carbon $webhookCreatedAt,
        public readonly bool $isSynchronizedSuccessfully,
        public readonly string $scanResultStatus,
        public readonly Carbon $scanResultDate,
        public readonly array $lastScanResultContent,
        public readonly int $keepLastReleases,
        public readonly bool $enableSecurityScan,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'url' => $this->url,
            'name' => $this->name,
            'latestReleasedVersion' => $this->latestReleasedVersion,
            'latestReleaseDate' => $this->latestReleaseDate->toString(),
            'description' => $this->description,
            'lastSyncAt' => $this->lastSyncAt->toString(),
            'lastSyncError' => $this->lastSyncError,
            'webhookCreatedAt' => $this->webhookCreatedAt->toString(),
            'isSynchronizedSuccessfully' => $this->isSynchronizedSuccessfully,
            'scanResultStatus' => $this->scanResultStatus,
            'scanResultDate' => $this->scanResultDate->toString(),
            'lastScanResultContent' => $this->lastScanResultContent,
            'keepLastReleases' => $this->keepLastReleases,
            'enableSecurityScan' => $this->enableSecurityScan,
        ];
    }
}
