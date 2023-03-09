<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Resources;

use AlphaOlomi\Repman\DataFactories\TokenFactory;
use AlphaOlomi\Repman\DataObjects\Token;
use AlphaOlomi\Repman\RepmanService;
use AlphaOlomi\Repman\Requests\DeleteRequest;
use AlphaOlomi\Repman\Requests\GetRequest;
use AlphaOlomi\Repman\Requests\PostRequest;
use AlphaOlomi\Repman\Requests\PutRequest;
use Illuminate\Support\Collection;
use RuntimeException;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;
use Saloon\Exceptions\Request\RequestException;

class TokenResource
{
    public function __construct(
        protected Connector $connector,
        protected readonly string $organizationAlias,
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
        $page = max($page, 1);

        $data = (array) $this->connector->send(
            new GetRequest(
                path: "/organization/{$this->organizationAlias}/token",
                queryParams: ['page' => $page],
            )
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new RuntimeException('You are not authorized to perform this action');
            }
            throw new RequestException($response);
        })->json('data');

        return TokenFactory::collection(tokens: $data);
    }

    /**
     * Generate a new token.
     */
    public function generate(string $name): Token
    {
        $data = (array) $this->connector->send(
            new PostRequest(
                path: "/organization/{$this->organizationAlias}/token",
                data: ['name' => $name]
            )
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new RuntimeException('You are not authorized to perform this action');
            }
            throw new RequestException($response);
        })->json();

        return TokenFactory::new(attributes: $data);
    }

    /**
     * Get a token.
     *
     * @param  string  $token
     * @return Token
     */
    public function regenerate(string $token): Token
    {
        $data = (array)  $this->connector->send(
            new PutRequest(path: "/organization/{$this->organizationAlias}/token/{$token}")
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new RuntimeException('You are not authorized to perform this action');
            }
            throw new RequestException($response);
        })->json();


        return TokenFactory::new($data);
    }

    /**
     * Delete a token.
     *
     * @param  string  $token
     * @return bool
     */
    public function delete(string $token): bool
    {
        $this->connector->send(
            new DeleteRequest(path: "/organization/{$this->organizationAlias}/token/{$token}")
        )->onError(function (Response $response) {
            if ($response->status() === 403) {
                throw new RuntimeException('You are not authorized to perform this action');
            }
            throw new RequestException($response);
        })->json();

        return true;
    }
}
