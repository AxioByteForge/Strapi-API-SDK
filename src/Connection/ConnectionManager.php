<?php

namespace Axio\StrapiSDK\Connection;

class ConnectionManager
{
    private static $instance;
    private $baseURL;
    private $apiKey;

    private function __construct() {}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setBaseURL($baseURL)
    {
        $this->baseURL = $baseURL;
    }

    public function setAPIKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getBaseURL()
    {
        return $this->baseURL;
    }

    public function getAPIKey()
    {
        return $this->apiKey;
    }
}
