<?php

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\DataFactories\OrganizationFactory;
use AlphaOlomi\Repman\DataObjects\Organization;
use AlphaOlomi\Repman\Requests\GetRequest;
use AlphaOlomi\Repman\Requests\PostRequest;
use Illuminate\Support\Collection;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;
use Saloon\Exceptions\Request\RequestException;

/**
 * @property Connector $connector
 */
class OrganizationResource extends Resource
{
    public function __construct(
        protected Connector $connector,
    ) {
    }

    /**
     * List all organizations.
     *
     * @return Collection
     */
    public function list(int $page = 1)
    {
        $page = max($page, 1);

        $data = (array) $this->connector->send(
            new GetRequest('/organization', ['page' => $page])
        )->onError(function (Response $response) {
            if ($response->status() === 401) {
                throw new \RuntimeException('Authentication required, key is invalid');
            }
            throw new RequestException($response);
        })->json('data');

        return OrganizationFactory::collection(organizations: $data);
    }

    /**
     * Create a new organization.
     *
     *
     * @throws RequestException
     */
    public function create(string $name): Organization
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $data = (array) $this->connector
            ->send(new PostRequest('/organization', ['name' => $name]))
            ->onError(function (Response $response) {
                if ($response->status() === 400) {
                    throw new \RuntimeException('Organization already exists');
                }
                throw new RequestException($response);
            })->json();

        return OrganizationFactory::new(attributes: $data);
    }
}
