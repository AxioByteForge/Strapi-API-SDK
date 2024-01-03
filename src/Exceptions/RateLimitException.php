<?php

namespace Axio\StrapiSDK\Exceptions;

use Axio\StrapiSDK\Exceptions\StrapiSDKException;

class RateLimitException extends StrapiSDKException
{
    // Additional properties or methods specific to rate limit errors can be added here if needed

    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        // Specific logic to handle rate limit errors
        parent::__construct($message, $code, $previous);
    }
}
