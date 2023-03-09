<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request as BaseRequest;

class DeleteRequest extends BaseRequest
{
    /**
     * HTTP Method
     *
     * @var Method
     */
    protected Method $method = Method::DELETE;

    /**
     * Request path
     *
     * @var string
     */
    protected string $path;

    /**
     * Request query parameters
     *
     * @var array
     */
    protected array $queryParams;


    /**
     * Create a new request instance
     *
     * @param string $path
     * @param ?string $queryParams
     */
    public function __construct(string $path, ?string $queryParams = null)
    {
        $this->path = $path;
        $this->queryParams = $queryParams;
    }

    /**
     * Resolve the endpoint
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return $this->path;
    }
}
