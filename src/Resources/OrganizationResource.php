<?php

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\RepmanService;
use Illuminate\Http\Client\Response;

/**
 * @property RepmanService $service
 */
class OrganizationResource
{
    public function __construct(
        private readonly RepmanService $service,
    ) {
    }

    /**
     * List all organizations.
     *
     * @param  int  $page
     * @return Response
     */
    public function list(int $page = 1): Response
    {
        // TODO: Handle no negative page numbers, missing page, etc.
        return $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations?page={$page}",
        );
    }

    /**
     * Create a new organization.
     *
     * @param  array  $name
     * @return Response
     */
    public function addOrganisation(string $name): Response
    {
        return $this->service->post(
            request: $this->service->buildRequestWithToken(),
            url: '/organizations',
            payload: ['name' => $name],
        );
    }
}
