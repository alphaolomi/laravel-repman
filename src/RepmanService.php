<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman;

use AlphaOlomi\Repman\Concerns\BuildBaseRequest;
use AlphaOlomi\Repman\Concerns\CanSendDeleteRequest;
use AlphaOlomi\Repman\Concerns\CanSendGetRequest;
use AlphaOlomi\Repman\Concerns\CanSendPatchRequest;
use AlphaOlomi\Repman\Concerns\CanSendPostRequest;
use AlphaOlomi\Repman\Concerns\CanSendPutRequest;
use AlphaOlomi\Repman\Resources\OrganizationResource;
use AlphaOlomi\Repman\Resources\PackageResource;

/**
 * @property OrganizationResource $organizationResource
 */
class RepmanService
{
    use BuildBaseRequest;
    use CanSendGetRequest;
    use CanSendPostRequest;
    use CanSendPutRequest;
    use CanSendDeleteRequest;
    use CanSendPatchRequest;

    public function __construct(
        private readonly ?string $baseUrl,
        private readonly string $apiToken,
    ) {
    }

    public function organizations(): OrganizationResource
    {
        return new OrganizationResource(
            service: $this,
        );
    }

    public function packages(string $organisationName): PackageResource
    {
        return new PackageResource(
            service: $this,
            organisationName: $organisationName,
        );
    }
}
