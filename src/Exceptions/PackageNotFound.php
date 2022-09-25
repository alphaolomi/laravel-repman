<?php

namespace AlphaOlomi\Repman\Exceptions;

class PackageNotFound extends \RuntimeException
{
    public function __construct(string $message = 'Package not found')
    {
        parent::__construct($message);
    }
}
