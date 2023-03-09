<?php

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\Concerns\Resources\CanListResource;
use AlphaOlomi\Repman\DataFactories\OrganizationFactory;
use AlphaOlomi\Repman\DataObjects\Organization;
use AlphaOlomi\Repman\RepmanService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

/**
 * @property RepmanService $service
 */
class OrganizationResource implements CanListResource
{
    public function __construct(
        private readonly RepmanService $service,
    ) {
    }

    /**
     * List all organizations.
     */
    public function list(int $page = 1): Collection
    {
        $page = max($page, 1);

        $data = $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/organization?page={$page}",
        )->json('data');

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

        $data = $this->service->post(
            request: $this->service->buildRequestWithToken(),
            url: '/organization',
            payload: ['name' => $name],
        )
            ->onError(function (Response $response) {
                if ($response->status() === 400) {
                    // && str_contains($response->json('errors.message'), 'already exists')
                    throw new \RuntimeException('Organization already exists');
                }
                throw new RequestException($response);
            })
            ->json();

        return OrganizationFactory::new(attributes: $data);
    }
}
