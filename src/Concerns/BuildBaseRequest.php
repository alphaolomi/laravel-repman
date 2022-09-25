<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait BuildBaseRequest
{
    public function buildRequestWithToken(): PendingRequest
    {
        return $this
            ->withBaseUrl()
            ->timeout(15)
            ->asJson()
            ->acceptJson()
            ->withHeaders(headers: ['X-API-TOKEN' => "{$this->apiToken}"]);
    }

    public function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl(url: $this->baseUrl);
    }
}
