<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request as BaseRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasJsonBody;
class PatchRequest extends BaseRequest  implements HasBody
{

    use HasJsonBody;

    /**
     * HTTP Method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Request path
     *
     * @var string
     */
    protected string $path;

    /**
     * Request payload
     *
     * @var array
     */
    protected ?array $data;


    /**
     * Create a new request instance
     *
     * @param Method $method
     * @param string $path
     * @param ?string $data
     */
    public function __construct(string $path, ?string $data = null)
    {
        $this->path = $path;
        $this->data = $data;
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
     * Default body
     *
     * @return array<string, mixed>
     */
    protected function defaultBody(): array
    {
        return $this->data ?? [];
    }
}
