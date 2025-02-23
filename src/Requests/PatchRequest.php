<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request as BaseRequest;
use Saloon\Traits\Body\HasJsonBody;

class PatchRequest extends BaseRequest implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Request path
     */
    protected string $path;

    /**
     * Request payload
     */
    protected ?array $data;

    /**
     * Create a new request instance
     */
    public function __construct(string $path, ?array $data = null)
    {
        $this->path = $path;
        $this->data = $data;
    }

    /**
     * Resolve the endpoint
     */
    public function resolveEndpoint(): string
    {
        return $this->path;
    }

    /**
     * Default body
     *
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data ?? [];
    }
}
