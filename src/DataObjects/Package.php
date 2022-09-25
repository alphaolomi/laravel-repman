<?php
// "id": "string",
//       "type": "string",
//       "url": "string",
//       "name": "string",
//       "latestReleasedVersion": "string",
//       "latestReleaseDate": "2022-09-24T18:09:23.371Z",
//       "description": "string",
//       "lastSyncAt": "2022-09-24T18:09:23.371Z",
//       "lastSyncError": "string",
//       "webhookCreatedAt": "2022-09-24T18:09:23.371Z",
//       "isSynchronizedSuccessfully": true,
//       "scanResultStatus": "string",
//       "scanResultDate": "2022-09-24T18:09:23.371Z",
//       "lastScanResultContent": [
//         "string"
//       ],
//       "keepLastReleases": 0,
//       "enabledSecurityScan": true


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
        public readonly bool $enabledSecurityScan,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'url' => $this->url,
            'name' => $this->name,
            'latest_released_version' => $this->latestReleasedVersion,
            'latest_release_date' => $this->latestReleaseDate,
            'description' => $this->description,
            'last_sync_at' => $this->lastSyncAt,
            'last_sync_error' => $this->lastSyncError,
            'webhook_created_at' => $this->webhookCreatedAt,
            'is_synchronized_successfully' => $this->isSynchronizedSuccessfully,
            'scan_result_status' => $this->scanResultStatus,
            'scan_result_date' => $this->scanResultDate,
            'last_scan_result_content' => $this->lastScanResultContent,
            'keep_last_releases' => $this->keepLastReleases,
            'enabled_security_scan' => $this->enabledSecurityScan,
        ];
    }
}
