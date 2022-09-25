<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\DataFactories\TokenFactory;
use AlphaOlomi\Repman\DataObjects\Token;
use AlphaOlomi\Repman\RepmanService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

class TokenResource
{
    public function __construct(
        private readonly RepmanService $service,
        private readonly string $organisationAlias,
    ) {
    }

    /**
     * List all tokens.
     *
     * @param  int  $page
     * @return Collection
     */
    public function list(int $page = 1): Collection
    {
        $page = ($page < 1) ? 1 : $page;

        $data = $this->service->get(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations/{$this->organisationAlias}/tokens?page={$page}",
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new \RuntimeException('You are not authorized to perform this action');
            }
            throw new \RuntimeException($response->json());
        })->json("data");

        return TokenFactory::collection(tokens: $data);
    }




    /**
     * Generate a new token.
     */
    public function generate(): Token
    {

        $data = $this->service->post(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations/{$this->organisationAlias}/tokens",
            payload: [],
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new \RuntimeException('You are not authorized to perform this action');
            }
            throw new \RuntimeException($response->json());
        })->json();

        return TokenFactory::new(attributes: $data);
    }

    /**
     * Get a token.
     * @param string $token
     * @return Token
     */
    public function regenerate(string $token): Token
    {
        $data = $this->service->put(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations/{$this->organisationAlias}/tokens/{$token}",
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new \RuntimeException('You are not authorized to perform this action');
            }
            if ($response->status() === 404) {
                throw new \RuntimeException('Token not found');
            }
            throw new \RuntimeException($response->json());

        })->json();

        return TokenFactory::new($data);
    }

    /**
     * Delete a token.
     *
     * @param string $token
     * @return bool
     *
     */
    public function delete(string $token): bool
    {
        $this->service->delete(
            request: $this->service->buildRequestWithToken(),
            url: "/organizations/{$this->organisationAlias}/tokens/{$token}",
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new \RuntimeException('You are not authorized to perform this action');
            }
            if ($response->status() === 404) {
                throw new \RuntimeException('Token not found');
            }
            throw new \RuntimeException($response->json());
        })->json();

        return true;
    }
}
