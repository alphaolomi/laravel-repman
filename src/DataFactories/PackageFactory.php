<?php

namespace AlphaOlomi\Repman\DataFactories;

use AlphaOlomi\Repman\DataObjects\Package;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class PackageFactory
{
    public static function new(array $attributes): Package
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
            latestReleasedVersion: strval(data_get($attributes, 'latestReleasedVersion')),
            latestReleaseDate: Carbon::parse(data_get($attributes, 'latestReleaseDate')),
            description: strval(data_get($attributes, 'description')),
            lastSyncAt: Carbon::parse(data_get($attributes, 'lastSyncAt')),
            lastSyncError: strval(data_get($attributes, 'lastSyncError')),
            webhookCreatedAt: Carbon::parse(data_get($attributes, 'webhookCreatedAt')),
            isSynchronizedSuccessfully: boolval(data_get($attributes, 'isSynchronizedSuccessfully')),
            scanResultDate: Carbon::parse(data_get($attributes, 'scanResultDate')),
            scanResultStatus: strval(data_get($attributes, 'scanResultStatus')),
            lastScanResultContent: data_get($attributes, 'lastScanResultContent'),
            keepLastReleases: intval(data_get($attributes, 'keepLastReleases')),
            enableSecurityScan: boolval(data_get($attributes, 'enableSecurityScan')),
        );
    }

    public static function collection(array $packages): Collection
    {
        return (new Collection(
            items: $packages,
        ))->map(fn ($package): Package => static::new(attributes: $package));
    }
}
