<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

trait CanSendPatchRequest
{
    public function patch(PendingRequest $request, string $url, array $payload = []): Response
    {
        return $request->patch(
            url: $url,
            data: $payload,
        );
    }
}
