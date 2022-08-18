<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman;

use AlphaOlomi\Repman\Concerns\BuildBaseRequest;
use AlphaOlomi\Repman\Concerns\CanSendGetRequest;
use AlphaOlomi\Repman\Concerns\CanSendPostRequest;
use AlphaOlomi\Repman\Resources\OrganizationResource;

/**
 * @property OrganizationResource $organizationResource
 */
class RepmanService
{
    use BuildBaseRequest;
    use CanSendGetRequest;
    use CanSendPostRequest;

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
}
