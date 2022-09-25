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
use AlphaOlomi\Repman\Resources\TokenResource;

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

    /**
     *  Set the base url.
     *
     * @param  string  $baseUrl
     * @return RepmanService
     */
    public function setBaseUrl(string $baseUrl): self
    {
        if (empty(trim($baseUrl))) {
            throw new \InvalidArgumentException('Base url cannot be empty');
        }
        if (filter_var($baseUrl, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException('Base url is not valid');
        }

        return new self(
            baseUrl: $baseUrl,
            apiToken: $this->apiToken,
        );
    }

    /**
     *  Set the API token
     *
     * @param  string  $apiToken
     * @return RepmanService
     */
    public function setApiToken(string $apiToken): self
    {
        if (empty(trim($apiToken))) {
            throw new \InvalidArgumentException('Api token cannot be empty');
        }
        if (strlen($apiToken) !== 64) {
            throw new \InvalidArgumentException('Api token must be 64 characters long');
        }

        return new self(
            baseUrl: $this->baseUrl,
            apiToken: $apiToken,
        );
    }

    /**
     * Get the Base URL
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Get the current API Token
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function organizations(): OrganizationResource
    {
        return new OrganizationResource(
            service: $this,
        );
    }

    public function packages(string $organizationAlias): PackageResource
    {
        return new PackageResource(
            service: $this,
            organizationAlias: $organizationAlias,
        );
    }

    public function tokens(string $organizationAlias): TokenResource
    {
        return new TokenResource(
            service: $this,
            organizationAlias: $organizationAlias,
        );
    }
}
