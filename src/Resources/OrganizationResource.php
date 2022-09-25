<?php

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\Concerns\Resources\CanListResource;
use AlphaOlomi\Repman\DataFactories\OrganisationFactory;
use AlphaOlomi\Repman\DataObjects\Organisation;
use AlphaOlomi\Repman\RepmanService;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

/**
 * @property RepmanService $service
 */
class OrganizationResource
//    implements CanListResource
{
    public function __construct(
        private readonly RepmanService $service,
    ) {
    }

    /**
     * List all organizations.
     *
     * @param int $page
     * @return Collection
     */
    public function list(int $page = 1): Collection
    {
        $page = max($page, 1);

        $data = $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/organization?page={$page}",
        )->json("data");

        return OrganisationFactory::collection(organisations: $data);
    }

    /**
     * Create a new organization.
     *
     * @param string $name
     * @return Organisation
     */
    public function create(string $name): Organisation
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Name cannot be empty');
        }

        $data =  $this->service->post(
            request: $this->service->buildRequestWithToken(),
            url: '/organizations',
            payload: ['name' => $name],
        )
            ->onError(function (Response $response) {
                throw new \RuntimeException($response->json());
            })
            ->json();

        return OrganisationFactory::new(
            attributes: $data,
        );
    }
}
