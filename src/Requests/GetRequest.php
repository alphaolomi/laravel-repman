<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request as BaseRequest;

class GetRequest extends BaseRequest
{
    /**
     * HTTP Method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

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
     * @param Method $method
     * @param string $path
     * @param ?string $data
     */
    public function __construct(string $path, ?array $queryParams = null)
    {
        $this->path = $path;
        $this->queryParams = $queryParams ?? [];
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

    /**
     * Resolve the query parameters
     *
     * @return array
     */
    public function resolveQueryParams(): array
    {
        return $this->queryParams ?? [];
    }
}
