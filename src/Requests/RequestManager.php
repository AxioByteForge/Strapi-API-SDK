<?php

namespace Axio\StrapiSDK\Requests;

use CURLFile;
use Axio\StrapiSDK\Connection\ConnectionManager;

/**
 * Class RequestManager
 * A class to manage requests to the Strapi API.
 * @package Axio\StrapiSDK\Requests
 */
class RequestManager
{
    /**
     * @var ConnectionManager The connection manager instance.
     */
    private $connection;

    /**
     * @var HTTPRequestHandler The HTTP request handler instance.
     */
    private $httpRequestHandler;

    /**
     * RequestManager constructor.
     * @param ConnectionManager $connection The connection manager instance.
     */
    public function __construct()
    {
        $this->connection = ConnectionManager::getInstance();
        $this->httpRequestHandler = new HTTPRequestHandler();
    }

    /**
     * Sends a GET request to the specified endpoint.
     *
     * @param string $endpoint The API endpoint.
     * @param array $queryParams The query parameters (optional).
     *
     * @return array An associative array representing the JSON response.
     */
    public function get($endpoint, $queryParams = [])
    {
        $url = $this->connection->getBaseURL() . $endpoint;
        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $this->connection->getAPIKey()],
            'query' => $queryParams,
        ];

        return $this->httpRequestHandler->makeRequest('GET', $url, $options);
    }

    /**
     * Sends a POST request to the specified endpoint.
     *
     * @param string $endpoint The API endpoint.
     * @param array $data The request data.
     *
     * @return array An associative array representing the JSON response.
     */
    public function post($endpoint, $data)
    {
        $url = $this->connection->getBaseURL() . $endpoint;
        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $this->connection->getAPIKey()],
            'json' => $data,
        ];

        return $this->httpRequestHandler->makeRequest('POST', $url, $options);
    }

    /**
     * Sends a PUT request to the specified endpoint.
     *
     * @param string $endpoint The API endpoint.
     * @param array $data The request data.
     *
     * @return array An associative array representing the JSON response.
     */
    public function put($endpoint, $data)
    {
        $url = $this->connection->getBaseURL() . $endpoint;
        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $this->connection->getAPIKey()],
            'json' => $data,
        ];

        return $this->httpRequestHandler->makeRequest('PUT', $url, $options);
    }

    /**
     * Sends a DELETE request to the specified endpoint.
     *
     * @param string $endpoint The API endpoint.
     *
     * @return array An associative array representing the JSON response.
     */
    public function delete($endpoint)
    {
        $url = $this->connection->getBaseURL() . $endpoint;
        $options = [
            'headers' => ['Authorization' => 'Bearer ' . $this->connection->getAPIKey()],
        ];

        return $this->httpRequestHandler->makeRequest('DELETE', $url, $options);
    }

    public function upload($file)
    {
        $url = $this->connection->getBaseURL() . "/upload";

        // Create a cURL handle
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->connection->getAPIKey(),
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'files' => new CURLFile($file),
        ]);

        // Execute the request and get the response
        $response = curl_exec($ch);

        // Close cURL handle
        curl_close($ch);

        return $response;
    }
}
