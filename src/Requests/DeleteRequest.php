<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request as BaseRequest;

class DeleteRequest extends BaseRequest
{
    /**
     * HTTP Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Request path
     */
    protected string $path;

    /**
     * Request query parameters
     */
    protected array $queryParams;

    /**
     * Create a new request instance
     *
     * @param  ?string  $queryParams
     */
    public function __construct(string $path, ?string $queryParams = null)
    {
        $this->path = $path;
        $this->queryParams = $queryParams;
    }

    /**
     * Resolve the endpoint
     */
    public function resolveEndpoint(): string
    {
        return $this->path;
    }
}
