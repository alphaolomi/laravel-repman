<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

trait CanSendPutRequest
{
    public function put(PendingRequest $request, string $url, array $payload = []): Response
    {
        return $request->put(
            url: $url,
            data: $payload,
        );
    }
}
