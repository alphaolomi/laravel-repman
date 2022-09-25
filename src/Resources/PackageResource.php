<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\DataFactories\PackageFactory;
use AlphaOlomi\Repman\DataObjects\Package;
use AlphaOlomi\Repman\Exceptions\PackageNotFound;
use AlphaOlomi\Repman\RepmanService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

/**
 * @property RepmanService $service
 */
class PackageResource
{
    public function __construct(
        private readonly RepmanService $service,
        private readonly string $organisationAlias,
    ) {
    }

    /**
     * List all packages.
     *
     * @param  int  $page
     * @return Collection
     */
    public function list(int $page = 1): Collection
    {
        $page = ($page < 1) ? 1 : $page;

        $data = $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations/{$this->organisationAlias}/package?page={$page}",
        )->onError(function () {
//
        })->json('data');

        return PackageFactory::collection(packages: $data);
    }

    /**
     * Create a new package.
     *
     * @param  array  $payload
     * @return Package
     */
    public function add(array $payload): Package
    {
        foreach (['repository', 'type', 'keepLastReleases'] as $key) {
            if (! isset($payload[$key])) {
                throw new \InvalidArgumentException("Missing required keys: {$key} cannot be empty");
            }
        }
        if (! in_array($payload['type'], ['git', 'github', 'gitlab', 'bitbucket', 'mercurial', 'subversion', 'pear'])) {
            throw new \InvalidArgumentException("{$payload['type']} is not a valid package type");
        }

        $data = $this->service->post(
            request: $this->service->buildRequestWithToken(),
            url: "/organization/{$this->organisationAlias}/package",
            payload: $payload,
        )->onError(function (Response $response) {
            throw new \RuntimeException($response->json());
        })->json();

        return PackageFactory::new(attributes: $data);
    }

    /**
     * Find a package.
     *
     * @param  string  $packageId
     * @return Package
     */
    public function find(string $packageId): Package
    {
        $data = $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/organization/{$this->organisationAlias}/package/{$packageId}",
        )->onError(function (Response $response) use ($packageId) {
            if ($response->status() === 404) {
                throw new PackageNotFound("Package {$packageId} not found");
            } elseif ($response->status() === 403) {
                throw new \RuntimeException("You don't have permission to access this package");
            } else {
                throw new \RuntimeException($response->json());
            }
        })->json();

        return PackageFactory::new(attributes: $data);
    }

    /**
     * Remove a package.
     *
     * @param  string  $packageId
     * @return bool
     */
    public function remove(string $packageId): bool
    {
        $this->service->delete(
            request: $this->service->buildRequestWithToken(),
            url: "/organization/{$this->organisationAlias}/package/{$packageId}",
        )->onError(function (Response $response) use ($packageId) {
            if ($response->status() === 404) {
                throw new PackageNotFound("Package {$packageId} not found");
            }
            throw new \RuntimeException($response->json());
        });

        return true;
    }

    /**
     * Synchronize package.
     */
    public function sync(string $packageId): bool
    {
        $this->service->put(
            request: $this->service->buildRequestWithToken(),
            url: "/organization/{$this->organisationAlias}/package/{$packageId}",
        )->onError(function (Response $response) use ($packageId) {
            if ($response->status() === 404) {
                throw new PackageNotFound("Package {$packageId} not found");
            }
            throw new \RuntimeException($response->json());
        });

        return true;
    }

    /**
     * Update and synchronize a package.
     */
    public function update(string $packageId, array $payload): Package
    {
        foreach (['url', 'keepLastReleases', 'enableSecurityScan'] as $key) {
            if (! isset($payload[$key])) {
                throw new \InvalidArgumentException("{$key} cannot be empty");
            }
        }

        $data = $this->service->put(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations/{$this->organisationAlias}/package/{$packageId}",
            payload: $payload,
        )->onError(function (Response $response) use ($packageId) {
            if ($response->status() === 404) {
                throw new PackageNotFound("Package {$packageId} not found");
            }
            throw new \RuntimeException($response->json());
        })->json('data');

        return PackageFactory::new(attributes: $data);
    }
}
