<?php

declare(strict_types=1);

namespace AlphaOlomi\Repman\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

trait CanSendDeleteRequest
{
    public function delete(PendingRequest $request, string $url): Response
    {
        return $request->delete(
            url: $url,
        );
    }
}
