<?php

namespace AlphaOlomi\Repman\Exceptions;

class PackageNotFound extends \RuntimeException
{
    public function __construct(string $packageId)
    {
        parent::__construct(sprintf('Package with id "%s" not found', $packageId));
    }
}
