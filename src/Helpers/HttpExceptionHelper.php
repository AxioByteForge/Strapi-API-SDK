<?php

namespace Axio\StrapiSDK\Helpers;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class HttpExceptionHelper
{
    public static function getStatusCodeFromException(RequestException $e): ?int
    {
        $response = $e->getResponse();

        if ($response instanceof ResponseInterface) {
            return $response->getStatusCode();
        }

        return null;
    }
}
