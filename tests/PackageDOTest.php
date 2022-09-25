<?php

use AlphaOlomi\Repman\DataObjects\Package;
use Illuminate\Support\Carbon;

test('package data objet works', function () {
    $package = new Package(
        id: 'id',
        type: 'type',
        url: 'url',
        name: 'name',
        latestReleasedVersion: 'latestReleasedVersion',
        latestReleaseDate: Carbon::now(),
        description: 'description',
        lastSyncAt: Carbon::now(),
        lastSyncError: 'lastSyncError',
        webhookCreatedAt: Carbon::now(),
        isSynchronizedSuccessfully: true,
        scanResultStatus: 'scanResultStatus',
        scanResultDate: Carbon::now(),
        lastScanResultContent: ['lastScanResultContent'],
        keepLastReleases: 0,
        enableSecurityScan: true,
    );

    expect($package->toArray())->toBe([
        'id' => 'id',
        'type' => 'type',
        'url' => 'url',
        'name' => 'name',
        'latestReleasedVersion' => 'latestReleasedVersion',
        'latestReleaseDate' => Carbon::now()->toString(),
        'description' => 'description',
        'lastSyncAt' => Carbon::now()->toString(),
        'lastSyncError' => 'lastSyncError',
        'webhookCreatedAt' => Carbon::now()->toString(),
        'isSynchronizedSuccessfully' => true,
        'scanResultStatus' => 'scanResultStatus',
        'scanResultDate' => Carbon::now()->toString(),
        'lastScanResultContent' => ['lastScanResultContent'],
        'keepLastReleases' => 0,
        'enableSecurityScan' => true,
    ])->toBeArray()
        ->toHaveCount(16)
        ->toHaveKeys([
            'id',
            'type',
            'url',
            'name',
            'latestReleasedVersion',
            'latestReleaseDate',
            'description',
            'lastSyncAt',
            'lastSyncError',
            'webhookCreatedAt',
            'isSynchronizedSuccessfully',
            'scanResultStatus',
            'scanResultDate',
            'lastScanResultContent',
            'keepLastReleases',
            'enableSecurityScan',
        ]);
});
