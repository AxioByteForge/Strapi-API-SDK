<?php

namespace Axio\StrapiSDK\Auth;

use Axio\StrapiSDK\Requests\RequestManager;

class Authorization
{
    private $requestManager;

    public function __construct()
    {
        $this->requestManager = new RequestManager();
    }
}
