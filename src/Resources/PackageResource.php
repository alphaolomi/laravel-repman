<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\DataFactories\PackageFactory;
use AlphaOlomi\Repman\DataObjects\Package;
use AlphaOlomi\Repman\Exceptions\PackageNotFound;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Requests\DeleteRequest;
use AlphaOlomi\Repman\Requests\GetRequest;
use AlphaOlomi\Repman\Requests\PatchRequest;
use AlphaOlomi\Repman\Requests\PostRequest;
use AlphaOlomi\Repman\Requests\PutRequest;
use Generator;
use Illuminate\Support\Collection;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;
use Saloon\Exceptions\Request\RequestException;

/**
 * @property RepmanService $service
 */
class PackageResource
{
    public function __construct(
        protected Connector $connector,
        protected readonly string $organizationAlias,
    ) {
    }

    /**
     * List all packages.
     */
    public function list(int $page = 1): Collection
    {
        $page = max($page, 1);

        $data = (array) $this->connector->send(
            new GetRequest(
                path: "/organization/{$this->organizationAlias}/package",
                queryParams: ['page' => $page],
            )
        )->json('data');

        return PackageFactory::collection(packages: $data);
    }

    /**
     * Iterate over a paginated request
     *
     * @param  \Saloon\Contracts\Request  $request
     *
     * @throws \ReflectionException
     * @throws \Saloon\Exceptions\InvalidResponseClassException
     * @throws \Saloon\Exceptions\PendingRequestException
     */
    public function paginate(int $page = 1, bool $asResponse = false): Generator
    {
        $page = max($page, 1);

        do {
            $response = $this->connector->send(new GetRequest(
                path: "/organization/{$this->organizationAlias}/package",
                queryParams: ['page' => $page],
            ));
            // TODO: Add retry logic when Rate Limiting is enabled
            // ->onError(fn (RequestException $e) => $e->getCode() === 429, fn () => sleep(1));
            // on rate limiting error, wait for 1 second and try again

            $data = (array) $response->json('data');

            if ($asResponse) {
                yield $response;
            } else {
                yield PackageFactory::collection(packages: $data);
            }

            $page++;
        } while ($response->json('links.next'));
    }

    /**
     * Create a new package.
     *
     *
     * @throws RequestException
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

        $data = (array) $this->connector->send(
            new PostRequest(
                path: "/organization/{$this->organizationAlias}/package",
                data: $payload,
            )
        )->json();

        return PackageFactory::new(attributes: $data);
    }

    /**
     * Find a package.
     *
     *
     * @throws RequestException
     */
    public function find(string $packageId): Package
    {
        $data = (array) $this->connector->send(
            new GetRequest(
                path: "/organization/{$this->organizationAlias}/package/{$packageId}",
            )
        )->onError(function (Response $response) use ($packageId) {
            if ($response->status() === 404) {
                throw new PackageNotFound($packageId);
            } elseif ($response->status() === 403) {
                throw new \RuntimeException("You don't have permission to access this package");
            } else {
                throw new RequestException($response);
            }
        })->json();

        return PackageFactory::new(attributes: $data);
    }

    /**
     * Remove a package.
     *
     *
     * @throws RequestException
     */
    public function remove(string $packageId): bool
    {
        $this->connector->send(
            new DeleteRequest(
                path: "/organization/{$this->organizationAlias}/package/{$packageId}",
            )
        )->onError(function (Response $response) use ($packageId) {
            if ($response->status() === 404) {
                throw new PackageNotFound($packageId);
            }
            throw new RequestException($response);
        });

        return true;
    }

    /**
     * Synchronize package.
     */
    public function sync(string $packageId): bool
    {
        $this->connector->send(
            new PutRequest(path: "/organization/{$this->organizationAlias}/package/{$packageId}")
        )->onError(function (Response $response) {
            // if ($response->status() === 404) {
            //     throw new PackageNotFound($packageId);
            // }
            throw new RequestException($response);
        });

        return true;
    }

    /**
     * Update and synchronize a package.
     */
    public function update(string $packageId, array $payload): bool
    {
        $this->connector->send(
            new PatchRequest(
                path: "/organization/{$this->organizationAlias}/package/{$packageId}",
                data: $payload
            )
        )->onError(function (Response $response) {
            // if ($response->status() === 404) {
            //     throw new PackageNotFound($packageId);
            // }
            // if ($response->status() === 403) {
            //     throw new \RuntimeException("You don't have permission to access this package");
            // }
            // if ($response->status() === 400) {
            //     throw new \RuntimeException('Bad request');
            // }
            throw new RequestException($response);
        })->json();

        return true;
    }
}
