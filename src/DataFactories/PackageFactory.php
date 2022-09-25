<?php

namespace AlphaOlomi\Repman\DataFactories;

use AlphaOlomi\Repman\DataObjects\Package;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class PackageFactory
{
    public static function new(array $attributes)
    {
        return (new static)->make(
            attributes: $attributes,
        );
    }

    public function make(array $attributes): Package
    {
        return new Package(
            id: strval(data_get($attributes, 'id')),
            type: strval(data_get($attributes, 'type')),
            url: strval(data_get($attributes, 'url')),
            name: strval(data_get($attributes, 'name')),
            latestReleasedVersion: strval(data_get($attributes, 'latest_released_version')),
            latestReleaseDate: Carbon::parse(data_get($attributes, 'latest_release_date')),
            description: strval(data_get($attributes, 'description')),
            lastSyncAt: Carbon::parse(data_get($attributes, 'last_sync_at')),
            lastSyncError: strval(data_get($attributes, 'last_sync_error')),
            webhookCreatedAt: Carbon::parse(data_get($attributes, 'webhook_created_at')),
            isSynchronizedSuccessfully: boolval(data_get($attributes, 'is_synchronized_successfully')),
            scanResultStatus: strval(data_get($attributes, 'scan_result_status')),
            scanResultDate: Carbon::parse(data_get($attributes, 'scan_result_date')),
            lastScanResultContent: array_map(fn ($item) => strval($item), data_get($attributes, 'last_scan_result_content')),
            keepLastReleases: intval(data_get($attributes, 'keep_last_releases')),
            enabledSecurityScan: boolval(data_get($attributes, 'enabled_security_scan')),
        );
    }

    public static function collection(array $packages): Collection
    {
        return (new Collection(
            items: $packages,
        ))->map(fn ($package): Package => static::new(attributes: $package));
    }
}
