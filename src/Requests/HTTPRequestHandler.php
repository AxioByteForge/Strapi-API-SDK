<?php

namespace Axio\StrapiSDK\Requests;

use Axio\StrapiSDK\Exceptions\ConnectionException;
use Axio\StrapiSDK\Exceptions\RequestException;
use Axio\StrapiSDK\Helpers\HttpExceptionHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Psr\Http\Message\ResponseInterface;

class HTTPRequestHandler
{
    public function makeRequest($method, $url, $options)
    {
        $client = new Client();

        try {
            $response = $client->request($method, $url, $options);

            return $this->handleResponse($response);
        } catch (GuzzleRequestException $e) {
            $statusCode = (new HttpExceptionHelper)->getStatusCodeFromException($e);

            switch ($statusCode) {
                case 400:
                case 401:
                case 403:
                case 404:
                case 405:
                case 406:
                case 409:
                case 410:
                case 412:
                case 422:
                case 429:
                case 500:
                case 501:
                    throw new RequestException("Request Error: " . $e->getMessage(), $statusCode, $e);
                default:
                    throw new ConnectionException("Connection Error: " . $e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    private function handleResponse(ResponseInterface $response): array
    {
        // Decode the JSON response into an associative array
        return json_decode($response->getBody()->getContents(), true);
    }
}
